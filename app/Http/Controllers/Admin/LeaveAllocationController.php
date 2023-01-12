<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeaveAllocation;
use App\Models\LeaveCategory;
use App\Models\User;
use Illuminate\Http\Request;

class LeaveAllocationController extends Controller
{
    public function index()
    {
        return view('admin.leave_allocation.index');
    }

    public function create(){
        $users = User::all();
        $leave_categories = LeaveCategory::all();
        return view('admin.leave_allocation.create', compact('users', 'leave_categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'leave_categories_id' => 'required',
            'days' => 'required',
            'year' => 'required',
        ]);

        LeaveAllocation::create($request->all());
        return redirect()->route('leave_allocation.index')
            ->with('status','Leave Allocated successfully.');

    }
}
