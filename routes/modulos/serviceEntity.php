<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceEntityController;

Route::get('service-entity', [ServiceEntityController::class, 'index'])
    ->middleware('auth')
    ->name('service-entity.index');

Route::get('service-entity/create', [ServiceEntityController::class, 'create'])
    ->middleware('auth')
    ->name('service-entity.create');

Route::post('service-entity', [ServiceEntityController::class, 'store'])
    ->middleware('auth')
    ->name('service-entity.store');

Route::get('service-entity/{serviceEntity}', [ServiceEntityController::class, 'show'])
    ->middleware('auth')
    ->name('service-entity.show');

Route::get('service-entity/{serviceEntity}/edit', [ServiceEntityController::class, 'edit'])
    ->middleware('auth')
    ->name('service-entity.edit');

Route::put('service-entity/{serviceEntity}', [ServiceEntityController::class, 'update'])
    ->middleware('auth')
    ->name('service-entity.update');

Route::delete('service-entity/{serviceEntity}', [ServiceEntityController::class, 'destroy'])
    ->middleware('auth')
    ->name('service-entity.destroy');
