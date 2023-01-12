<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class LeaveAllocationController extends Controller
{
    public function index()
    {
        return view('admin.leave_allocation.index');
    }
}
