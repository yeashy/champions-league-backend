<?php

use App\Http\Controllers\ClubController;
use App\Http\Controllers\ClubCrudController;
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

Route::controller(PlayerController::class)->group(function () {
    Route::get('/players/{id}/stats', 'showPlayerStats');
    Route::patch('/players/swap', 'swap');
});

Route::controller(ClubController::class)->group(function () {
    Route::patch('/clubs/swap/groups', 'swapGroups');
    Route::patch('/clubs/swap/pots', 'swapPots');
});

Route::controller(PlayerCrudController::class)->group(function () {
    Route::get('/players/{id}', 'read');
    Route::post('/players/create', 'create');
    Route::patch('/players/{id}', 'update');
    Route::delete('/players/{id}', 'delete');
});

Route::controller(ClubCrudController::class)->group(function () {
    Route::get('/clubs/{id}', 'read');
    Route::post('/clubs/create', 'create');
    Route::patch('/clubs/{id}', 'update');
    Route::delete('/clubs/{id}', 'delete');
});
