<?php

namespace App\Http\Controllers;


use App\Models\LeaveAllocation;
use App\Models\LeaveApplication;
use App\Models\LeaveRecommendation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\Type\FalseType;

class LeaveApplicationController extends Controller
{
    public function index()
    {
        $leaves = LeaveApplication::where('user_id', Auth::user()->id)->get();
        return view('leave_application.index', compact('leaves'));
    }

    public function create()
    {
        $users = User::all();
        $leave_allocation = LeaveAllocation::where('user_id', Auth::user()->id)->with('leaveType')->get();
        return view('leave_application.create', compact('leave_allocation', 'users'));
    }

    public function store(Request $request)
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
        $leave_applicaiton->save();

        $recommendation = new LeaveRecommendation();
        $recommendation->user_id = $request->recommend_user_id;
        $recommendation->leave_application_id = $leave_applicaiton->id;
        $recommendation->recommendation = False;
        $recommendation->save();
        return redirect()->route('leave_application.index')
            ->with('status','Leave Application Submitted successfully.');
    }

    public function show($id)
    {

    }
}
