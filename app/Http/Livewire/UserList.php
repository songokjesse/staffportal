<?php

namespace App\Http\Livewire;

use App\Models\Department;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{
    use WithPagination; // Use WithPagination trait
    protected $paginationTheme = 'bootstrap';
    protected $users;
    public $departments;
    public $selectedDepartment = null;

    public function render()
    {
        $this->departments = Department::all();

        $query = Profile::query()->with('user');

        if ($this->selectedDepartment) {
            $query->whereHas('user', function ($query) {
                $query->where('department_id', $this->selectedDepartment);
            });
        }

        $this->users = $query->paginate(20); // Set the number of items per page


        return view('livewire.user-list', [
            'users' => $this->users,
            'departments' => $this->departments,
        ]);
    }
}
