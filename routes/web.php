<?php

use Illuminate\Support\Facades\Route;

// Auth
Auth::routes();

// Admin
Route::middleware(['auth', \App\Http\Middleware\IsAdmin::class])->prefix('admin')->name('admin.')->group(base_path('routes/admin.php'));

// Public
Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');
