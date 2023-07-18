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
    protected string $paginationTheme = 'bootstrap';
    public $name ="";

    public function render(): Factory|View|Application
    {
          $user =  User::where('name', 'ilike', '%{$this->name}%')
               ->orWhere('email', 'ilike','%{$this->name}%')
               ->with('leave_applications')
               ->first();
//
//        $user = User::whereRaw('lower(name) like ?', ["%{$this->name}%"])
//            ->orWhereRaw('lower(email) like ?', ["%{$this->name}%"])
//            ->with('leave_applications')
//            ->first();

        return view('livewire.individual-report', [
            'leave_applications' => $user ? $user->leave_applications : null
        ]);
    }
}
