<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

Route::middleware(['auth', 'can:view'])->group(function () {
    Route::get('pagos', [PaymentController::class, 'index'])->middleware('auth')->name('payments.index');
    
    Route::get('pagos/overdue', [PaymentController::class, 'overdue'])->name('payments.overdue');

    Route::get('pagos/crear', [PaymentController::class, 'create'])->middleware('auth')->name('payments.create');

    Route::post('pagos', [PaymentController::class, 'store'])->middleware('auth')->name('payments.store');

    Route::get('pagos/{payment}', [PaymentController::class, 'show'])->middleware('auth')->name('payments.show');

    Route::get('pagos/{payment}/editar', [PaymentController::class, 'edit'])->middleware('auth')->name('payments.edit');

    Route::put('pagos/{payment}', [PaymentController::class, 'update'])->middleware('auth')->name('payments.update');

    Route::delete('pagos/{payment}', [PaymentController::class, 'destroy'])->middleware('auth')->name('payments.destroy');
});