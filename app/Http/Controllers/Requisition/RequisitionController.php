<?php

namespace App\Http\Controllers\Requisition;

use App\Http\Controllers\Controller;
use App\Models\Department;
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

    public function store(Request $request){
        $request->validate([
           'description' => 'required',
           'department_id' => 'required',
           'title' => 'required',
        ]);

        dd($request->all());

        return redirect()->route('requisitions.create')
            ->with('status','General Information Captured successfully.');
    }
}
