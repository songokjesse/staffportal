<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LeaveAllocationService
{
    public function allocated_days($user_id): int
    {
        return DB::table('leave_allocations')
            ->where('year', '=', Carbon::now()->format('Y'))
            ->where('user_id', '=', $user_id)
            ->count();
    }

}
