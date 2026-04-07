<?php

use App\Http\Controllers\OperationController;
use Illuminate\Support\Facades\Route;

// Main UI
Route::get('/', [OperationController::class, 'index'])->name('operations.index');

// ⚠️ FIXED: Static routes FIRST before any {wildcards}
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