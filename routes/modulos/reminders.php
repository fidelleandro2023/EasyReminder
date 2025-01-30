<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReminderController;

Route::middleware(['auth', 'can:view'])->group(function () {
Route::get('recordatorios', [ReminderController::class, 'index'])
    ->middleware('auth')
    ->name('reminders.index');

Route::get('recordatorios/crear', [ReminderController::class, 'create'])
    ->middleware('auth')
    ->name('reminders.create');

Route::post('recordatorios', [ReminderController::class, 'store'])
    ->middleware('auth')
    ->name('reminders.store');

Route::get('recordatorios/{reminder}', [ReminderController::class, 'show'])
    ->middleware('auth')
    ->name('reminders.show');

Route::get('recordatorios/{reminder}/editar', [ReminderController::class, 'edit'])
    ->middleware('auth')
    ->name('reminders.edit');

Route::put('recordatorios/{reminder}', [ReminderController::class, 'update'])
    ->middleware('auth')
    ->name('reminders.update');

Route::delete('recordatorios/{reminder}', [ReminderController::class, 'destroy'])
    ->middleware('auth')
    ->name('reminders.destroy');
});