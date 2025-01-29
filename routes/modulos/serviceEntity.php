<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceEntityController;

Route::middleware(['auth', 'can:view'])->group(function () {
    Route::get('servicios', [ServiceEntityController::class, 'index'])
        ->middleware('auth')
        ->name('service_entities.index');

    Route::get('servicios/crear', [ServiceEntityController::class, 'create'])
        ->middleware('auth')
        ->name('service_entities.create');

    Route::post('servicios', [ServiceEntityController::class, 'store'])
        ->middleware('auth')
        ->name('service_entities.store');

    Route::get('servicios/{serviceEntity}', [ServiceEntityController::class, 'show'])
        ->middleware('auth')
        ->name('service_entities.show');

    Route::get('servicios/{serviceEntity}/editar', [ServiceEntityController::class, 'edit'])
        ->middleware('auth')
        ->name('service_entities.edit');

    Route::put('servicios/{serviceEntity}', [ServiceEntityController::class, 'update'])
        ->middleware('auth')
        ->name('service_entities.update');

    Route::delete('servicios/{serviceEntity}', [ServiceEntityController::class, 'destroy'])
        ->middleware('auth')
        ->name('service_entities.destroy');
});