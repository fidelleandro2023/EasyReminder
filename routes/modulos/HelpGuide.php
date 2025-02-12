<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelpGuideController;

Route::prefix('help-guides')->name('help_guides.')->group(function () {
    //Route::get('/help/documentation', [HelpController::class, 'documentation'])->name('help.documentation');

    Route::get('/', [HelpGuideController::class, 'index'])->name('index');
    Route::get('/create', [HelpGuideController::class, 'create'])->name('create');
    Route::post('/', [HelpGuideController::class, 'store'])->name('store');
    Route::get('/{slug}', [HelpGuideController::class, 'show'])->name('show');
    Route::get('/{slug}/edit', [HelpGuideController::class, 'edit'])->name('edit');
    Route::put('/{slug}', [HelpGuideController::class, 'update'])->name('update');
    Route::delete('/{slug}', [HelpGuideController::class, 'destroy'])->name('destroy');
});
