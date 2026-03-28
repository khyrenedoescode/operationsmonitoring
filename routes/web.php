<?php

use App\Http\Controllers\OperationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Operations Monitoring Routes
|--------------------------------------------------------------------------
*/

// Main UI
Route::get('/', [OperationController::class, 'index'])->name('operations.index');

// Add, Edit, Soft Delete (Move to Bin)
Route::post('/operations', [OperationController::class, 'store'])->name('operations.store');
Route::patch('/operations/{operation}', [OperationController::class, 'update'])->name('operations.update');
Route::delete('/operations/{operation}', [OperationController::class, 'destroy'])->name('operations.destroy');

// Recycle Bin Actions (Restore & Force Delete Individual)
Route::post('/operations/{id}/restore', [OperationController::class, 'restore'])->name('operations.restore');
Route::delete('/operations/{id}/force', [OperationController::class, 'forceDelete'])->name('operations.force');

// THE NEW FIXES: Empty Entire Bin & Clear Logs from Database
Route::delete('/operations/trash/empty', [OperationController::class, 'emptyBin'])->name('operations.emptyBin');
Route::delete('/activity-logs/clear', [OperationController::class, 'clearLogs'])->name('logs.clear');