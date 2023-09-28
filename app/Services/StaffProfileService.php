<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class StaffProfileService
{
    public function getProfileDetails($userId): Collection
    {
        return DB::table('profiles')
            ->join('departments', 'profiles.department_id', '=', 'departments.id')
            ->join('job_titles', 'profiles.job_title_id', '=', 'job_titles.id')
            ->select( 'job_titles.name as job_title', 'departments.name as department_name', 'profiles.pf')
            ->where('profiles.user_id', '=', $userId)
            ->get();
    }

}
