<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Requisition;
use App\Models\RequisitionAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApprovalController extends Controller
{
    public function index()
    {
        $assignment = DB::table('requisition_assignments')
            ->join('profiles', 'requisition_assignments.department_id', '=', 'profiles.department_id')
            ->where('profiles.user_id', Auth::user()->id)
            ->pluck('requisition_id');

        $requisitions = Requisition::with('department', 'user')->whereIn('id', $assignment )->get();
       return view('requisition.approval.index', compact('requisitions'));

    }

    public function show($id)
    {
        $requisitions = Requisition::with('department', 'user', 'requisition_items')->where('id', $id )->get();
        dd($requisitions);
    }
}
