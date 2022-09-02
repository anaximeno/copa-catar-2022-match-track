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
    Route::apiResource('confrontos', \App\Http\Controllers\ConfrontoController::class);
    Route::apiResource('substituicoes', \App\Http\Controllers\SubstituicaoController::class);
    Route::apiResource('confrontos/{id_confronto}/jogadores', \App\Http\Controllers\JogadorEmCampoController::class);
    Route::apiResource('gols', \App\Http\Controllers\GolsController::class);
    Route::apiResource('cartoes', \App\Http\Controllers\CartaoController::class);

    Route::get('equipes/{id_equipa}/jogadores',
        [\App\Http\Controllers\EquipesController::class, 'jogadores'
    ]);
    Route::get('equipes/{id_equipa}/jogadores/{id}',
        [\App\Http\Controllers\EquipesController::class, 'jogador'
    ]);
    Route::get('equipes/{id_equipa}/confrontos',
        [\App\Http\Controllers\EquipesController::class, 'confrontos'
    ]);
    Route::get('arbitros/{id_arbitro}/confrontos',
        [\App\Http\Controllers\ArbitroController::class, 'confrontos'
    ]);
    Route::get('arbitros/{id_arbitro}/confrontos/{id}',
        [\App\Http\Controllers\ArbitroController::class, 'confronto'
    ]);
});