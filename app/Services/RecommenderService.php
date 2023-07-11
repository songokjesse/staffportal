<?php

namespace App\Services;

use App\Models\LeaveRecommender;
use App\Models\ManagementStaff;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class RecommenderService
{
    public function determineManagementLevel($user_id)
    {
        // Check if the user exists in the staff management table
        $management_staff = ManagementStaff::where('user_id', $user_id)->first();
        if($management_staff){
       //get the recommender mangt category from the recommenders table
          $recommender_management_category = LeaveRecommender::where('staff_category', $management_staff->management_category_id)->first();
          $recommenders = DB::table('management_staff')
              ->where('management_category_id', '=',$recommender_management_category->recommender)
              ->select('user_id')
              ->get();
            $users = [];
            $users = array_merge($users, $recommenders->pluck('user_id')->toArray());

            return DB::table('users')
                ->whereIn('id', $users)
                ->select('id', 'name')
                ->get();
        }
        return null;
    }
}
