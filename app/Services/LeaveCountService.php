<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class LeaveCountService
{
    public function count_users_on_leave(): int
    {
        return DB::table('leave_applications')
            ->select('user_id')
            ->where(function ($query) {
                $today = date('Y-m-d');
                $query->where('start_date', '<=', $today)
                    ->where('end_date', '>=', $today)
                    ->where('status', 'ACTIVE');
            })
            ->count();
    }

    public function count_leave_applications(): int
    {
        return DB::table('leave_applications')
            ->select('user_id')
            ->where('status', '=', 'PENDING')
            ->count();
    }

    public function count_application_pending_recommendation(): int
    {
        return DB::table('leave_recommendations')
            ->select('user_id')
            ->where('recommendation', '=' ,false)
            ->where('not_recommended', '=' ,false)
            ->count();
    }

    public function count_application_pending_approval(): int
    {
        return DB::table('leave_approvals')
            ->select('user_id')
            ->where('approved', '=' ,false)
            ->where('not_approved', '=' ,false)
            ->count();
    }
}
