<?php

namespace App\Http\Controllers;

use App\Services\LeaveCountService;
use Illuminate\Http\Request;

class LeaveReportController extends Controller
{
    //
    public function index(LeaveCountService $leaveCountService)
    {
        $on_leave = $leaveCountService->count_users_on_leave();
        $leave_applications = $leaveCountService->count_leave_applications();
        $pending_recommendation = $leaveCountService->count_application_pending_recommendation();
        $pending_approval = $leaveCountService->count_application_pending_approval();
        return view('leave_report.index', compact('on_leave', 'leave_applications', 'pending_approval', 'pending_recommendation'));
    }
}
