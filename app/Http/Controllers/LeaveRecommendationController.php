<?php

namespace App\Http\Controllers;

use App\Models\LeaveRecommendation;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function recommended($id): Factory|View|Application
    {
        return view('leave_recommendation.recommended');
    }
    public function not_recommended($id):  Factory|View|Application
    {
        return view('leave_recommendation.not_recommended');
    }

    public function store(Request $request)
    {

    }
}
