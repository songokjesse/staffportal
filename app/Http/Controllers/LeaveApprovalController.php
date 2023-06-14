<?php

namespace App\Http\Controllers;

use App\Mail\LeaveApproved;
use App\Mail\LeaveNotApproved;
use App\Models\LeaveApplication;
use App\Models\LeaveApproval;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use MBarlow\Megaphone\Types\Important;

class LeaveApprovalController extends Controller
{
    //

    public function index(): Factory|View|Application
    {
        $approvals = DB::table('leave_applications')
            ->join('leave_approvals', 'leave_applications.id', '=', 'leave_approvals.leave_application_id')
            ->join('users', 'leave_applications.user_id', '=', 'users.id')
            ->join('leave_categories', 'leave_applications.leave_categories_id', '=', 'leave_categories.id')
            ->join('assigned_duties', 'leave_applications.id', '=', 'assigned_duties.leave_application_id')
            ->where('leave_approvals.user_id','=' ,Auth::id())
            ->where('leave_approvals.approved', '=',false)
            ->where('leave_approvals.not_approved', '=',false)
            ->select(
                'leave_approvals.id',
                'leave_categories.name as leave_category',
                'leave_applications.start_date',
                'leave_applications.end_date',
                'leave_applications.days',
                DB::raw("(Select name from users where id = leave_applications.user_id) as applicant_name"),
                DB::raw("(Select name from users where id = assigned_duties.user_id) as left_in_charge"),
            )
            ->get();
        return view('leave_approval.index', compact('approvals'));
    }

    public function approved(Request $request, $id): RedirectResponse
    {
        $leave_approval = LeaveApproval::find($id);
        $leave_approval->approved = True;
        if($request['comments'])
        {
            $leave_approval->comments = $request['comments'];
        }
        $leave_approval->save();

        $leave_application = LeaveApplication::find($leave_approval->leave_application_id);
        $leave_application->state = "Approved";
        $leave_application->status = "ACTIVE";
        $leave_application->save();

        //send email notification
        //Send notification to the Applicant on the Status of the Leave Application
        $notification = new Important(
            'Leave Application Approval', // Notification Title
            'Your Leave Application has been Approved by '.Auth::user()->name, // Notification Body
            env('APP_URL', 'http://localhost').'/leave_application/'.$leave_application->id, // Optional: URL. Megaphone will add a link to this URL within the Notification display.
//            'Read More...' // Optional: Link Text. The text that will be shown on the link button.
        );

        $user = User::find($leave_application->user_id);
        $user->notify($notification);

        //send email notification
        Mail::to($user->email)->queue(new LeaveApproved(Auth::user()->name, $user->name));


        return redirect()->route('leave_approvals.index')
            ->with('status','Leave Approval Submitted (Approved) successfully.');

    }

    public function not_approved(Request $request,$id): RedirectResponse
    {
        $leave_approval = LeaveApproval::find($id);
        $leave_approval->not_approved = True;
        if($request['comments'])
        {
            $leave_approval->comments = $request['comments'];
        }
        $leave_approval->save();

        $leave_application = LeaveApplication::find($leave_approval->leave_application_id);
        $leave_application->state = "Not_Approved";
        $leave_application->status = "REJECTED";
        $leave_application->save();

        //send email notification
        //Send notification to the Applicant on the Status of the Leave Application
        $notification = new Important(
            'Leave Application Approval', // Notification Title
            'Your Leave Application has Not been Approved by '.Auth::user()->name, // Notification Body
            env('APP_URL', 'http://localhost').'/leave_application/'.$leave_application->id, // Optional: URL. Megaphone will add a link to this URL within the Notification display.
//            'Read More...' // Optional: Link Text. The text that will be shown on the link button.
        );

        $user = User::find($leave_application->user_id);
        $user->notify($notification);
        Mail::to($user->email)->queue(new LeaveNotApproved($user->name));


        return redirect()->route('leave_approvals.index')
            ->with('status','Leave Approval Submitted (Not Approved) successfully.');
    }
}
