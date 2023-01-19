<?php

namespace App\Http\Controllers;

use App\Models\LeaveRecommendation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveRecommendationController extends Controller
{
    //
    public function index()
    {
        $recommendations = LeaveRecommendation::where('user_id',Auth::user()->id)->orderBy('recommendation')->with('user', 'leave_application')->get();
        return view('leave_recommendation.index', compact('recommendations'));

    }

    public function show($id)
    {
        return view('leave_recommendation.show');
    }
}
