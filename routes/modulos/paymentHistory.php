<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentHistoryController;

Route::get('payment-histories', [PaymentHistoryController::class, 'index'])
    ->middleware('auth')
    ->name('payments.history');

Route::get('payment-histories/create', [PaymentHistoryController::class, 'create'])
    ->middleware('auth')
    ->name('payment_histories.create');

Route::post('payment-histories', [PaymentHistoryController::class, 'store'])
    ->middleware('auth')
    ->name('payment_histories.store');

Route::get('payment-histories/{paymentHistory}', [PaymentHistoryController::class, 'show'])
    ->middleware('auth')
    ->name('payment_histories.show');

Route::delete('payment-histories/{paymentHistory}', [PaymentHistoryController::class, 'destroy'])
    ->middleware('auth')
    ->name('payment_histories.destroy');
