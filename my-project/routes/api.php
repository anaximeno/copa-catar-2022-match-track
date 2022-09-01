<?php

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

Route::prefix('v1')->group(function() {
    Route::apiResource('jogadores', \App\Http\Controllers\JogadorController::class);
    Route::apiResource('equipes', \App\Http\Controllers\EquipesController::class);
    Route::apiResource('arbitros', \App\Http\Controllers\ArbitroController::class);
});