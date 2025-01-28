<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpenseAnalysisController;

Route::middleware(['auth', 'can:view'])->group(function () {
    Route::get('expense-analysis', [ExpenseAnalysisController::class, 'index'])
        ->middleware('auth')
        ->name('expense.analysis');

    Route::get('expense-analysis/create', [ExpenseAnalysisController::class, 'create'])
        ->middleware('auth')
        ->name('expense.analysis.create');

    Route::post('expense-analysis', [ExpenseAnalysisController::class, 'store'])
        ->middleware('auth')
        ->name('expense.analysis.store');

    Route::get('expense-analysis/{expenseAnalysis}', [ExpenseAnalysisController::class, 'show'])
        ->middleware('auth')
        ->name('expense.analysis.show');

    Route::delete('expense-analysis/{expenseAnalysis}', [ExpenseAnalysisController::class, 'destroy'])
        ->middleware('auth')
        ->name('expense.analysis.destroy');
});