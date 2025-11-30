<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\UserNotLoginChecker;
use App\Http\Middleware\UserSessionChecker;
use App\Models\User;

Route::view('/', 'pages.home')->name('home');

Route::view('/contact', 'pages.contact')->name('contact');
Route::post('/contact', [ContactController::class, 'createTicket'])->name('contact');

//User Routes
Route::view('/basket', 'pages.basket')->name('basket');
Route::get('/account', function () {
    $user = User::where('UserID', '=', session('UserID'))->first();

    return view('pages.auth.account')->with('user', $user);
})->name('account')->middleware(UserSessionChecker::class);

Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::view('/login', 'pages.auth.login')->name('login')->middleware(UserNotLoginChecker::class);
Route::post('/login', [UserController::class, 'login'])->middleware(UserNotLoginChecker::class);
Route::view('/register', 'pages.auth.register')->name('register')->middleware(UserNotLoginChecker::class);
Route::post('/register', [UserController::class, 'register'])->middleware(UserNotLoginChecker::class);

//Product Routes
Route::view('/shop', 'pages.shop')->name('shop');
Route::view('/product', 'pages.product.product')->name('product');