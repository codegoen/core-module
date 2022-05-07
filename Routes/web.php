<?php

use Illuminate\Support\Facades\Route;
use Modules\Core\Providers\RouteServiceProvider;

Route::get('/', fn () => redirect()->route(RouteServiceProvider::HOME));

Route::middleware('auth')->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');
});
