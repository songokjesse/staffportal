<?php

namespace App\Services;

use App\Models\LeaveAllocation;
use App\Models\LeaveApplication;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LeaveDaysService
{

    public function get_available_days($user_id): array
    {
  //        To calculate the remaining days based on the allocated days and the days already on leave, you can loop through the arrays $allocated_days and $days_on_leave. Here's the modified code:
            $allocated_days = DB::table('leave_allocations')
                ->join('leave_categories', 'leave_allocations.leave_categories_id', '=', 'leave_categories.id')
                ->where('user_id', '=', $user_id)
                ->where('year', '=', $this->current_year())
                ->select('leave_allocations.days', 'leave_categories.name')
                ->get();

            $days_on_leave = DB::table('leave_applications')
                ->join('leave_categories', 'leave_applications.leave_categories_id', '=', 'leave_categories.id')
                ->where('user_id', '=', $user_id)
                ->where('state', '=', 'Approved')
                ->select('leave_categories.name', DB::raw('SUM(leave_applications.days) as total_days'))
                ->groupBy('leave_categories.name')
                ->get();

            $remaining_days = [];

            foreach ($allocated_days as $allocated) {
                $category = $allocated->name;
                $allocated_days = $allocated->days;
                $days_taken = 0;

                foreach ($days_on_leave as $on_leave) {
                    if ($on_leave->name == $category) {
                        $days_taken = $on_leave->total_days;
                        break;
                    }
                }

                $remaining_days[$category] = $allocated_days - $days_taken;
            }

            return $remaining_days;
    }

    public function current_year(): string
    {
        return Carbon::now()->format('Y');
    }
}
