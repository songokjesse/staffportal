<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\ManagementCategory;
use App\Models\ManagementStaff;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ManagementStaffController extends Controller
{
    public function index()
    {
        $departments = Department::pluck('name', 'id');
        $users = User::pluck('name', 'id');
        $management_categories = ManagementCategory::pluck('name', 'id');
        $management_staff  = ManagementStaff::all();
        return view('management_staff.index', compact('management_staff', 'departments', 'users', 'management_categories'));
    }


    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'user_id' => 'required',
            'department_id' => 'required',
            'management_category_id' => 'required',
        ]);

        ManagementStaff::updateOrCreate(
            [ 'user_id' =>  $request->user_id],
            $request->all()
        );
        return redirect()->route('management_staff.index')->with('status', 'Staff Successfully Added to Management');
    }
}
