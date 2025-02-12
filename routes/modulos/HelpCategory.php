<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelpCategoryController;

Route::prefix('help-categories')->group(function () {
    Route::get('/', [HelpCategoryController::class, 'index'])->name('help-categories.index');
    Route::get('/create', [HelpCategoryController::class, 'create'])->name('help-categories.create');
    Route::get('/active', [HelpCategoryController::class, 'activeCategories'])->name('help-categories.active');
    Route::post('/', [HelpCategoryController::class, 'store'])->name('help-categories.store');
    Route::get('/{id}', [HelpCategoryController::class, 'show'])->name('help-categories.show');
    Route::get('/{id}/edit', [HelpCategoryController::class, 'edit'])->name('help-categories.edit');
    Route::put('/{id}', [HelpCategoryController::class, 'update'])->name('help-categories.update');
    Route::delete('/{id}', [HelpCategoryController::class, 'destroy'])->name('help-categories.destroy');
});
