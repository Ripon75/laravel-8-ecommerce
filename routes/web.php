<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// For admin
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Frontend\FrontendController;
// For user
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\WishlistController;

Route::get('/',                    [FrontendController::class, 'index']);
Route::get('/frontemd/categories', [FrontendController::class, 'category']);
Route::get('/categories/{slug}',   [FrontendController::class, 'categoryShow'])->name('categories.show');
// cat_slug is optional
Route::get('/categories/{cat_slug?}/{prod_slug?}', [FrontendController::class, 'productShow'])->name('prosucts.show');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// cart route
Route::get('/load-cart-data',        [CartController::class, 'cartCount']);
Route::post('/add-to-cart',          [Cartcontroller::class, 'addProductCart'])->name('cart.add-product');
Route::post('/update-cart',          [Cartcontroller::class, 'UpdateProductCart']);
Route::get('/delete-cart-item/{id}', [Cartcontroller::class, 'deleteProductCart'])->name('cart.product-delete');

// order route
Route::get('/orders',                [OrderController::class, 'index']);
Route::get('/admin/view-order/{id}', [OrderController::class, 'show']);
Route::put('/update-order/{id}',     [OrderController::class, 'updateOrder']);
Route::get('/order-history',         [OrderController::class, 'orderHistory']);

Route::post('/add-to-wishlists',     [WishlistController::class, 'add']);
Route::get('/remove-wishlists/{id}', [WishlistController::class, 'remove'])->name('remove.wishlists');
Route::get('/load-wishlist-data',    [WishlistController::class, 'wishlistCount']);


Route::middleware(['auth'])->group(function(){
    Route::get('/cart',         [CartController::class, 'cartView'])->name('cart.view');
    // Checkout route
    Route::get('/checkout',     [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/place-order', [CheckoutController::class, 'placeOrder']);
    // my order
    Route::get('/my-orders',       [UserController::class, 'index']);
    Route::get('/view-order/{id}', [UserController::class, 'viewOrder']);
    // wishlist roure
    Route::get('/wishlists', [WishlistController::class, 'index'])->name('wishlists.index');

});

// admin access route
Route::middleware(['auth', 'isAdmin'])->group(function () {
    // route for admin dashboard
    Route::get('/dashboard', 'Admin\FrontendController@index');
    // category crud route
    Route::resource('/categories', Admin\CategoryController::class);
    // product crud route
    Route::resource('/products', Admin\ProductController::class);
    // user crud route
    // Route::get('/users', [FrontendController::class, 'user']);
    Route::get('/users', [DashboardController::class, 'user']);
});