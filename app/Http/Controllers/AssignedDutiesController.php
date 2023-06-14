<?php

namespace App\Http\Controllers;

use App\Mail\AgreeAssignedDuty;
use App\Mail\RefuseAssignedDuty;
use App\Models\AssignedDuty;
use App\Models\LeaveApplication;
use App\Models\LeaveRecommendation;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use MBarlow\Megaphone\Types\Important;

class AssignedDutiesController extends Controller
{
    //
    public function index(): Factory|View|Application
    {
        $assigned_duties = AssignedDuty::where('user_id', Auth::id())
            ->where('agree', '=', 0)
            ->Where('dont_agree', '=', 0)
            ->with('leave_application')
            ->get();
        return view('assigned_duties.index', compact('assigned_duties'));
    }


    public function agree(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        //        Add update recommendation to true
        $assigned_duties = AssignedDuty::find($id);
        $assigned_duties->agree = True;
        if($request['comments'])
        {
            $assigned_duties->comments = $request['comments'];
        }
        $assigned_duties->save();

        //  Update the Leave Application state to Recommended
        $leave_application = LeaveApplication::find($assigned_duties->leave_application_id);

        $recommendation = new LeaveRecommendation();
        $recommendation->user_id = $leave_application->recommend_user_id;
        $recommendation->leave_application_id =  $assigned_duties->leave_application_id;
        $recommendation->save();

        $applicant_name = User::find($leave_application->user_id);
        //Send notification to the Applicant on the Status of the Leave Application
        $notification = new Important(
            'Leave Application', // Notification Title
            $applicant_name->name. ' has applied for Leave and was requesting for your recommendation', // Notification Body
            env('APP_URL', 'http://localhost:8000').'/leave_application/'.$leave_application->id, // Optional: URL. Megaphone will add a link to this URL within the Notification display.
//            'Read More...' // Optional: Link Text. The text that will be shown on the link button.
        );

        $user = User::find($leave_application->recommend_user_id);
        $user->notify($notification);
        Mail::to($user->email)->queue(new AgreeAssignedDuty($user->name, $applicant_name->name));



        //Send notification to HOD for Recommendation
        $recommendation_notification = new Important(
            'Assignment of Duties', // Notification Title
            'Your Duties Will be Performed By '.Auth::user()->name, // Notification Body
            env('APP_URL', 'http://localhost').'/leave_application/'.$leave_application->id, // Optional: URL. Megaphone will add a link to this URL within the Notification display.
//            'Read More...' // Optional: Link Text. The text that will be shown on the link button.
        );

        $hod = User::find($leave_application->user_id);
        $hod->notify($recommendation_notification);

        $assignedDutyUser = User::find($assigned_duties->user_id);
        Mail::to($hod->email)->queue(new AgreeAssignedDuty($assignedDutyUser->name, $applicant_name->name));

        return redirect()->route('assigned_duties.index')
            ->with('status','Leave Application Duty Assignment successfully.');
    }
    public function dont_agree(Request $request,$id):  \Illuminate\Http\RedirectResponse
    {
        $assigned_duties  = AssignedDuty::find($id);
        $assigned_duties->dont_agree = True;
        if($request['comments'])
        {
            $assigned_duties->comments = $request['comments'];
        }
        $assigned_duties->save();

        $leave_application = LeaveApplication::find( $assigned_duties->leave_application_id);
        $leave_application->state = "Refused Duty Assignment";
        $leave_application->status = "REJECTED";
        $leave_application->save();

        $notification = new Important(
            'Leave Application Duties Assignment', // Notification Title
            Auth::user()->name. " Has refused to be assigned your duties when on Leave", // Notification Body
            env('APP_URL', 'http://localhost').'/leave_application/'.$assigned_duties->leave_application_id, // Optional: URL. Megaphone will add a link to this URL within the Notification display.
//            'Read More...' // Optional: Link Text. The text that will be shown on the link button.
        );

        $user = User::find($leave_application->user_id);
        $user->notify($notification);

        $assignedDutyUser = User::find($id);
        Mail::to($assignedDutyUser->email)->queue(new RefuseAssignedDuty($assignedDutyUser->name, $user->name));

        return redirect()->route('assigned_duties.index')
            ->with('status','Offer to Help with Duties Rejection is successful.');
    }
}
