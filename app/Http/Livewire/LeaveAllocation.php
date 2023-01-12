<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class LeaveAllocation extends Component
{
    use WithPagination;
    protected string $paginationTheme = 'bootstrap';
    public string $name="";
    public string $year="";
    public function render(): Factory|View|Application
    {
        return view('livewire.leave-allocation', [
            'leave_allocations' => \App\Models\LeaveAllocation::search('user_id', $this->name)->with('user', 'leaveType')
                ->search('year', $this->year)->paginate(15),
            'users' => User::all()
        ]);
    }
}
