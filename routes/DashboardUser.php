<?php

use App\Http\Controllers\User\StatisticController;
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

Route::middleware('auth:sanctum')->prefix('statistics')->group(function () {

    Route::get('number_of_visits', [StatisticController::class, 'number_of_visits']);
    Route::get('locations_for_link', [StatisticController::class, 'locations_for_link']);

});
