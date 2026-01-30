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
}
