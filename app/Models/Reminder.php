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
        'is_send',
    ];

    protected $casts = [
        'remind_at' => 'datetime',
        'is_send' => 'boolean',
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
