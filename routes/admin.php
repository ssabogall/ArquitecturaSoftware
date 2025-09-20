<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\Admin\DashboardController@index')->name('dashboard');
Route::resource('users', 'App\Http\Controllers\Admin\UserController');
Route::get('/orders', 'App\Http\Controllers\Admin\OrderController@index')->name('orders.index');
Route::resource('products', 'App\Http\Controllers\Admin\MobilePhoneController');
