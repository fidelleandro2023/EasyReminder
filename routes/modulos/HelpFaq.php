<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelpFaqController;

Route::prefix('help-faqs')->group(function () {
    Route::get('/', [HelpFaqController::class, 'index']);
    Route::get('/active', [HelpFaqController::class, 'activeFaqs']);
    Route::post('/', [HelpFaqController::class, 'store']);
    Route::get('/{id}', [HelpFaqController::class, 'show']);
    Route::put('/{id}', [HelpFaqController::class, 'update']);
    Route::delete('/{id}', [HelpFaqController::class, 'destroy']);
});
