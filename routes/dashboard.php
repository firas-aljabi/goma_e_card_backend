<?php

use App\Http\Controllers\Dashboard\LinkController;
use App\Http\Controllers\Dashboard\ThemeController;
use App\Http\Controllers\Dashboard\UserController;
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
Route::get('link', [LinkController::class, 'index']);
Route::get('user/{user:id}', [UserController::class, 'show']);
Route::middleware(['auth:sanctum', 'isAdmin'])->group(function () {
    Route::apiResource('theme', ThemeController::class)->except('update');
    Route::post('theme/{theme}', [ThemeController::class, 'update']);
    Route::apiResource('user', UserController::class)->except('show');
    Route::apiResource('link', LinkController::class)->except(['index', 'update']);
    Route::post('link/{link}', [LinkController::class, 'update']);

});
