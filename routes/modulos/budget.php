<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BudgetController;

Route::middleware(['auth', 'can:view'])->group(function () {
    Route::get('presupuestos', [BudgetController::class, 'index'])
        ->middleware('auth')
        ->name('budgets.index');

    Route::get('presupuestos/crear', [BudgetController::class, 'create'])
        ->middleware('auth')
        ->name('budgets.create');

    Route::post('presupuestos', [BudgetController::class, 'store'])
        ->middleware('auth')
        ->name('budgets.store');

    Route::get('presupuestos/{budget}', [BudgetController::class, 'show'])
        ->middleware('auth')
        ->name('budgets.show');

    Route::get('presupuestos/{budget}/edit', [BudgetController::class, 'edit'])
        ->middleware('auth')
        ->name('budgets.edit');

    Route::put('presupuestos/{budget}', [BudgetController::class, 'update'])
        ->middleware('auth')
        ->name('budgets.update');

    Route::delete('presupuestos/{budget}', [BudgetController::class, 'destroy'])
        ->middleware('auth')
        ->name('budgets.destroy');
});