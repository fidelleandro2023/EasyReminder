<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpenseAnalysisController;

Route::middleware(['auth', 'can:view'])->group(function () {
    Route::get('analisis-gastos', [ExpenseAnalysisController::class, 'index'])
        ->middleware('auth')
        ->name('expense.analysis');

    Route::get('analisis-gastos/crear', [ExpenseAnalysisController::class, 'create'])
        ->middleware('auth')
        ->name('expense.analysis.create');

    Route::post('analisis-gastos', [ExpenseAnalysisController::class, 'store'])
        ->middleware('auth')
        ->name('expense.analysis.store');

    Route::get('analisis-gastos/{expenseAnalysis}', [ExpenseAnalysisController::class, 'show'])
        ->middleware('auth')
        ->name('expense.analysis.show');

    Route::delete('analisis-gastos/{expenseAnalysis}', [ExpenseAnalysisController::class, 'destroy'])
        ->middleware('auth')
        ->name('expense.analysis.destroy');
});