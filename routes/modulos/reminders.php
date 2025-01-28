<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReminderController;

Route::middleware(['auth', 'can:view'])->group(function () {
Route::get('reminders', [ReminderController::class, 'index'])
    ->middleware('auth')
    ->name('reminders.index');

Route::get('reminders/create', [ReminderController::class, 'create'])
    ->middleware('auth')
    ->name('reminders.create');

Route::post('reminders', [ReminderController::class, 'store'])
    ->middleware('auth')
    ->name('reminders.store');

Route::get('reminders/{reminder}', [ReminderController::class, 'show'])
    ->middleware('auth')
    ->name('reminders.show');

Route::get('reminders/{reminder}/edit', [ReminderController::class, 'edit'])
    ->middleware('auth')
    ->name('reminders.edit');

Route::put('reminders/{reminder}', [ReminderController::class, 'update'])
    ->middleware('auth')
    ->name('reminders.update');

Route::delete('reminders/{reminder}', [ReminderController::class, 'destroy'])
    ->middleware('auth')
    ->name('reminders.destroy');
});