<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffDepartmentController extends Controller
{
    public function index(): Factory|View|Application
    {
        $users = User::all();
        $departments = Department::all();
        $profiles = DB::table('profiles')
            ->join('users', 'profiles.user_id', '=', 'users.id')
            ->join('departments', 'profiles.department_id', '=', 'departments.id')
            ->select(
                'departments.name as department_name',
                'users.name as user_name'
            )
            ->paginate(20);
        return view('admin.departments.staff_department', compact('users', 'departments', 'profiles'));
    }
    public function store(Request $request){
        $request->validate([
            'user_id' => 'required',
            'department_id' => 'required'
        ]);

          Profile::updateOrCreate([
              "user_id" => $request->user_id,
          ], $request->all());

        return redirect()->route('assign_staff_to_department')
            ->with('status','Staff assigned Department successfully.');
    }

}
