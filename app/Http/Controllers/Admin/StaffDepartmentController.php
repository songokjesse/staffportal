<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class StaffDepartmentController extends Controller
{
    public function index(){
        $users = User::all();
        $departments = Department::all();
        $profiles = Profile::latest()->paginate(20);
        return view('admin.departments.staff_department', compact('users', 'departments', 'profiles'));
    }
    public function store(Request $request){
        $request->validate([
            'user_id' => 'required|unique:profiles',
            'department_id' => 'required'
        ]);
        $staff = new Profile;
        $staff->user_id = $request->user_id;
        $staff->department_id = $request->department_id;
        $staff->save();

        return redirect()->route('assign_staff_to_department')
            ->with('status','Staff assigned Department successfully.');
    }

}