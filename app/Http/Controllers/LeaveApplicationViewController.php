<?php

namespace App\Http\Controllers;

use App\Models\LeaveDocument;
use App\Services\LeaveApplicationShowService;
use App\Services\LeaveEntitlementService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeaveApplicationViewController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param $id
     * @return Application|Factory|View
     */
    public function __invoke($id, LeaveEntitlementService $leaveEntitlementService, LeaveApplicationShowService $applicationShowService): View|Factory|Application
    {


        $leave_applications = $applicationShowService->show_leave_application($id);
        $leaves = $leave_applications['leaves'];
        $recommendations = $leave_applications['recommendations'];
        $approvals = $leave_applications['approvals'];
        $assigned_duty = $leave_applications['assigned_duty'];
        $attachments = LeaveDocument::where('leave_application_id', $id)->get();
        $leave_days_utilized = $leaveEntitlementService->get_utilized_days($id);
        $current_allocation = $leaveEntitlementService->get_current_allocation($id);
        return view('leave_report.show', compact('leave_days_utilized','current_allocation','leaves', 'recommendations','approvals', 'assigned_duty', 'attachments'));

    }
}
