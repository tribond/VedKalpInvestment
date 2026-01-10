<?php

use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\CartController;

// Now Used
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', function () {
    return redirect()->route('signIn');
});
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/terms-conditions', [HomeController::class, 'termsConditions'])->name('terms.conditions');
Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy.policy');
Route::get('/refund-policy', [HomeController::class, 'refundPolicy'])->name('refund.policy');

Route::get('/sign-up', [HomeController::class, 'signUp'])->name('signUp');
Route::post('/sign-up-submit', [HomeController::class, 'signUpSubmit'])->name('signUpSubmit');

Route::get('/sign-in', [HomeController::class, 'signIn'])->name('signIn');
Route::post('/sign-in-submit', [HomeController::class, 'signInSubmit'])->name('signInSubmit');

Route::post('/contact-submit', [HomeController::class, 'contactusSubmit'])->name('contact.submit');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('user-dashboard');
    Route::get('/sign-out', [HomeController::class, 'signOut'])->name('user-signout');
    Route::get('/services', [HomeController::class, 'services'])->name('services');
     Route::get('/payment-history', [HomeController::class, 'paymentHistory'])->name('payment.history');

    // Cart routes
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
    Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::post('/checkout/process', [CartController::class, 'processPayment'])->name('checkout.process');
});