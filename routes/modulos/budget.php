<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BudgetController;

Route::middleware(['auth', 'can:view'])->group(function () {
    Route::get('budgets', [BudgetController::class, 'index'])
        ->middleware('auth')
        ->name('budgets.index');

    Route::get('budgets/create', [BudgetController::class, 'create'])
        ->middleware('auth')
        ->name('budgets.create');

    Route::post('budgets', [BudgetController::class, 'store'])
        ->middleware('auth')
        ->name('budgets.store');

    Route::get('budgets/{budget}', [BudgetController::class, 'show'])
        ->middleware('auth')
        ->name('budgets.show');

    Route::get('budgets/{budget}/edit', [BudgetController::class, 'edit'])
        ->middleware('auth')
        ->name('budgets.edit');

    Route::put('budgets/{budget}', [BudgetController::class, 'update'])
        ->middleware('auth')
        ->name('budgets.update');

    Route::delete('budgets/{budget}', [BudgetController::class, 'destroy'])
        ->middleware('auth')
        ->name('budgets.destroy');
});