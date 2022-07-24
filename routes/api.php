<?php

use App\Http\Controllers\PlayerController;
use App\Http\Controllers\PlayerCrudController;
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

Route::controller(PlayerController::class)->group(function () {
    Route::get('/player/{id}/stats', 'showPlayerStats');
});

Route::controller(PlayerCrudController::class)->group(function () {
    Route::get('/player/{id}', 'read');
    Route::post('/player/create', 'create');
    Route::patch('/player/{id}', 'update');
    Route::delete('/player/{id}', 'delete');
});
