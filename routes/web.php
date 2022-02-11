<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\CategoryController;
// use App\Http\Controllers\Admin\ProductController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




// Route::prefix('admin')->grpup(function() {
    Route::middleware(['auth', 'isAdmin'])->group(function () {
        // route for admin dashboard
        Route::get('/dashboard', 'Admin\FrontendController@index');
        // route for category crud
        Route::get('/categories',           [CategoryController::class, 'index'])->name('category.index');
        Route::get('/category/create',      [CategoryController::class, 'create'])->name('category.create');
        Route::post('/category/store',      [CategoryController::class, 'store'])->name('category.store');
        Route::get('/category/edit/{id}',   [CategoryController::class, 'edit'])->name('category.edit');
        Route::put('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
        // product crud route
        Route::resource('products', Admin\ProductController::class);
    });
// });
