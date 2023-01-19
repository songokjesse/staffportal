<?php

namespace App\Http\Controllers;


use App\Models\LeaveAllocation;
use App\Models\LeaveApplication;
use App\Models\User;
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
        $users = User::all();
        $leave_allocation = LeaveAllocation::where('user_id', Auth::user()->id)->with('leaveType')->get();
        return view('leave_application.create', compact('leave_allocation', 'users'));
    }

    public function store(Request $request)
    {
    }
}
