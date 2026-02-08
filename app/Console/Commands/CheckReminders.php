<?php

namespace App\Console\Commands;

use App\Jobs\SendReminderJob;
use App\Models\Reminder;
use Carbon\Carbon;
use Illuminate\Console\Command;

use function Symfony\Component\Clock\now;

class CheckReminders extends Command
{
    protected $signature = 'app:check-reminders';
    protected $description = 'Command description';

    public function handle()
    {
        $now = Carbon::now();
        $reminders = Reminder::where('status', 'pending')
            ->where('remind_at', '<=', $now)
            ->get();

        if ($reminders->count() === 0) {
            $this->info('No reminders to process.');
            return;
        }

        foreach ($reminders as $index => $reminder) {
            SendReminderJob::dispatch($reminder)->delay(now()->addSeconds($index * 2));
            $this->info("Dispatched job for reminder ID: {$reminder->id}");
        }
    }
}
