<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndividualReportController extends Controller
{
    public function index()
    {
        return view('leave_report.individual_report');
    }
}
