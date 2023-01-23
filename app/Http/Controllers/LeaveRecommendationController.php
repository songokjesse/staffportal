<?php

namespace App\Http\Controllers;

use App\Models\LeaveRecommendation;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveRecommendationController extends Controller
{
    //
    public function index()
    {
        $recommendations = LeaveRecommendation::where('user_id',Auth::user()->id)
            ->where('recommendation', False)
            ->where('not_recommended', False)
            ->orderBy('recommendation')
            ->with('user', 'leave_application')
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
