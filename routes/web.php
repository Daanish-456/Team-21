<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::view('/', 'pages.home')->name('home');

Route::view('/contact', 'pages.contact')->name('contact');
Route::post('/contact', [ContactController::class, 'createTicket'])->name('contact');

//User Routes
Route::view('/basket', 'pages.basket')->name('basket');
Route::view('/account', 'pages.auth.account')->name('account');    // Good use for middleware on these routes
Route::view('/login', 'pages.auth.login')->name('login');
Route::view('/register', 'pages.auth.register')->name('register');

//Product Routes
Route::view('/shop', 'pages.shop')->name('shop');
Route::view('/product', 'pages.product.product')->name('product');