<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermissionController;

Route::middleware(['auth', 'can:view'])->group(function () {
    Route::get('/permisos', [PermissionController::class, 'index'])->name('permissions.index');
    Route::get('/permisos/crear', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('/permisos', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('/permisos/{id}/editar', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::put('/permisos/{id}', [PermissionController::class, 'update'])->name('permissions.update');
    Route::delete('/permisos/{id}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
});
