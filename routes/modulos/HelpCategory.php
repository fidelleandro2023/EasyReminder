<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelpCategoryController;

Route::prefix('help-categories')->group(function () {
    Route::get('/', [HelpCategoryController::class, 'index']);
    Route::get('/active', [HelpCategoryController::class, 'activeCategories']);
    Route::post('/', [HelpCategoryController::class, 'store']);
    Route::get('/{id}', [HelpCategoryController::class, 'show']);
    Route::put('/{id}', [HelpCategoryController::class, 'update']);
    Route::delete('/{id}', [HelpCategoryController::class, 'destroy']);
});
