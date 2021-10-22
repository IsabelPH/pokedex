<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PokemonController;
use App\Http\Controllers\TipoController;
use App\Http\Controllers\UserController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::apiResource('usuarios', UserController::class);
//POST -store -no lleva id
//PUT- update
//GET - (1 resuro) -show
//GET - (todos los recursos) - index -no lleva id
// delete - destroy

Route::apiResource('pokemons', PokemonController::class);
Route::apiResource('tipos', TipoController::class);



Route::post('/login', [LoginController::class, 'login']);