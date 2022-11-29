<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Requisition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RequisitionController extends Controller
{
    public function index(){
        $user_id = Auth::user()->id;
        $requisitions = DB::table('requisitions')
            ->join('departments', 'requisitions.department_id', '=', 'departments.id')
            ->select('requisitions.description','requisitions.status','requisitions.id','departments.name as name')
            ->where('user_id', '=', $user_id)
            ->get();
        return view('requisition.index', compact('requisitions'));
    }


    public function create()
    {
        $departments = Department::all();
        return view('requisition.create', compact('departments'));
    }
}
