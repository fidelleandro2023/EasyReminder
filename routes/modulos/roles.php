<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;

Route::middleware(['auth', 'can:view,manage_roles'])->group(function () {
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit'); // Cambiado {id} por {role}
    Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');  // Cambiado {id} por {role}
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy'); // Cambiado {id} por {role}
});