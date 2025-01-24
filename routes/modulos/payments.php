<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
 
Route::get('payments', [PaymentController::class, 'index'])->middleware('auth');
 
Route::get('payments/create', [PaymentController::class, 'create'])->middleware('auth');
 
Route::post('payments', [PaymentController::class, 'store'])->middleware('auth');
 
Route::get('payments/{payment}', [PaymentController::class, 'show'])->middleware('auth');
 
Route::get('payments/{payment}/edit', [PaymentController::class, 'edit'])->middleware('auth');
 
Route::put('payments/{payment}', [PaymentController::class, 'update'])->middleware('auth');

Route::delete('payments/{payment}', [PaymentController::class, 'destroy'])->middleware('auth');