<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\MiscellaneousController;

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

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/updateFcmToken', [UserController::class, 'updateFcmToken']);
Route::post('/contactUs', [MiscellaneousController::class, 'contactUs']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [UserController::class, 'logout']);
});