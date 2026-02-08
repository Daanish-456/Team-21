<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Middleware\UserNotLoginChecker;
use App\Http\Middleware\UserSessionChecker;
use App\Models\User;

// Home
Route::get('/', [ProductController::class, 'home'])->name('home');

//About
Route::view('/about', 'pages.about')->name('about');

// Contact
Route::view('/contact', 'pages.contact')->name('contact');
Route::post('/contact', [ContactController::class, 'createTicket'])->name('contact');

// User routes
Route::get('/account', function () {
    $user = User::where('UserID', '=', session('UserID'))->first();

    return view('pages.auth.account')->with('user', $user);
})->name('account')->middleware(UserSessionChecker::class);

Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::view('/login', 'pages.auth.login')->name('login')->middleware(UserNotLoginChecker::class);
Route::post('/login', [UserController::class, 'login'])->middleware(UserNotLoginChecker::class);

Route::view('/register', 'pages.auth.register')->name('register')->middleware(UserNotLoginChecker::class);
Route::post('/register', [UserController::class, 'register'])->middleware(UserNotLoginChecker::class);

// Product routes
Route::get('/shop', [ProductController::class, 'index'])->name('shop');
Route::redirect('/product', '/shop');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product');
Route::get('/category/{id}', [ProductController::class, 'category'])->name('category');
Route::get('/search', [ProductController::class, 'search'])->name('search');
Route::get('/wishlist', [WishlistController::class, 'show'])->name('wishlist')->middleware(UserSessionChecker::class);
   Route::post('/wishlist/add/{id}', [WishlistController::class, 'add'])->name('wishlist.add')->middleware(UserSessionChecker::class);
   Route::post('/wishlist/remove/{id}', [WishlistController::class, 'remove'])->name('wishlist.remove')->middleware(UserSessionChecker::class);

// Cart / Basket routes (requires logged-in user)
Route::middleware(UserSessionChecker::class)->group(function () {
    // Basket page (used by navbar: route('basket'))
    Route::get('/basket', [CartController::class, 'show'])->name('basket');

    // Cart actions
    Route::post('/basket/add/{productId}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/basket/update/{productId}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/basket/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');

    // Checkout page
    Route::get('/checkout', function () {
        return view('pages.checkout');
    })->name('checkout');
});
