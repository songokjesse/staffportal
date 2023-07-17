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
//        for mysql
          $user =  User::where('name', 'like', "%{$this->name}%")
               ->orWhere('email', 'like', "%{$this->name}%")
               ->with('leave_applications')
               ->first();
//          for postgresql
//        $user = User::where('name', 'ilike', '%' . $this->name . '%')
//            ->orWhere('email', 'ilike', '%' . $this->name . '%')
//            ->with(['leave_applications' => function ($query) {
//                $query->whereIn('id', function ($subquery) {
//                    $subquery->selectRaw('MAX(id)')
//                        ->from('leave_applications')
//                        ->groupBy('status');
//                });
//            }])
//            ->first();
        return view('livewire.individual-report', [
            'leave_applications' => $user ? $user->leave_applications : null
        ]);
    }
}
