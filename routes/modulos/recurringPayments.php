<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecurringPaymentController;


Route::middleware(['auth', 'can:view'])->group(function () {
    Route::get('pagos-recurrentes', [RecurringPaymentController::class, 'index'])
        ->middleware('auth')
        ->name('recurring_payments.index');

    Route::get('pagos-recurrentes/crear', [RecurringPaymentController::class, 'create'])
        ->middleware('auth')
        ->name('recurring_payments.create');

    Route::post('pagos-recurrentes', [RecurringPaymentController::class, 'store'])
        ->middleware('auth')
        ->name('recurring_payments.store');

    Route::get('pagos-recurrentes/{recurringPayment}', [RecurringPaymentController::class, 'show'])
        ->middleware('auth')
        ->name('recurring_payments.show');

    Route::get('pagos-recurrentes/{recurringPayment}/editar', [RecurringPaymentController::class, 'edit'])
        ->middleware('auth')
        ->name('recurring_payments.edit');

    Route::put('pagos-recurrentes/{recurringPayment}', [RecurringPaymentController::class, 'update'])
        ->middleware('auth')
        ->name('recurring_payments.update');

    Route::delete('pagos-recurrentes/{recurringPayment}', [RecurringPaymentController::class, 'destroy'])
        ->middleware('auth')
        ->name('recurring_payments.destroy');
});