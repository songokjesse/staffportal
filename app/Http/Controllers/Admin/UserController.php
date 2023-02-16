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
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display all users
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $users = User::latest()->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show form for creating user
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        return view('admin.users.create', compact('departments'));
    }

    /**
     * Store a newly created user
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'phone' => ['required', 'string', 'max:255', 'unique:users'],
            'pf' => ['required', 'unique:profiles'],
            'department_id' => ['required'],
        ]);

        //For demo purposes only. When creating user or inviting a user
        // you should create a generated random password and email it to the user
        $profile = $user->create(array_merge($request->all(), [
            'password' => 'staff2022'
        ]));
        Profile::create([
            'user_id' => $profile->id,
            'pf' => $request['pf'],
            'department_id' => $request['department_id'],
        ]);
        return redirect()->route('users.index')
            ->withSuccess(__('User created successfully.'));
    }

    /**
     * Show user data
     *
     * @param User $user
     *
     * @return Application|Factory|View
     */
    public function show(User $user)
    {
        return view('admin.users.show', ['user' => $user ]);
    }

    /**
     * Edit user data
     *
     * @param User $user
     *
     * @return Application|Factory|View
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'user' => $user,
            'userRole' => $user->roles->pluck('name')->toArray(),
            'roles' => Role::latest()->get()
        ]);
    }

    /**
     * Update user data
     *
     * @param User $user*
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email:rfc,dns|unique:users,email,'.$user->id,
            'phone' => ['required', 'string', 'max:255'],
        ]);
        $user->update($request->all());

        $user->syncRoles($request->get('role'));

        return redirect()->route('users.index')
            ->withSuccess(__('User updated successfully.'));
    }

    /**
     * Delete user data
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->withSuccess(__('User deleted successfully.'));
    }
}
