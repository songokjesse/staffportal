<?php

namespace App\Http\Livewire;

use App\Models\LeaveAllocation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LeaveInput extends Component
{
    public string|int $leave_days = '1';
    public function render()
    {
        return view('livewire.leave-input', [
            'leave_allocation' => LeaveAllocation::where('user_id', Auth::user()->id)->with('leaveType')->get()

        ]);
    }

    public function  change_value($value)
    {
        $this->leave_days = substr(strrchr($value, '.'), 1);
    }
}
