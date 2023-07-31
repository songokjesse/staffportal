<?php

namespace App\Console\Commands;

use App\Models\LeaveApplication;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckLeaveEndDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:leave_end_date';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if the end date of active leaves has been reached.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Get all active leave applications from the database
        $activeLeaves = LeaveApplication::where('status', 'ACTIVE')->get();

        foreach ($activeLeaves as $leave) {
            $endDate = $leave->end_date;
            $currentDate = Carbon::now();
            $endDateCarbon = Carbon::parse($endDate);

            if ($currentDate->gte($endDateCarbon)) {
                // The end date has been reached or exceeded for this leave
                $application = LeaveApplication::find($leave->id);
                $application->status = "ENDED";
                $application->save();
                // Your logic here, such as showing a message or performing some action
                $this->info("The end date for leave ID {$leave->id} has been reached or exceeded!");
            } else {
                // The end date has not been reached yet for this leave
                // Your logic here, such as displaying a countdown or something else
                $this->info("The end date for leave ID {$leave->id} is still in the future.");
            }
        }
    }
}
