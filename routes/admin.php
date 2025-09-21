<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\Admin\DashboardController@index')->name('dashboard');

// Users
Route::get('users', 'App\Http\Controllers\Admin\UserController@index')->name('users.index');
Route::get('users/create', 'App\Http\Controllers\Admin\UserController@create')->name('users.create');
Route::post('users', 'App\Http\Controllers\Admin\UserController@store')->name('users.store');
Route::get('users/{user}', 'App\Http\Controllers\Admin\UserController@show')->name('users.show');
Route::get('users/{user}/edit', 'App\Http\Controllers\Admin\UserController@edit')->name('users.edit');
Route::put('users/{user}', 'App\Http\Controllers\Admin\UserController@update')->name('users.update');
Route::patch('users/{user}', 'App\Http\Controllers\Admin\UserController@update');
Route::delete('users/{user}', 'App\Http\Controllers\Admin\UserController@destroy')->name('users.destroy');

// Orders (solo index de momento)
Route::get('orders', 'App\Http\Controllers\Admin\OrderController@index')->name('orders.index');

// Products
Route::get('products', 'App\Http\Controllers\Admin\MobilePhoneController@index')->name('products.index');
Route::get('products/create', 'App\Http\Controllers\Admin\MobilePhoneController@create')->name('products.create');
Route::post('products', 'App\Http\Controllers\Admin\MobilePhoneController@store')->name('products.store');
Route::get('products/{product}', 'App\Http\Controllers\Admin\MobilePhoneController@show')->name('products.show');
Route::get('products/{product}/edit', 'App\Http\Controllers\Admin\MobilePhoneController@edit')->name('products.edit');
Route::put('products/{product}', 'App\Http\Controllers\Admin\MobilePhoneController@update')->name('products.update');
Route::patch('products/{product}', 'App\Http\Controllers\Admin\MobilePhoneController@update');
Route::delete('products/{product}', 'App\Http\Controllers\Admin\MobilePhoneController@destroy')->name('products.destroy');

// Specifications
Route::get('specifications', 'App\Http\Controllers\Admin\SpecificationController@index')->name('specifications.index');
Route::get('specifications/create', 'App\Http\Controllers\Admin\SpecificationController@create')->name('specifications.create');
Route::post('specifications', 'App\Http\Controllers\Admin\SpecificationController@store')->name('specifications.store');
Route::get('specifications/{specification}', 'App\Http\Controllers\Admin\SpecificationController@show')->name('specifications.show');
Route::get('specifications/{specification}/edit', 'App\Http\Controllers\Admin\SpecificationController@edit')->name('specifications.edit');
Route::put('specifications/{specification}', 'App\Http\Controllers\Admin\SpecificationController@update')->name('specifications.update');
Route::patch('specifications/{specification}', 'App\Http\Controllers\Admin\SpecificationController@update');
Route::delete('specifications/{specification}', 'App\Http\Controllers\Admin\SpecificationController@destroy')->name('specifications.destroy');

// Reviews
Route::get('reviews', 'App\Http\Controllers\Admin\ReviewController@index')->name('reviews.index');
Route::patch('reviews/{review}/approve', 'App\Http\Controllers\Admin\ReviewController@approve')->name('reviews.approve');
Route::patch('reviews/{review}/reject', 'App\Http\Controllers\Admin\ReviewController@reject')->name('reviews.reject');
