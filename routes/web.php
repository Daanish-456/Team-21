<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use App\Http\Middleware\IsAdminUserVerifier;
use App\Http\Middleware\UserNotLoginChecker;
use App\Http\Middleware\UserSessionChecker;
use App\Models\User;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', [ProductController::class, 'home'])->name('home');

// About
Route::view('/about', 'pages.about')->name('about');

// Contact
Route::view('/contact', 'pages.contact')->name('contact');
Route::post('/contact', [ContactController::class, 'createTicket'])->name('contact.submit');

// Information pages
Route::view('/ethical-sourcing', 'pages.ethical-sourcing')->name('ethical-sourcing');
Route::view('/easy-returns', 'pages.easy-returns')->name('easy-returns');
Route::view('/fast-delivery', 'pages.fast-delivery')->name('fast-delivery');
Route::view('/faqs', 'pages.faqs')->name('faqs');

Route::get('/account', function () {
    $user = User::where('UserID', '=', session('UserID'))->first();
    $addressLines = preg_split("/\r\n|\n|\r/", (string) ($user->Address ?? ''));
    $addressLines = array_pad(array_map('trim', array_values($addressLines ?: [])), 6, '');

    $orders = \App\Models\Order::where('UserID', session('UserID'))
        ->with('items.product')
        ->orderBy('OrderDate', 'desc')
        ->get();

    return view('pages.auth.account', [
        'user' => $user,
        'orders' => $orders,
        'addressFields' => [
            'address_line_1' => $addressLines[0] ?? '',
            'address_line_2' => $addressLines[1] ?? '',
            'city' => $addressLines[2] ?? '',
            'county' => $addressLines[3] ?? '',
            'postcode' => $addressLines[4] ?? '',
            'country' => $addressLines[5] ?? '',
        ],
    ]);
})->name('account')->middleware(UserSessionChecker::class);
Route::post('/account/details', [UserController::class, 'updateProfile'])
    ->name('account.details.update')
    ->middleware(UserSessionChecker::class);
Route::post('/account/address', [UserController::class, 'updateAddress'])
    ->name('account.address.update')
    ->middleware(UserSessionChecker::class);

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
        $user = User::where('UserID', session('UserID'))->first();

        $addressLines = preg_split("/\r\n|\n|\r/", (string) ($user->Address ?? ''));
        $addressLines = array_pad(array_map('trim', array_values($addressLines ?: [])), 6, '');

        return view('pages.checkout', [
            'user' => $user,
            'addressFields' => [
                'address_line_1' => $addressLines[0] ?? '',
                'address_line_2' => $addressLines[1] ?? '',
                'city' => $addressLines[2] ?? '',
                'county' => $addressLines[3] ?? '',
                'postcode' => $addressLines[4] ?? '',
                'country' => $addressLines[5] ?? '',
            ],
        ]);
    })->name('checkout');

    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout.process');
    Route::post('/checkout/address', [UserController::class, 'saveCheckoutAddress'])->name('checkout.address.save');

    // Review actions
    Route::post('/product/{productId}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::put('/reviews/{reviewId}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{reviewId}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

// Admin only routes
Route::middleware(IsAdminUserVerifier::class)->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/stock', [AdminProductController::class, 'index'])->name('admin.stock');
    Route::get('/admin/stock/{product}/edit', [AdminProductController::class, 'edit'])->name('admin.stock.edit');
    Route::post('/admin/stock', [AdminProductController::class, 'store'])->name('admin.stock.store');
    Route::put('/admin/stock/{product}', [AdminProductController::class, 'update'])->name('admin.stock.update');
    Route::delete('/admin/stock/{product}', [AdminProductController::class, 'destroy'])->name('admin.stock.destroy');
});
