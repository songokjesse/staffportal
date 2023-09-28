<?php

namespace App\Services;

use App\Models\LeaveDocument;
use Illuminate\Support\Facades\DB;

class LeaveApplicationShowService
{
    public function show_leave_application($id)
    {
        $leaves = DB::table('leave_applications')
            ->join('users', 'leave_applications.user_id', '=', 'users.id')
            ->join('leave_categories', 'leave_applications.leave_categories_id', '=', 'leave_categories.id')
            ->where('leave_applications.id','=' ,$id)
//            ->where('leave_applications.user_id','=' ,Auth::user()->id)
            ->select(
                'leave_categories.name as leave_category',
                'leave_applications.start_date',
                'leave_applications.id',
                'leave_applications.user_id',
                'leave_applications.end_date',
                'leave_applications.days',
                'leave_applications.phone',
                'leave_applications.email',
                'leave_applications.status',
                DB::raw("(Select name from users where id = leave_applications.user_id) as applicant_name"),
//                DB::raw("(Select name from users where id = leave_applications.duties_by_user_id) as left_in_charge"),
            )
            ->first();
        $assigned_duty = DB::table('assigned_duties')
            ->join('users', 'assigned_duties.user_id', '=', 'users.id')
            ->where('leave_application_id', '=', $id)
            ->Where('agree', '=' , 1)
            ->select('users.name as left_in_charge')
            ->first();

        $recommendations = DB::table('leave_recommendations')
            ->select(
                'updated_at as date_recommended',
                'comments as recommendation_comments',
                'recommendation',
                'not_recommended',
                DB::raw("(Select name from users where id = user_id) as hod"),

            )
            ->where('leave_application_id', '=', $id)
            ->first();
        $approvals = DB::table('leave_approvals')
            ->select(
                'updated_at as date_approved',
                'comments as approval_comments',
                'approved',
                'not_approved',
                DB::raw("(Select name from users where id = user_id) as approved_by"),

            )
            ->where('leave_application_id', '=', $id)
            ->first();

       return [
           'leaves' => $leaves,
           'approvals' => $approvals,
           'recommendations' => $recommendations,
           'assigned_duty' => $assigned_duty
       ];
    }
}
