<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    AdminController,
    DashboardController,
    NotificationController,
    UsersController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AdminController::class, 'index'])->name('login');
Route::get('/login', [AdminController::class, 'index'])->name('login');

Route::post('/checklogin', [AdminController::class, 'login'])->name('checklogin');
Route::get('/logout', [AdminController::class, 'logout'])->name('logout');


Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('/dashboard',[DashboardController::class,'dashboard']);
    Route::get('/notifications',[NotificationController::class,'notifications']);
    Route::post('/notification/send',[NotificationController::class,'sendNotification']);
    Route::match(['get', 'post'], 'userlist', [UsersController::class, 'userList'])->name('userlist');
});
