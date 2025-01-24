<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

Route::get('payments', [PaymentController::class, 'index'])->middleware('auth')->name('payments.index');

Route::get('payments/create', [PaymentController::class, 'create'])->middleware('auth')->name('payments.create');

Route::post('payments', [PaymentController::class, 'store'])->middleware('auth')->name('payments.store');

Route::get('payments/{payment}', [PaymentController::class, 'show'])->middleware('auth')->name('payments.show');

Route::get('payments/{payment}/edit', [PaymentController::class, 'edit'])->middleware('auth')->name('payments.edit');

Route::put('payments/{payment}', [PaymentController::class, 'update'])->middleware('auth')->name('payments.update');

Route::delete('payments/{payment}', [PaymentController::class, 'destroy'])->middleware('auth')->name('payments.destroy');
