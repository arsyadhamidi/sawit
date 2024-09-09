<?php

use App\Http\Controllers\Api\ApiDashboardPageController;
use App\Http\Controllers\Api\ApiLoginController;
use App\Http\Controllers\Api\ApiPetaniPageController;
use App\Http\Controllers\Api\ApiRegistrasiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login-action', [ApiLoginController::class, 'authenticate']);
Route::post('register-action', [ApiRegistrasiController::class, 'register']);
Route::get('/harga-sawit', [ApiDashboardPageController::class, 'hargasawit']);
Route::get('/data-petani/{id}', [ApiPetaniPageController::class, 'index']);
Route::post('/data-petani/update/{id}', [ApiPetaniPageController::class, 'update']);
