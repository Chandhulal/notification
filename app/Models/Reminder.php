<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reminder extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'remind_at',
        'status',
        'sent_at',
    ];

    protected $casts = [
        'remind_at' => 'datetime',
        'status' => 'string',
        'sent_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function notification_logs()
    {
        return $this->hasMany(NotificationLog::class, 'reminder_id');
    }
}
