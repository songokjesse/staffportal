<?php

namespace App\Http\Livewire;

use App\Models\LeaveApplication;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class IndividualReport extends Component
{
    public $search = '';

    public function render()
    {
        $users = User::with('leave_applications')
            ->where('name', 'LIKE', "%{$this->search}%")
            ->orWhere('email', 'LIKE', "%{$this->search}%")
            ->get();

        return view('livewire.individual-report', [
            'users' => $users,
        ]);
    }
}
