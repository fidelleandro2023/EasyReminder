<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpenseCategoryController;


Route::middleware(['auth', 'can:view'])->group(function () {
    Route::get('expense-categories', [ExpenseCategoryController::class, 'index'])
        ->middleware('auth')
        ->name('expense.categories.index');

    Route::get('expense-categories/create', [ExpenseCategoryController::class, 'create'])
        ->middleware('auth')
        ->name('expense.categories.create');

    Route::post('expense-categories', [ExpenseCategoryController::class, 'store'])
        ->middleware('auth')
        ->name('expense.categories.store');

    Route::get('expense-categories/{expenseCategory}', [ExpenseCategoryController::class, 'show'])
        ->middleware('auth')
        ->name('expense.categories.show');

    Route::get('expense-categories/{expenseCategory}/edit', [ExpenseCategoryController::class, 'edit'])
        ->middleware('auth')
        ->name('expense.categories.edit');

    Route::put('expense-categories/{expenseCategory}', [ExpenseCategoryController::class, 'update'])
        ->middleware('auth')
        ->name('expense.categories.update');

    Route::delete('expense-categories/{expenseCategory}', [ExpenseCategoryController::class, 'destroy'])
        ->middleware('auth')
        ->name('expense.categories.destroy');
});