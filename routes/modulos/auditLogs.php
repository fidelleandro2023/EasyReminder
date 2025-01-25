<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuditLogController;

Route::get('audit-logs', [AuditLogController::class, 'index'])
    ->middleware('auth')
    ->name('audit-logs.index');

Route::get('audit-logs/{auditLog}', [AuditLogController::class, 'show'])
    ->middleware('auth')
    ->name('audit-logs.show');
