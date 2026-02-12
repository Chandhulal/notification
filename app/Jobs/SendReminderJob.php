<?php

namespace App\Jobs;

use App\Events\ReminderSent;
use App\Mail\ReminderMail;
use App\Models\Reminder;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendReminderJob implements ShouldQueue
{
    use Queueable;

    protected $reminder;

    public function __construct($reminder)
    {
        $this->reminder = $reminder;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->reminder->user->email)
        ->send(new ReminderMail($this->reminder));

        $this->reminder->update([
            'status' => 'sent',
            'sent_at' => now()
        ]);

        event(new ReminderSent($this->reminder));
    }

    public function failed(\Throwable $exception)
    {
        $this->reminder->update([
            'status' => 'failed',
        ]);
    }
}
