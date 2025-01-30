<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::middleware(['auth'])->group(function () {
    Route::get('usuarios', [UserController::class, 'index'])->name('users.index'); 
    Route::get('usuarios/crear', [UserController::class, 'create'])->name('users.create');
    Route::post('usuarios', [UserController::class, 'store'])->name('users.store');
    Route::get('usuarios/{user}', [UserController::class, 'show'])->name('users.show'); 
    Route::get('usuarios/{user}/editar', [UserController::class, 'edit'])->name('users.edit'); 
    Route::put('usuarios/{user}', [UserController::class, 'update'])->name('users.update'); 
    Route::delete('usuarios/{user}', [UserController::class, 'destroy'])->name('users.destroy'); 
});
