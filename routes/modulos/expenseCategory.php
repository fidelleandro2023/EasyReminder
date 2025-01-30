<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpenseCategoryController;


Route::middleware(['auth', 'can:view'])->group(function () {
    Route::get('categorias-gastos', [ExpenseCategoryController::class, 'index'])
        ->middleware('auth')
        ->name('expense.categories.index');

    Route::get('categorias-gastos/crear', [ExpenseCategoryController::class, 'create'])
        ->middleware('auth')
        ->name('expense.categories.create');

    Route::post('categorias-gastos', [ExpenseCategoryController::class, 'store'])
        ->middleware('auth')
        ->name('expense.categories.store');

    Route::get('categorias-gastos/{expenseCategory}', [ExpenseCategoryController::class, 'show'])
        ->middleware('auth')
        ->name('expense.categories.show');

    Route::get('categorias-gastos/{expenseCategory}/editar', [ExpenseCategoryController::class, 'edit'])
        ->middleware('auth')
        ->name('expense.categories.edit');

    Route::put('categorias-gastos/{expenseCategory}', [ExpenseCategoryController::class, 'update'])
        ->middleware('auth')
        ->name('expense.categories.update');

    Route::delete('categorias-gastos/{expenseCategory}', [ExpenseCategoryController::class, 'destroy'])
        ->middleware('auth')
        ->name('expense.categories.destroy');
});