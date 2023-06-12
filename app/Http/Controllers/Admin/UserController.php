<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\JobTitle;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
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
        $users = User::latest()->paginate(50);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show form for creating user
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $departments = Department::all();
        $job_titles = JobTitle::all();
        return view('admin.users.create', compact('departments', 'job_titles'));
    }

    /**
     * Store a newly created user
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function store(User $user, Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'phone' => ['required', 'string', 'max:255', 'unique:users'],
            'pf' => ['required', 'unique:profiles'],
            'department_id' => ['required'],
            'job_title_id' => ['required'],
        ]);

        //For demo purposes only. When creating user or inviting a user
        // you should create a generated random password and email it to the user
        $profile = $user->create(array_merge($request->all(), [
            'password' => Hash::make('staff2022')
        ]));
        Profile::create([
            'user_id' => $profile->id,
            'pf' => $request['pf'],
            'department_id' => $request['department_id'],
            'job_title_id' => $request['job_title_id'],
        ]);
        return redirect()->route('users.index')
            ->with('status','User created successfully.');
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
     * @return RedirectResponse
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
            ->with('status','User updated successfully.');
    }

    /**
     * Delete user data
     *
     * @param User $user
     *
     * @return RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('status','User deleted successfully.');
    }
}
