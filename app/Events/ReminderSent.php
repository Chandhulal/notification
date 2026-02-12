<?php

namespace App\Events;

use App\Models\Reminder;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReminderSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $reminder;

    public function __construct(Reminder $reminder)
    {
        $this->reminder = [
            'id' => $reminder->id,
            'title' => $reminder->title,
            'description' => $reminder->description,
            'remind_at' => $reminder->remind_at,
        ];
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('reminders'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'reminder.sent';
    }
}
