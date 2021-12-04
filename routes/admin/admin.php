<?php

//route to admin page

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Product\ProductController;
use App\Http\Controllers\Admin\Roles\RoleController;
use App\Http\Controllers\Admin\User\UserController;


Route::group(['middleware' => ['auth']], function() {
    Route::redirect('/', '/admin/dashboard', 301);
    Route::get('dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        Route::get('/', [UserController::class, 'index'])->name('list');

        Route::get('create', [UserController::class, 'create'])->name('create');
        Route::post('create', [UserController::class, 'store']);

        Route::get('edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::post('edit/{id}', [UserController::class, 'update']);

        Route::get('detail/{id}', [UserController::class, 'detail'])->name('detail');

        Route::delete('delete/{id}', [UserController::class, 'delete'])->name('delete');

    });

    Route::group(['prefix' => 'roles', 'as' => 'roles.'], function () {
        Route::get('/', [RoleController::class, 'index'])->name('list');

        Route::get('create', [RoleController::class, 'create'])->name('create');
        Route::post('create', [RoleController::class, 'store']);

        Route::get('edit/{id}', [RoleController::class, 'edit'])->name('edit');
        Route::post('edit/{id}', [RoleController::class, 'update']);

        Route::get('detail/{id}', [RoleController::class, 'detail'])->name('detail');

        Route::delete('delete/{id}', [RoleController::class, 'delete'])->name('delete');

    });
    
});