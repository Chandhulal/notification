<?php

namespace App\Services;

use App\Repositories\ReminderRepository;

class ReminderService
{
    /**
     * Create a new class instance.
     */
    protected ReminderRepository $reminderRepository;

    public function __construct(ReminderRepository $reminderRepository)
    {
        $this->reminderRepository = $reminderRepository;
    }
    
    public function createReminder(array $data)
    {
        $reminder = $this->reminderRepository->create($data);
        if ($reminder) {
            return ['success' => true, 'message' => 'Reminder created successfully', 'data' => $reminder];
        }
        return ['success' => false, 'message' => 'Failed to create reminder'];
    }

    public function deleteReminder(int $id)
    {
        $deleted = $this->reminderRepository->delete($id);
        if ($deleted) {
            return ['success' => true, 'message' => 'Reminder deleted successfully'];
        }
        return ['success' => false, 'message' => 'Failed to delete reminder'];
    }

    public function getReminders()
    {
        $id = auth()->id();
        $reminders = $this->reminderRepository->getAll($id);
        if ($reminders) {
            $reminders = $reminders->map(function ($reminder) {
                return [
                    'id' => encrypt_id($reminder->id),
                    'title' => $reminder->title,
                    'description' => $reminder->description,
                    'remind_at' => $reminder->remind_at,
                    'is_send' => $reminder->is_send,
                ];
            });
            return ['success' => true, 'message' => 'Reminders retrieved successfully', 'data' => $reminders];
        }
        return ['success' => false, 'message' => 'Failed to retrieve reminders'];
    }

    public function updateReminder(int $id, array $data)
    {
        $reminder = $this->reminderRepository->find($id);
        if ($reminder) {
            $reminder->update($data);
            return ['success' => true, 'message' => 'Reminder updated successfully'];
        }
        return ['success' => false, 'message' => 'Failed to update reminder'];
    }
}
