<?php

namespace App\Repositories;

use App\Models\Reminder;

class ReminderRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function create(array $data)
    {
        Reminder::create([
            'user_id'      => 1,
            // 'user_id'      => auth()->id(),
            'title'        => $data['title'],
            'description'  => $data['description'] ?? null,
            'remind_at'  => $data['remind_at'],
            'is_send'      => false,
        ]);

        return true;
    }

    public function delete(int $id)
    {
        $reminder = Reminder::find($id);
        if ($reminder) {
            $reminder->delete();
            return true;
        }
        return false;
    }
}
