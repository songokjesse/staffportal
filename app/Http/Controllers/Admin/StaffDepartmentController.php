<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;

class StaffDepartmentController extends Controller
{
    public function index(){
        $users = User::all();
        $departments = Department::all();
        return view('admin.departments.staff_department', compact('users', 'departments'));
    }
    public function store(Request $request){
        dd($request->all());
    }

}