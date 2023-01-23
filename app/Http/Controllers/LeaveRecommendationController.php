<?php

namespace App\Http\Controllers;

use App\Models\LeaveRecommendation;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use MBarlow\Megaphone\Types\Important;

class LeaveRecommendationController extends Controller
{
    //
    public function index()
    {
//
//        $recommendations = LeaveRecommendation::where('user_id',Auth::user()->id)
//            ->where('recommendation', False)
//            ->where('not_recommended', False)
//            ->orderBy('recommendation')
//            ->with('user', 'leave_application')
//            ->get();

        $recommendations = DB::table('leave_applications')
            ->join('leave_recommendations', 'leave_applications.id', '=', 'leave_recommendations.leave_application_id')
            ->join('users', 'leave_applications.user_id', '=', 'users.id')
            ->join('leave_categories', 'leave_applications.leave_categories_id', '=', 'leave_categories.id')
            ->where('leave_recommendations.user_id','=' ,Auth::user()->id)
            ->where('leave_recommendations.recommendation', False)
            ->where('leave_recommendations.not_recommended', False)
            ->select(
                'leave_recommendations.id',
                'leave_categories.name as leave_category',
                'leave_applications.start_date',
                'leave_applications.end_date',
                'leave_applications.days',
                DB::raw("(Select name from users where id = leave_applications.user_id) as applicant_name"),
                DB::raw("(Select name from users where id = leave_applications.duties_by_user_id) as left_in_charge"),
            )
            ->get();
        return view('leave_recommendation.index', compact('recommendations'));

    }

    public function recommended(Request $request, $id): RedirectResponse
    {
      $recommendation = LeaveRecommendation::find($id);
      $recommendation->recommendation = True;
      $recommendation->save();

        $notification = new Important(
            'Leave Application Recommendation', // Notification Title
            'Your Leave Application has been recommended by '.Auth::user()->name, // Notification Body
            env('APP_URL', 'http://localhost').'/leave_application/'.$recommendation->leave_application_id, // Optional: URL. Megaphone will add a link to this URL within the Notification display.
//            'Read More...' // Optional: Link Text. The text that will be shown on the link button.
        );

        $user = User::find(1);
        $user->notify($notification);


        return redirect()->route('leave_recommendation.index')
            ->with('status','Leave Recommendation Submitted (Recommended) successfully.');
    }
    public function not_recommended(Request $request,$id):  RedirectResponse
    {
        $recommendation = LeaveRecommendation::find($id);
        $recommendation->not_recommended = True;
        $recommendation->save();

        $notification = new Important(
            'Leave Application Recommendation', // Notification Title
            'Your Leave Application has been rejected by '.Auth::user()->name, // Notification Body
            env('APP_URL', 'http://localhost').'/leave_application/'.$recommendation->leave_application_id, // Optional: URL. Megaphone will add a link to this URL within the Notification display.
//            'Read More...' // Optional: Link Text. The text that will be shown on the link button.
        );

        $user = User::find(1);
        $user->notify($notification);

        return redirect()->route('leave_recommendation.index')
            ->with('status','Leave Recommendation Submitted (Not Recommended) successfully.');
    }

}
