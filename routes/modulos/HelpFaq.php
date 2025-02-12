<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelpFaqController;

Route::prefix('help-faqs')->group(function () {
    Route::get('/', [HelpFaqController::class, 'index'])->name('help-faqs.index');;
    Route::get('/active', [HelpFaqController::class, 'activeFaqs'])->name('help-faqs.actve');;
    Route::post('/', [HelpFaqController::class, 'store'])->name('help-faqs.store');;
    Route::get('/{id}', [HelpFaqController::class, 'show'])->name('help-faqs.show');;
    Route::put('/{id}', [HelpFaqController::class, 'update'])->name('help-faqs.update');;
    Route::delete('/{id}', [HelpFaqController::class, 'destroy'])->name('help-faqs.destroy');;
});
