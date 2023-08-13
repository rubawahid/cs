<?php

use App\Http\Controllers\Admin\categoriesController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\categoryController;
use App\Http\Middleware\EnsureUserType;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'auth.type:admin,super-admin'])->prefix('/admin')->group(function () {
    Route::get('/products/trased', [ProductController::class, 'trashed'])
        ->name('products.trashed');
    Route::put('/products/{product}/restore', [ProductController::class, 'restore'])
        ->name('products.restore');
    Route::delete('/products/{product}/force', [ProductController::class, 'forceDelete'])
        ->name('products.force-delete');
    Route::resource('/products', ProductController::class);

    Route::resource('/categories', categoriesController::class);
    Route::resource('/orders', OrdersController::class);

});
