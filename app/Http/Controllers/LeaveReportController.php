<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LeaveReportController extends Controller
{
    //
    public function index()
    {
        return view('leave_report.index');
    }
}
