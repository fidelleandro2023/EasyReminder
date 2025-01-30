<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;

Route::middleware('auth')->group(function () {
    Route::get('notificaciones', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('notificaciones/{notification}', [NotificationController::class, 'show'])->name('notifications.show');
    Route::put('notificaciones/{notification}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-as-read');
    Route::delete('notificaciones/{notification}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
});
