<?php

//route to admin page

use App\Http\Controllers\Admin\DashboardController;

Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');
