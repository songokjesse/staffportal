<?php

namespace App\Services;

use App\Models\LeaveDocument;

class LeaveApplicationDownload
{
    private LeaveEntitlementService $leaveEntitlementService;
    private LeaveApplicationShowService $leaveApplicationShowService;

    private StaffProfileService $profileService;

    public function __construct(LeaveEntitlementService $leaveEntitlementService, LeaveApplicationShowService $leaveApplicationShowService, StaffProfileService $profileService)
    {
        $this->leaveEntitlementService = $leaveEntitlementService;
        $this->leaveApplicationShowService = $leaveApplicationShowService;
        $this->profileService= $profileService;
    }

    public function downloadLeaveApplication(int $id): array
    {
        $applications = $this->leaveApplicationShowService->show_leave_application($id);
        $leaves = $applications['leaves'];
        $recommendations = $applications['recommendations'];
        $approvals = $applications['approvals'];
        $assignedDuty = $applications['assigned_duty'];
        $profile = $this->profileService->getProfileDetails($leaves->user_id);
        $attachments = LeaveDocument::where('leave_application_id', $id)->get();
        $leaveDaysUtilized = $this->leaveEntitlementService->get_utilized_days($id);
        $currentAllocation = $this->leaveEntitlementService->get_current_allocation($id);

        return [
            'profile' => $profile,
            'applications' => $applications,
            'leave_days_utilized' => $leaveDaysUtilized,
            'leaves' => $leaves,
            'recommendations' => $recommendations,
            'approvals' => $approvals,
            'assigned_duty' => $assignedDuty,
            'attachments' => $attachments,
            'current_allocation' => $currentAllocation,
        ];
    }
}
