<?php

namespace App\Http\Controllers;


use App\Models\LeaveAllocation;
use App\Models\LeaveApplication;
use App\Models\LeaveRecommendation;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use MBarlow\Megaphone\Types\Important;

class LeaveApplicationController extends Controller
{
    public function index(): Factory|View|Application
    {
        $leaves = LeaveApplication::where('user_id', Auth::user()->id)->orderBy('state','asc')->get();
        return view('leave_application.index', compact('leaves'));
    }

    public function create()
    {
        $users = DB::table('users')
            ->select('name', 'id')
            ->whereNotIn('id', [Auth::user()->id])
            ->get();
        $leave_allocation = LeaveAllocation::where('user_id', Auth::user()->id)->with('leaveType')->get();
        return view('leave_application.create', compact('leave_allocation', 'users'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'leave_categories_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'days' => 'required',
            'duties_by_user_id' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'recommend_user_id' => 'required'
        ]);

        $leave_applicaiton = New LeaveApplication();
        $leave_applicaiton->leave_categories_id = strtok($request->leave_categories_id, '.');
        $leave_applicaiton->user_id = Auth::user()->id;
        $leave_applicaiton->days = $request->days;
        $leave_applicaiton->start_date = $request->start_date;
        $leave_applicaiton->end_date = $request->end_date;
        $leave_applicaiton->duties_by_user_id = $request->duties_by_user_id;
        $leave_applicaiton->phone = $request->phone;
        $leave_applicaiton->email = $request->email;
        $leave_applicaiton->status = False;
        $leave_applicaiton->state = "Application";
        $leave_applicaiton->save();

        $recommendation = new LeaveRecommendation();
        $recommendation->user_id = $request->recommend_user_id;
        $recommendation->leave_application_id = $leave_applicaiton->id;
        $recommendation->recommendation = False;
        $recommendation->save();

        $notification = new Important(
            'Leave Application', // Notification Title
            'An application for Leave has been made by '.Auth::user()->name, // Notification Body
            'http://'. env('APP_URL', 'http://localhost').'/leave_recommendation/', // Optional: URL. Megaphone will add a link to this URL within the Notification display.
//            'Read More...' // Optional: Link Text. The text that will be shown on the link button.
        );

        $user = User::find(1);
        $user->notify($notification);

        return redirect()->route('leave_application.index')
            ->with('status','Leave Application Submitted successfully.');
    }

    public function show($id): Factory|View|Application
    {
        $leaves = DB::table('leave_applications')
            ->join('leave_recommendations', 'leave_applications.id', '=', 'leave_recommendations.leave_application_id')
            ->join('users', 'leave_applications.user_id', '=', 'users.id')
            ->join('leave_categories', 'leave_applications.leave_categories_id', '=', 'leave_categories.id')
            ->where('leave_applications.id','=' ,$id)
            ->where('leave_applications.user_id','=' ,Auth::user()->id)
            ->select(
                'leave_categories.name as leave_category',
                'leave_applications.start_date',
                'leave_applications.end_date',
                'leave_applications.days',
                'leave_applications.phone',
                'leave_applications.email',
                'leave_recommendations.recommendation',
                'leave_recommendations.not_recommended',
                'leave_recommendations.updated_at as date_recommended',
                'leave_recommendations.comments as recommendation_comments',
                DB::raw("(Select name from users where id = leave_applications.user_id) as applicant_name"),
                DB::raw("(Select name from users where id = leave_applications.duties_by_user_id) as left_in_charge"),
                DB::raw("(Select name from users where id = leave_recommendations.user_id) as hod"),
            )
            ->get();
        return view('leave_application.show', compact('leaves'));
    }
}
