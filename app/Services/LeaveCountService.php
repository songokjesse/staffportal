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
            ->where('status', 'PENDING')
            ->count();
    }
}
