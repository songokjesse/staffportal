<?php

namespace App\Http\Controllers;


use App\Mail\AssignDuty;
use App\Models\AssignedDuty;
use App\Models\LeaveAllocation;
use App\Models\LeaveApplication;
use App\Models\LeaveDocument;
use App\Models\User;
use App\Services\LeaveAllocationService;
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

    public function create(LeaveAllocationService $allocationService): Factory|View|RedirectResponse|Application
    {
        if($allocationService->allocated_days(Auth::id()) == 0){
            return redirect()->route('leave_application.index')->with('warning', 'You have not been allocated any Leave days! Kindly Consult HR');
        }

        $active_or_pending_leave = DB::table('leave_applications')
            ->where('leave_applications.status', '=', "ACTIVE")
            ->orWhere('leave_applications.status', '=', "PENDING")
            ->where('leave_applications.user_id', '=', Auth::id())
            ->get();

        if ($active_or_pending_leave->count() > 0)
        {
            return redirect()->route('leave_application.index')->with('warning', 'You are already on Leave or have a pending Application! Kindly Consult HR');
        }

        $users = DB::table('users')
            ->select('name', 'id')
            ->whereNotIn('id', [Auth::id()])
            ->get();
        $leave_allocation = LeaveAllocation::where('user_id', Auth::id())->with('leaveType')->get();
        return view('leave_application.create', compact('leave_allocation', 'users'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(),
            [
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

        $validator->messages()->add('days.in', 'The number of days must be equal to the difference between the start and end dates.');

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $leave_applicaiton = New LeaveApplication();
        $leave_applicaiton->leave_categories_id = strtok($request->leave_categories_id, '.');
        $leave_applicaiton->user_id = Auth::id();
        $leave_applicaiton->days = $request->days;
        $leave_applicaiton->start_date = trim($request->start_date, '');
        $leave_applicaiton->end_date = trim($request->end_date, '');
        $leave_applicaiton->recommend_user_id = $request->recommend_user_id;
        $leave_applicaiton->phone = $request->phone;
        $leave_applicaiton->email = $request->email;
        $leave_applicaiton->status = "PENDING";
        $leave_applicaiton->state = "Application";
        $leave_applicaiton->save();

        //upload documents
        if($request->leave_document){

            $file = $request->file('leave_document');
            $filename = time().'_'.$file->getClientOriginalName();

            // File upload location
            $location = 'uploads';

            // Upload file
//            $file->move($location,$filename);
            $file->storeAs('uploads', $filename);
//            Storage::put('uploads', $file);

            $upload_doc = New LeaveDocument();
            $upload_doc->leave_application_id = $leave_applicaiton->id;
            $upload_doc->file_name = $filename;
            $upload_doc->save();
        }

        $recommendation = new AssignedDuty();
        $recommendation->user_id = $request->duties_by_user_id;
        $recommendation->leave_application_id = $leave_applicaiton->id;
        $recommendation->save();

        $notification = new Important(
            'Leave Application', // Notification Title
            'An application for Leave has been made by '.Auth::user()->name . '. Confirm if you will perform his/her duties while the applicant is on leave.', // Notification Body
            env('APP_URL', 'http://localhost').'/assigned_duties/', // Optional: URL. Megaphone will add a link to this URL within the Notification display.
//            'Read More...' // Optional: Link Text. The text that will be shown on the link button.
        );

//        send email to college to be assigned your duty
        $assigned_duty_email = User::find($request->duties_by_user_id);
        Mail::to($assigned_duty_email->email)->send(new AssignDuty($assigned_duty_email->name, Auth::user()->name));

        $user = User::find($request->duties_by_user_id);
        $user->notify($notification);

        return redirect()->route('leave_application.index')
            ->with('status','Leave Application Submitted successfully.');
    }

    public function show($id): Factory|View|Application
    {
        $leaves = DB::table('leave_applications')
            ->join('users', 'leave_applications.user_id', '=', 'users.id')
            ->join('leave_categories', 'leave_applications.leave_categories_id', '=', 'leave_categories.id')
            ->where('leave_applications.id','=' ,$id)
//            ->where('leave_applications.user_id','=' ,Auth::user()->id)
            ->select(
                'leave_categories.name as leave_category',
                'leave_applications.start_date',
                'leave_applications.end_date',
                'leave_applications.days',
                'leave_applications.phone',
                'leave_applications.email',
                DB::raw("(Select name from users where id = leave_applications.user_id) as applicant_name"),
//                DB::raw("(Select name from users where id = leave_applications.duties_by_user_id) as left_in_charge"),
            )
            ->first();
        $assigned_duty = DB::table('assigned_duties')
            ->join('users', 'assigned_duties.user_id', '=', 'users.id')
            ->where('leave_application_id', '=', $id)
            ->Where('agree', '=' , 1)
            ->select('users.name as left_in_charge')
            ->first();

        $recommendations = DB::table('leave_recommendations')
            ->select(
                'updated_at as date_recommended',
                'comments as recommendation_comments',
                'recommendation',
                'not_recommended',
                DB::raw("(Select name from users where id = user_id) as hod"),

            )
            ->where('leave_application_id', '=', $id)
            ->first();
        $approvals = DB::table('leave_approvals')
            ->select(
                'updated_at as date_approved',
                'comments as approval_comments',
                'approved',
                'not_approved',
                DB::raw("(Select name from users where id = user_id) as approved_by"),

            )
            ->where('leave_application_id', '=', $id)
            ->first();

        $attachments = LeaveDocument::where('leave_application_id', $id)->get();

        return view('leave_application.show', compact('leaves', 'recommendations','approvals', 'assigned_duty', 'attachments'));
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
