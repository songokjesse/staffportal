<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LeaveApprovalController extends Controller
{
    //

    public function index(): Factory|View|Application
    {
        $approvals = DB::table('leave_applications')
            ->join('leave_approvals', 'leave_applications.id', '=', 'leave_approvals.leave_application_id')
            ->join('users', 'leave_applications.user_id', '=', 'users.id')
            ->join('leave_categories', 'leave_applications.leave_categories_id', '=', 'leave_categories.id')
            ->where('leave_approvals.user_id','=' ,Auth::user()->id)
            ->where('leave_approvals.approved', False)
            ->where('leave_approvals.not_approved', False)
            ->select(
                'leave_approvals.id',
                'leave_categories.name as leave_category',
                'leave_applications.start_date',
                'leave_applications.end_date',
                'leave_applications.days',
                DB::raw("(Select name from users where id = leave_applications.user_id) as applicant_name"),
                DB::raw("(Select name from users where id = leave_applications.duties_by_user_id) as left_in_charge"),
            )
            ->get();
        return view('leave_approval.index', compact('approvals'));
    }
}
