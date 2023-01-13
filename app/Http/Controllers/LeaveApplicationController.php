<?php

namespace App\Http\Controllers;


use App\Models\LeaveAllocation;
use App\Models\LeaveApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveApplicationController extends Controller
{
    public function index()
    {
        $leaves = LeaveApplication::where('user_id', Auth::user()->id)->get();
        return view('leave_application.index', compact('leaves'));
    }

    public function create()
    {
        $leave_allocation = LeaveAllocation::where('user_id', Auth::user()->id)->with('leaveType')->get();
        return view('leave_application.create', compact('leave_allocation'));
    }

    public function store(Request $request)
    {
    }
}
