<?php

namespace App\Console\Commands;

use App\Mail\RecommendationReminder;
use App\Models\LeaveRecommendation;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SendRecommendationReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:recommendation-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminders for recommendations to be made for leave applicants';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): void
    {
        // Eager load the 'user' relationship on 'leaveApplication' and 'leaveApplication' on 'leaveRecommendation'
        $usersWithRemindersToSend = LeaveRecommendation::with('user', 'leave_application')
            ->where('recommendation_reminder_sent', 0)
            ->whereDate('created_at', '<=', Carbon::now()->subDays(3))
            ->where('recommendation', '=', 0)
            ->where('not_recommended', '=', 0)
            ->get();

        foreach ($usersWithRemindersToSend as $leaveRecommendation) {
            $user = $leaveRecommendation->user;
            $leaveApplication = $leaveRecommendation->leave_application;

            // Access the leave applicant's user information
            $leaveApplicant = $leaveApplication->user;

            // Send reminder email to $user with leave applicant's name
            Mail::to($user->email)->send(new RecommendationReminder($leaveApplicant->name, $user->name));

            // Update the flag to indicate that the reminder email has been sent
            $leaveRecommendation->update(['recommendation_reminder_sent' => true]);
        }

//        By eager loading the user relationship, you'll retrieve the associated users in a single query rather than executing a separate query for each user, which can significantly improve performance, especially if you have a large number of records.
    }
}
