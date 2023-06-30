<?php

use App\Http\Controllers\Api\AsramaController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RoomController;
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




Route::group(['prefix' => 'v1'], function () {
    // API ROUTE CORE 
    Route::post('login', [LoginController::class, 'login']);
    Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
        return $request->user();
    });
    Route::middleware('auth:sanctum')->get('rooms', [RoomController::class, 'index']);
    Route::middleware('auth:sanctum')->get('asrama', [AsramaController::class, 'index']);
});

