<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\UserController;


Route::get('/', [FrontendController::class, 'index']);
Route::get('/category', [FrontendController::class, 'category']);
Route::get('/category/{slug}', [FrontendController::class, 'categoryShow'])->name('category.show');
Route::get('/category/{cat_slug}/{prod_slug}', [FrontendController::class, 'productShow'])->name('prosuct.show');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// cart route
Route::post('add-to-cart', [Cartcontroller::class, 'addProduct'])->name('cart.add-product');
Route::post('delete-cart-item', [Cartcontroller::class, 'deleteProduct'])->name('cart.delete-product');
Route::post('update-cart', [Cartcontroller::class, 'UpdateCart']);

Route::middleware(['auth'])->group(function(){
    Route::get('cart', [CartController::class, 'cartView'])->name('cart.view');
    Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('place-order', [CheckoutController::class, 'placeOrder']);
    // my order
    Route::get('my-orders', [UserController::class, 'index']);
    Route::get('view-order/{id}', [UserController::class, 'viewOrder']);
});


// Route::prefix('admin')->grpup(function() {
    Route::middleware(['auth', 'isAdmin'])->group(function () {
        // route for admin dashboard
        Route::get('/dashboard', 'Admin\FrontendController@index');
        // route for category crud
        // Route::get('/categories',           [CategoryController::class, 'index'])->name('category.index');
        // Route::get('/category/create',      [CategoryController::class, 'create'])->name('category.create');
        // Route::post('/category/store',      [CategoryController::class, 'store'])->name('category.store');
        // Route::get('/category/edit/{id}',   [CategoryController::class, 'edit'])->name('category.edit');
        // Route::put('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');

        // category crud
        Route::resource('categories', Admin\CategoryController::class);
        // product crud route
        Route::resource('products', Admin\ProductController::class);

        Route::get('users', [FrontendController::class, 'user']);
    });
// });
