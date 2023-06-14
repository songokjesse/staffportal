<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class LeaveHistoryService
{
    public function get_history($user_id): array
    {

        $leave_history = DB::table('leave_applications')
            ->where('user_id', '=', $user_id)
//            ->select(
//                DB::raw('COUNT(*) as application_count'),
//                DB::raw('SUM(CASE WHEN status IN ("ACTIVE", "ENDED") THEN 1 ELSE 0 END) as approved_leaves'),
//                DB::raw('SUM(CASE WHEN status = "REJECTED" THEN 1 ELSE 0 END) as leave_rejections')
//            )
            ->select(
                DB::raw('COUNT(*) as application_count'),
                DB::raw('SUM(CASE WHEN status IN (\'ACTIVE\', \'ENDED\') THEN 1 ELSE 0 END) as approved_leaves'),
                DB::raw('SUM(CASE WHEN status = \'REJECTED\' THEN 1 ELSE 0 END) as leave_rejections')
            )
            ->first();

        return [
            'application_count' => $leave_history->application_count,
            'leave_rejections' => $leave_history->leave_rejections,
            'approved_leaves' => $leave_history->approved_leaves
        ];
    }
}
