<?php

namespace App\Http\Controllers;

use App\Services\ReminderService;
use Illuminate\Http\Request;

class ReminderController extends Controller
{
    protected ReminderService $reminderService;

    public function __construct(ReminderService $reminderService)
    {
        $this->reminderService = $reminderService;
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'remind_at' => 'required|date',
        ]);

        $reminder = $this->reminderService->createReminder($validatedData);

        if ($reminder['success']) {
            return api_success($reminder['message'], $reminder['data']);
        }

        return api_error(false, $reminder['message']);
    }

    public function destroy($id)
    {
        $id = decrypt_id($id);
        if($id <= 0){
            return ['success' => false, 'message' => 'Invalid Reminder ID'];
        }   
        $deleted = $this->reminderService->deleteReminder($id);

        if ($deleted['success']) {
            return api_success(true, $deleted['message']);
        }

        return api_error(false, $deleted['message']);
    }

    public function index()
    {
        $reminders = $this->reminderService->getReminders();

        if ($reminders['success']) {
            return api_success(true, $reminders['message'], $reminders['data']);
        }

        return api_error(false, $reminders['message']);
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string',
            'remind_at' => 'sometimes|required|date',
        ]);

        $id = decrypt_id($id);
        if($id <= 0 && !is_int($id)){
            return api_error(false, 'Invalid Reminder ID');
        }

        $updated = $this->reminderService->updateReminder($id, $validatedData);

        if ($updated['success']) {
            return api_success(true, $updated['message']);
        }

        return api_error(false, $updated['message']);
    }
}
