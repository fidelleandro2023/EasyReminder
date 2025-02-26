<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;

Route::middleware(['auth', 'can:view'])->group(function () {
    Route::get('/menus', [MenuController::class, 'index'])->name('menus.index');
    Route::get('/menus/crear', [MenuController::class, 'create'])->name('menus.create');
    Route::post('/menus', [MenuController::class, 'store'])->name('menus.store');
    Route::get('/menus/{menu}/edit', [MenuController::class, 'edit'])->name('menus.edit');
    Route::put('/menus/{menu}', [MenuController::class, 'update'])->name('menus.update');
    Route::delete('/menus/{menu}', [MenuController::class, 'destroy'])->name('menus.destroy');
});
