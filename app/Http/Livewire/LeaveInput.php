<?php

namespace App\Http\Livewire;

use App\Models\LeaveAllocation;
use App\Services\LeaveDaysService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LeaveInput extends Component
{
    public string|int $leave_days = '1';
    public function render(LeaveDaysService $leaveDaysService)
    {
        return view('livewire.leave-input', [
            'leave_allocation' => $leaveDaysService->get_available_days(Auth::id())

        ]);
    }

    public function  change_value($value)
    {
        $this->leave_days = substr(strrchr($value, '.'), 1);
    }
}
