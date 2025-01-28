<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecurringPaymentController;

Route::middleware(['auth', 'can:view'])->group(function () {
    Route::get('recurring-payments', [RecurringPaymentController::class, 'index'])
        ->middleware('auth')
        ->name('recurring_payments.index');

    Route::get('recurring-payments/create', [RecurringPaymentController::class, 'create'])
        ->middleware('auth')
        ->name('recurring_payments.create');

    Route::post('recurring-payments', [RecurringPaymentController::class, 'store'])
        ->middleware('auth')
        ->name('recurring_payments.store');

    Route::get('recurring-payments/{recurringPayment}', [RecurringPaymentController::class, 'show'])
        ->middleware('auth')
        ->name('recurring_payments.show');

    Route::get('recurring-payments/{recurringPayment}/edit', [RecurringPaymentController::class, 'edit'])
        ->middleware('auth')
        ->name('recurring_payments.edit');

    Route::put('recurring-payments/{recurringPayment}', [RecurringPaymentController::class, 'update'])
        ->middleware('auth')
        ->name('recurring_payments.update');

    Route::delete('recurring-payments/{recurringPayment}', [RecurringPaymentController::class, 'destroy'])
        ->middleware('auth')
        ->name('recurring_payments.destroy');
});