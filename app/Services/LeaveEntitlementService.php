<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class LeaveEntitlementService
{

     public function current_year(){
         return Carbon::now()->format('Y');
     }

    public function get_utilized_days($application_id)
    {
        return DB::table('leave_applications')
        ->join('leave_categories', 'leave_applications.leave_categories_id', '=', 'leave_categories.id')
        ->where('leave_applications.id', '=', $application_id)
        ->where('leave_applications.status', 'IN', ['ACTIVE', 'ENDED'])
        ->select(DB::raw('SUM(leave_applications.days) as days_utilized'))
        ->first();
    }

    public function get_current_allocation($application_id): Collection
    {
         return DB::table('leave_allocations')
             ->join('leave_applications', 'leave_allocations.user_id', '=', 'leave_applications.user_id')
             ->where('leave_applications.id', '=', $application_id)
             ->select('leave_allocations.days')
             ->get();
    }

}
