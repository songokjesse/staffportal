<?php

namespace App\Http\Controllers;


use App\Enums\LeaveApplicationStatusEnum;
use App\Mail\AssignDuty;
use App\Models\AssignedDuty;
use App\Models\LeaveAllocation;
use App\Models\LeaveApplication;
use App\Models\LeaveDocument;
use App\Models\User;
use App\Services\LeaveAllocationService;
use App\Services\LeaveApplicationShowService;
use App\Services\LeaveEntitlementService;
use App\Services\RecommenderService;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use MBarlow\Megaphone\Types\Important;

class LeaveApplicationController extends Controller
{
    public function index(): Factory|View|Application
    {
        $leaves = LeaveApplication::where('user_id', Auth::id())->orderBy('state','asc')->get();
        return view('leave_application.index', compact('leaves'));
    }

    public function create(LeaveAllocationService $allocationService, RecommenderService $recommenderService): Factory|View|RedirectResponse|Application
    {

        if($allocationService->allocated_days(Auth::id()) == 0){
            return redirect()->route('leave_application.index')->with('warning', 'You have not been allocated any Leave days! Kindly Consult HR');
        }

        $active_or_pending_leave = DB::table('leave_applications')
            ->where('leave_applications.status', '=', LeaveApplicationStatusEnum::Active)
            ->orWhere('leave_applications.status', '=', LeaveApplicationStatusEnum::Pending)
            ->where('leave_applications.user_id', '=', Auth::id())
            ->get();

        if ($active_or_pending_leave->count() > 0)
        {
            return redirect()->route('leave_application.index')->with('warning', 'You are already on Leave or have a pending Application! Kindly Consult HR');
        }

        $users = DB::table('users')
            ->join('profiles', 'users.id', '=', 'profiles.user_id')
            ->select('users.name', 'users.id')
            ->where('users.id', '!=', Auth::id())
            ->where('profiles.department_id', function ($query) {
                $query->select('department_id')
                    ->from('profiles')
                    ->where('user_id', Auth::id())
                    ->limit(1);
            })
            ->get();

        $recommenders = $recommenderService->determineManagementLevel(Auth::id());

        return view('leave_application.create', compact('users', 'recommenders'));
    }

    public function store(Request $request): RedirectResponse
    {
        // Validate the leave application request
        $validator = $this->validateLeaveApplication($request);
        // Check if validation fails
        if ($validator && $validator->fails()) {
            // Redirect back with validation errors and input data
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create a new leave application record
        $leaveApplication = LeaveApplication::create([
            'leave_categories_id' => strtok($request->leave_categories_id, '.'),
            'user_id' => $request->user()->id,
            'days' => $request->days,
            'start_date' => trim($request->start_date),
            'end_date' => trim($request->end_date),
            'recommend_user_id' => $request->recommend_user_id,
            'phone' => $request->phone,
            'email' => $request->email,
            'status' => LeaveApplicationStatusEnum::Pending,
            'state' => 'Application',
        ]);
        // Upload any associated documents
        $this->uploadDocuments($request, $leaveApplication);
        // Create an assigned duty for the leave application
        AssignedDuty::create([
            'user_id' => $request->duties_by_user_id,
            'leave_application_id' => $leaveApplication->id,
        ]);
        // Send notification and email
        $this->sendNotificationAndEmail($request, $leaveApplication);
        // Redirect to the leave application index page with a success message
        return redirect()->route('leave_application.index')
            ->with('status', 'Leave Application submitted successfully.');
    }

    public function show($id, LeaveEntitlementService $leaveEntitlementService,LeaveApplicationShowService $leaveApplicationShowService): Factory|View|Application
    {
        $applications = $leaveApplicationShowService->show_leave_application($id);
        $leaves = $applications['leaves'];
        $recommendations = $applications['recommendations'];
        $approvals = $applications['approvals'];
        $assigned_duty = $applications['assigned_duty'];
        $attachments = LeaveDocument::where('leave_application_id', $id)->get();
        $leave_days_utilized = $leaveEntitlementService->get_utilized_days($id);
        $current_allocation = $leaveEntitlementService->get_current_allocation($id);
        $attachments = LeaveDocument::where('leave_application_id', $id)->get();

        $leave_days_utilized = $leaveEntitlementService->get_utilized_days($id);
        $current_allocation = $leaveEntitlementService->get_current_allocation($id);
        return view('leave_application.show', compact('leave_days_utilized','current_allocation','leaves', 'recommendations','approvals', 'assigned_duty', 'attachments'));
    }


    private function validateLeaveApplication(Request $request): \Illuminate\Contracts\Validation\Validator|\Illuminate\Validation\Validator
    {
        $validator = Validator::make($request->all(), [
            'days' => [
                'required',
                'integer',
                'min:1',
                Rule::in([$this->calculateNumberOfDays($request->input('start_date'), $request->input('end_date'))])
            ],
            'leave_categories_id' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'duties_by_user_id' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'recommend_user_id' => 'required',
            'leave_document' => 'sometimes|nullable|file|mimes:png,jpg,jpeg,csv,txt,pdf|max:2048',
        ]);

//        $validator->getMessageBag()->add('days.in', 'The number of days must be equal to the difference between the start and end dates.');
        $validator->messages()->add('days.in', 'The number of days must be equal to the difference between the start and end dates.');

        return $validator;
    }

    private function uploadDocuments(Request $request, LeaveApplication $leaveApplication): void
    {
        if ($request->hasFile('leave_document')) {
            $file = $request->file('leave_document');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads', $filename);
            LeaveDocument::create([
                'leave_application_id' => $leaveApplication->id,
                'file_name' => $filename,
            ]);
        }
    }

    private function sendNotificationAndEmail(Request $request, LeaveApplication $leaveApplication): void
    {
        $notification = new Important(
            'Leave Application',
            'An application for Leave has been made by ' . $request->user()->name . '. Confirm if you will perform his/her duties while the applicant is on leave.',
            env('APP_URL', 'http://localhost') . '/assigned_duties/'
        );

        $assignedDutyUser = User::find($request->duties_by_user_id);
        Mail::to($assignedDutyUser->email)->queue(new AssignDuty($assignedDutyUser->name, $request->user()->name));

        $assignedDutyUser->notify($notification);
    }
    private function calculateNumberOfDays($startDate, $endDate): int
    {
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);

        $days = 0;
        while ($start <= $end) {
            if (!$start->isWeekend()) {
                $days++;
            }
            $start->addDay();
        }

        return $days;
    }
}
