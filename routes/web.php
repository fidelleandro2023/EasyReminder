<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;  

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
 
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
});
 
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');
 
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () { 
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
 

include "modulos/auditLogs.php";
include "modulos/budget.php";
include "modulos/expenseAnalysis.php";
include "modulos/expenseCategory.php";
include "modulos/notifications.php";
include "modulos/payments.php"; 
include "modulos/paymentHistory.php";
include "modulos/recurringPayments.php";
include "modulos/reminders.php";
include "modulos/serviceEntity.php";
include "modulos/users.php";
include "modulos/userSettings.php";