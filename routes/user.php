<?php

use App\Http\Controllers\User\LinkController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\VerifiedEmailController;
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
Route::post('/create_code', [VerifiedEmailController::class, 'create_code']);
Route::post('/check_code', [VerifiedEmailController::class, 'check_code']);
Route::get('/check_for_email', [VerifiedEmailController::class, 'check']);
Route::post('/change_password', [VerifiedEmailController::class, 'change_password']);
Route::get('/profile/{user:uuid}', [ProfileController::class, 'show']);
Route::post('visit/{user}/primary_link/{PrimaryLink}', [LinkController::class, 'visit']);
Route::post('visit_profile', [ProfileController::class, 'visit']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/create_personal_data', [ProfileController::class, 'store_personal_data']);
    Route::post('/create_links', [ProfileController::class, 'store_links']);
    Route::post('/create_other_data', [ProfileController::class, 'store_other_data']);
    Route::post('/create_theme', [ProfileController::class, 'store_theme']);
    Route::post('update_profile', [ProfileController::class, 'update']);
    Route::put('change_email', [VerifiedEmailController::class, 'change_email']);
    Route::delete('delete/{user}/primary_link/{PrimaryLink}', [LinkController::class, 'destroy']);

});
