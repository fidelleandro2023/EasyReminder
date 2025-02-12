<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelpVideoController;

Route::middleware(['auth', 'can:view'])->group(function () {
    Route::get('help-videos/', [HelpVideoController::class, 'index'])->name('help-videos.index');
    Route::get('help-videos/create', [HelpVideoController::class, 'create'])->name('help-videos.create');
    Route::post('help-videos/', [HelpVideoController::class, 'store'])->name('help-videos.store');
    Route::get('help-videos/{video}', [HelpVideoController::class, 'show'])->name('help-videos.show');
    Route::get('help-videos/{video}/edit', [HelpVideoController::class, 'edit'])->name('help-videos.edit');
    Route::put('help-videos/{video}', [HelpVideoController::class, 'update'])->name('help-videos.update');
    Route::delete('help-videos/{video}', [HelpVideoController::class, 'destroy'])->name('help-videos.destroy');
});
