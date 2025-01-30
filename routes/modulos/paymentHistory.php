<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentHistoryController;

Route::middleware(['auth', 'can:view'])->group(function () {
    Route::get('historial-pagos', [PaymentHistoryController::class, 'index'])
        ->middleware('auth')
        ->name('payment_histories');

    Route::get('historial-pagos/crear', [PaymentHistoryController::class, 'create'])
        ->middleware('auth')
        ->name('payment_histories.create');

    Route::post('historial-pagos', [PaymentHistoryController::class, 'store'])
        ->middleware('auth')
        ->name('payment_histories.store');

    Route::get('historial-pagos/{paymentHistory}', [PaymentHistoryController::class, 'show'])
        ->middleware('auth')
        ->name('payment_histories.show');

    Route::delete('historial-pagos/{paymentHistory}', [PaymentHistoryController::class, 'destroy'])
        ->middleware('auth')
        ->name('payment_histories.destroy');
});