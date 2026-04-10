<?php

use App\Http\Controllers\OperationController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

// ══ AUTH ROUTES (guests only) ══
Route::get('/login', [LoginController::class, 'showForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->name('login.post')->middleware('guest');
Route::post('/register', [LoginController::class, 'register'])->name('register')->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// ══ PROTECTED ROUTES (must be logged in) ══
Route::middleware('auth')->group(function () {

    // Main UI
    Route::get('/', [OperationController::class, 'index'])->name('operations.index');

    // ⚠️ Static routes FIRST before any {wildcards}
    Route::delete('/operations/trash/empty', [OperationController::class, 'emptyBin'])->name('operations.emptyBin');

    // Add, Edit, Soft Delete
    Route::post('/operations', [OperationController::class, 'store'])->name('operations.store');
    Route::patch('/operations/{operation}', [OperationController::class, 'update'])->name('operations.update');
    Route::delete('/operations/{operation}', [OperationController::class, 'destroy'])->name('operations.destroy');

    // Recycle Bin Actions
    Route::post('/operations/{id}/restore', [OperationController::class, 'restore'])->name('operations.restore');
    Route::delete('/operations/{id}/force', [OperationController::class, 'forceDelete'])->name('operations.force');

    // Archive Actions
    Route::post('/operations/{id}/archive', [OperationController::class, 'archive'])->name('operations.archive');
    Route::post('/operations/{id}/unarchive', [OperationController::class, 'unarchive'])->name('operations.unarchive');

    // Clear Logs
    Route::delete('/activity-logs/clear', [OperationController::class, 'clearLogs'])->name('logs.clear');

    // ══ FORGOT PASSWORD ══
    Route::get('/forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showForm'])
        ->name('password.request')->middleware('guest');

    Route::post('/forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendLink'])
        ->name('password.email')->middleware('guest');

    Route::get('/reset-password/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showForm'])
        ->name('password.reset')->middleware('guest');

    Route::post('/reset-password', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])
        ->name('password.update')->middleware('guest');

});