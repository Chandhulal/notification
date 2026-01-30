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
}
