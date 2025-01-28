<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserSettingController;

Route::middleware(['auth', 'can:view'])->group(function () {
    Route::get('user-settings', [UserSettingController::class, 'index'])
        ->middleware('auth')
        ->name('user-settings.index');

    Route::get('user-settings/create', [UserSettingController::class, 'create'])
        ->middleware('auth')
        ->name('user-settings.create');

    Route::post('user-settings', [UserSettingController::class, 'store'])
        ->middleware('auth')
        ->name('user-settings.store');

    Route::get('user-settings/{userSetting}/edit', [UserSettingController::class, 'edit'])
        ->middleware('auth')
        ->name('user-settings.edit');

    Route::put('user-settings/{userSetting}', [UserSettingController::class, 'update'])
        ->middleware('auth')
        ->name('user-settings.update');

    Route::delete('user-settings/{userSetting}', [UserSettingController::class, 'destroy'])
        ->middleware('auth')
        ->name('user-settings.destroy');
});