<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceEntityController;


Route::middleware(['auth', 'can:view'])->group(function () {
    Route::get('service-entity', [ServiceEntityController::class, 'index'])
        ->middleware('auth')
        ->name('service_entities.index');

    Route::get('service-entity/create', [ServiceEntityController::class, 'create'])
        ->middleware('auth')
        ->name('service_entities.create');

    Route::post('service-entity', [ServiceEntityController::class, 'store'])
        ->middleware('auth')
        ->name('service_entities.store');

    Route::get('service-entity/{serviceEntity}', [ServiceEntityController::class, 'show'])
        ->middleware('auth')
        ->name('service_entities.show');

    Route::get('service-entity/{serviceEntity}/edit', [ServiceEntityController::class, 'edit'])
        ->middleware('auth')
        ->name('service_entities.edit');

    Route::put('service-entity/{serviceEntity}', [ServiceEntityController::class, 'update'])
        ->middleware('auth')
        ->name('service_entities.update');

    Route::delete('service-entity/{serviceEntity}', [ServiceEntityController::class, 'destroy'])
        ->middleware('auth')
        ->name('service_entities.destroy');
});