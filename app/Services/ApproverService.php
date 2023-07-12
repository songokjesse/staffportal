<?php

namespace App\Services;

use App\Models\LeaveApprover;
use App\Models\ManagementStaff;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApproverService
{

    public function determineManagementLevel($user_id)
    {
        // Check if the user exists in the staff management table
        $management_staff = ManagementStaff::where('user_id', $user_id)->first();
        if($management_staff){
            //get the recommender mangt category from the recommenders table
            $recommender_management_category = LeaveApprover::where('staff_category', $management_staff->management_category_id)->first();
            $recommenders = DB::table('management_staff')
                ->where('management_category_id', '=',$recommender_management_category->approver)
                ->select('user_id')
                ->get();
            $users = [];
            $users = array_merge($users, $recommenders->pluck('user_id')->toArray());

            return DB::table('users')
                ->whereIn('id', $users)
                ->whereNotIn('id', [$user_id])
                ->select('id', 'name')
                ->get();
        }
       return  DB::table('users')
            ->join('management_staff', 'users.id', '=', 'management_staff.user_id')
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('management_categories')
                    ->whereColumn('management_staff.management_category_id', 'management_categories.id')
                    ->where('management_categories.name', '=', 'Senior Management');
            })
           ->whereNotIn('users.id', [$user_id])
            ->select('users.name', 'users.id')
            ->get();
        }

}
