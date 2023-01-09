<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeaveCategory;
use Illuminate\Http\Request;

class LeaveCategoryController extends Controller
{
    public function index(){
        $leave_category = LeaveCategory::all();
        return view('admin/leave_category/index', compact('leave_category'));
    }
    public function create(){
        return view('admin/leave_category/create');
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'days' => 'required'
        ]);
        LeaveCategory::create($request->all());
        return redirect()->route('leaveCategory.index')
            ->with('status','Leave Category created successfully.');
    }
}
