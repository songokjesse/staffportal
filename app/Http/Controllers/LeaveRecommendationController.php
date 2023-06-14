<?php

namespace App\Http\Controllers;

use App\Mail\LeaveNotRecommended;
use App\Mail\LeavePendingApproval;
use App\Mail\LeaveRecommended;
use App\Models\LeaveApplication;
use App\Models\LeaveApproval;
use App\Models\LeaveRecommendation;
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

class LeaveRecommendationController extends Controller
{
    //
    public function index(): Factory|View|Application
    {
        $recommendations = DB::table('leave_applications')
            ->join('leave_recommendations', 'leave_applications.id', '=', 'leave_recommendations.leave_application_id')
            ->join('users', 'leave_applications.user_id', '=', 'users.id')
            ->join('leave_categories', 'leave_applications.leave_categories_id', '=', 'leave_categories.id')
            ->where('leave_recommendations.user_id','=' ,Auth::id())
            ->where('leave_recommendations.recommendation', '=',false)
            ->where('leave_recommendations.not_recommended', '=',false)
            ->select(
                'leave_recommendations.id',
                'leave_applications.user_id',
                'leave_categories.name as leave_category',
                'leave_applications.start_date',
                'leave_applications.end_date',
                'leave_applications.days',
                DB::raw("(Select name from users where id = leave_applications.user_id) as applicant_name"),
            )
            ->get();
        $users = DB::table('users')
            ->select('name','id')
            ->whereNotIn('id', [Auth::id(),])
            ->get();
        return view('leave_recommendation.index', compact('recommendations', 'users'));

    }

    public function recommended(Request $request, $id): RedirectResponse
    {
        //        Add update recommendation to true
        $recommendation = LeaveRecommendation::find($id);
        $recommendation->recommendation = True;
        if($request['comments'])
        {
            $recommendation->comments = $request['comments'];
        }
        $recommendation->save();

        //  Update the Leave Application state to Recommended
        $leave_application = LeaveApplication::find($recommendation->leave_application_id);
        $leave_application->state = "Recommended";
        $leave_application->save();

        // Update the Leave Approval Table (To start the Approval Process)
        $leave_approval = new LeaveApproval();
        $leave_approval->user_id = $request->user_id;
        $leave_approval->leave_application_id = $recommendation->leave_application_id;
        $leave_approval->save();


        //Send notification to the Applicant on the Status of the Leave Application
        $notification = new Important(
            'Leave Application Recommendation', // Notification Title
            'Your Leave Application has been recommended by '.Auth::user()->name, // Notification Body
            env('APP_URL', 'http://localhost').'/leave_application/'.$recommendation->leave_application_id, // Optional: URL. Megaphone will add a link to this URL within the Notification display.
//            'Read More...' // Optional: Link Text. The text that will be shown on the link button.
        );

        $user = User::find($leave_application->user_id);
        $user->notify($notification);

        $recommender = User::find(Auth::id());
        Mail::to($user->email)->queue(new LeaveRecommended($recommender->name, $user->name));

//        notify approver
        $approver = User::find($request->user_id);
        Mail::to($approver->email)->queue(new LeavePendingApproval($approver->name, $user->name));

        return redirect()->route('leave_recommendation.index')
            ->with('status','Leave Recommendation Submitted (Recommended) successfully.');
    }
    public function not_recommended(Request $request,$id):  RedirectResponse
    {
        $recommendation = LeaveRecommendation::find($id);
        $recommendation->not_recommended = True;
        if($request['comments'])
        {
            $recommendation->comments = $request['comments'];
        }
        $recommendation->save();

        $leave_application = LeaveApplication::find($recommendation->leave_application_id);
        $leave_application->state = "Not Recommended";
        $leave_application->status = "REJECTED";
        $leave_application->save();

        $notification = new Important(
            'Leave Application Recommendation', // Notification Title
            'Your Leave Application has been rejected by '.Auth::user()->name, // Notification Body
            env('APP_URL', 'http://localhost').'/leave_application/'.$recommendation->leave_application_id, // Optional: URL. Megaphone will add a link to this URL within the Notification display.
//            'Read More...' // Optional: Link Text. The text that will be shown on the link button.
        );

        $user = User::find($leave_application->user_id);
        $user->notify($notification);
        Mail::to($user->email)->queue(new LeaveNotRecommended( $user->name));


        return redirect()->route('leave_recommendation.index')
            ->with('status','Leave Recommendation Submitted (Not Recommended) successfully.');
    }

}
