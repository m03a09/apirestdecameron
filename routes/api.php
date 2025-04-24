<?php

use App\Http\Controllers\AcomodacionController;
use App\Http\Controllers\CiudadController;
use App\Http\Controllers\HabitacionController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\TipoHabitacionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rutas para Ciudades
Route::prefix('ciudades')->group(function () {
    Route::post('/', [CiudadController::class, 'create']);
    Route::get('/{id}', [CiudadController::class, 'show']);
    Route::get('/', [CiudadController::class, 'showall']);
    Route::put('/{id}', [CiudadController::class, 'update']);
    Route::delete('/{id}', [CiudadController::class, 'delete']);
});

// Rutas para Hoteles
Route::prefix('hoteles')->group(function () {
    Route::post('/', [HotelController::class, 'create']);
    Route::get('/{id}', [HotelController::class, 'show']);
    Route::get('/', [HotelController::class, 'showall']);
    Route::put('/{id}', [HotelController::class, 'update']);
    Route::delete('/{id}', [HotelController::class, 'delete']);
});

// Rutas para Tipos de Habitación
Route::prefix('tipos-habitacion')->group(function () {
    Route::post('/', [TipoHabitacionController::class, 'create']);
    Route::get('/{id}', [TipoHabitacionController::class, 'show']);
    Route::get('/', [TipoHabitacionController::class, 'showall']);
    Route::put('/{id}', [TipoHabitacionController::class, 'update']);
    Route::delete('/{id}', [TipoHabitacionController::class, 'delete']);
});

// Rutas para Acomodaciones
Route::prefix('acomodaciones')->group(function () {
    Route::post('/', [AcomodacionController::class, 'create']);
    Route::get('/{id}', [AcomodacionController::class, 'show']);
    Route::get('/', [AcomodacionController::class, 'showall']);
    Route::put('/{id}', [AcomodacionController::class, 'update']);
    Route::delete('/{id}', [AcomodacionController::class, 'delete']);
});

// Rutas para Habitaciones
Route::prefix('habitaciones')->group(function () {
    Route::post('/', [HabitacionController::class, 'create']);
    Route::get('/{id}', [HabitacionController::class, 'show']);
    Route::get('/', [HabitacionController::class, 'showall']);
    Route::put('/{id}', [HabitacionController::class, 'update']);
    Route::delete('/{id}', [HabitacionController::class, 'delete']);
});
