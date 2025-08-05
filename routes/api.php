<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\RolController;

/* Route::middleware('api')->group(function () {
    Route::apiResource('empleados', EmpleadoController::class);
}); */
Route::get('test-api', function () {
    return response()->json(['ok' => true]);
});

Route::get('areas', [AreaController::class, 'index']);
Route::get('roles', [RolController::class, 'index']);