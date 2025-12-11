<?php

use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\TradeController;
use Illuminate\Support\Facades\Route;

// Now Used
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/terms', [HomeController::class, 'terms'])->name('terms');

Route::get('/sign-up', [HomeController::class, 'signUp'])->name('signUp');
Route::post('/sign-up-submit', [HomeController::class, 'signUpSubmit'])->name('signUpSubmit');

Route::get('/sign-in', [HomeController::class, 'signIn'])->name('signIn');
Route::post('/sign-in-submit', [HomeController::class, 'signInSubmit'])->name('signInSubmit');

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->name('dashboard');
    Route::get('/user-dashboard', [HomeController::class, 'dashboard'])->name('user-dashboard');
    Route::get('/sign-out', [HomeController::class, 'signOut'])->name('user-signout');

    Route::get('/trades-list', [TradeController::class, 'tradeslist'])->name('trades.list');
    Route::post('/trades/store', [TradeController::class, 'add'])->name('trades.store');
    Route::post('/trades/update', [TradeController::class, 'update'])->name('trades.update');
    Route::delete('/trades/{id}', [TradeController::class, 'destroy'])->name('trades.destroy');

});