<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Admin\OrderController;

Route::get('/', [FrontendController::class, 'index']);
Route::get('/frontemd/categories', [FrontendController::class, 'category']);
Route::get('/categories/{slug}', [FrontendController::class, 'categoryShow'])->name('categories.show');
// cat_slug is optional
Route::get('/categories/{cat_slug?}/{prod_slug?}', [FrontendController::class, 'productShow'])->name('prosucts.show');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// cart route
Route::post('add-to-cart',          [Cartcontroller::class, 'addProductCart'])->name('cart.add-product');
Route::post('update-cart',          [Cartcontroller::class, 'UpdateProductCart']);
Route::get('delete-cart-item/{id}', [Cartcontroller::class, 'deleteProductCart'])->name('cart.product-delete');

// user route
Route::get('users', [FrontendController::class, 'users']);
// order route
Route::get('orders',                [OrderController::class, 'index']);
Route::get('admin/view-order/{id}', [OrderController::class, 'show']);
Route::put('/update-order/{id}',    [OrderController::class, 'updateOrder']);
Route::get('/order-history',        [OrderController::class, 'orderHistory']);


Route::middleware(['auth'])->group(function(){
    Route::get('cart',         [CartController::class, 'cartView'])->name('cart.view');
    Route::get('checkout',     [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('place-order', [CheckoutController::class, 'placeOrder']);

    // my order
    Route::get('my-orders',       [UserController::class, 'index']);
    Route::get('view-order/{id}', [UserController::class, 'viewOrder']);
});

// admin access route
Route::middleware(['auth', 'isAdmin'])->group(function () {
    // route for admin dashboard
    Route::get('/dashboard', 'Admin\FrontendController@index');
    // category crud route
    Route::resource('categories', Admin\CategoryController::class);
    // product crud route
    Route::resource('products', Admin\ProductController::class);
    // user crud route
    Route::get('users', [FrontendController::class, 'user']);
});