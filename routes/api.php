<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\AuthController;

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('reminder')->group(function () {
        Route::post('/create-reminder', [ReminderController::class, 'store'])->name('create-reminder');
        Route::delete('/delete-reminder/{id}', [ReminderController::class, 'destroy'])->name('delete-reminder');
        Route::get('/get-reminders', [ReminderController::class, 'index'])->name('get-reminders');
        Route::patch('/update-reminder/{id}', [ReminderController::class, 'update'])->name('update-reminder');
    });
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
