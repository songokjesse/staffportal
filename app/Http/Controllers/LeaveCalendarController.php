<?php

namespace App\Http\Controllers;
use App\Models\LeaveApplication;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class LeaveCalendarController extends Controller
{
    public function __invoke(): Factory|View|Application
    {
        $events =[];
        $leaves = LeaveApplication::with('user')->get();
        foreach ($leaves as $leave){
            $events[] = [
                "title" => $leave->user->name,
                'start' => $leave->start_date,
                'end' => $leave->end_date
            ];
        }
        return view('leave_report.calendar', compact('events'));
    }
}
