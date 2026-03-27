<?php

use App\Http\Controllers\OperationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Operations Monitoring Routes
|--------------------------------------------------------------------------
| Add these lines to your existing routes/web.php file.
*/

Route::get('/',          [OperationController::class, 'index'])->name('operations.index');
Route::post('/operations',           [OperationController::class, 'store'])->name('operations.store');
Route::patch('/operations/{operation}', [OperationController::class, 'update'])->name('operations.update');
Route::delete('/operations/{operation}', [OperationController::class, 'destroy'])->name('operations.destroy');

Route::post('/operations/{id}/restore', [OperationController::class, 'restore'])->name('operations.restore');
Route::delete('/operations/{id}/force', [OperationController::class, 'forceDelete'])->name('operations.force');
Route::delete('/activity-logs/clear', [OperationController::class, 'clearLogs'])->name('logs.clear');

Route::post('/operations/{id}/restore', [OperationController::class, 'restore'])->name('operations.restore');
Route::delete('/operations/{id}/force', [OperationController::class, 'forceDelete'])->name('operations.force');
Route::delete('/activity-logs/clear', [OperationController::class, 'clearLogs'])->name('logs.clear');

use Illuminate\Support\Facades\Artisan;

Route::get('/run-migrations', function () {
    try {
        // This forces the migration to run on the live database
        Artisan::call('migrate', ['--force' => true]);
        
        // This will print the success message to your browser
        return '<pre>' . Artisan::output() . '</pre>';
    } catch (\Exception $e) {
        // If Aiven blocks it, this will tell us exactly why!
        return "Error: " . $e->getMessage();
    }
});