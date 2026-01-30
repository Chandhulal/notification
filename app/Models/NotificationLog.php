<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'reminder_id',
        'channel',
        'status',
        'error_message',
        'created_at',
    ];

    public function reminder()
    {
        return $this->belongsTo(Reminder::class, 'reminder_id');
    }
}
