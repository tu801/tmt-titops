<?php

//route to admin page

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Product\ProductController;
use App\Http\Controllers\Admin\User\UserController;


Route::group(['middleware' => ['auth']], function() {
    Route::redirect('/', '/admin/dashboard', 301);
    Route::get('dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        Route::get('/', [UserController::class, 'index']);
        Route::get('create', [UserController::class, 'create'])->name('create');
        Route::post('create', [UserController::class, 'store']);

        Route::get('edit', [UserController::class, 'edit'])->name('edit');
        Route::post('edit', [UserController::class, 'update']);

        Route::get('detail', [UserController::class, 'detail'])->name('detail');

        Route::get('delete', [UserController::class, 'delete'])->name('delete');

    });
    
});