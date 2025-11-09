<?php

use Illuminate\Support\Facades\Route;

// Auth
Auth::routes();

// Locale switcher
Route::get('/locale/{locale}', [App\Http\Controllers\LocaleController::class, 'setLocale'])->name('locale.set');

// Home
Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');

// Admin
Route::middleware(['auth', 'App\Http\Middleware\IsAdmin'])->prefix('admin')->name('admin.')->group(base_path('routes/admin.php'));

// User Account
Route::get('/profile', 'App\Http\Controllers\AccountController@show')->middleware('auth')->name('profile.show');
Route::put('/profile', 'App\Http\Controllers\AccountController@update')->middleware('auth')->name('profile.update');
Route::patch('/profile', 'App\Http\Controllers\AccountController@update')->middleware('auth');

// Reviews
Route::post('/mobilePhones/{id}/reviews', 'App\Http\Controllers\MobilePhoneController@submitReview')->middleware('auth')->name('mobilePhones.reviews.submit');

// Orders
Route::get('/orders', 'App\\Http\\Controllers\\OrderController@index')->middleware('auth')->name('order.index');
Route::get('/orders/{order}', 'App\\Http\\Controllers\\OrderController@show')->middleware('auth')->name('order.show');
Route::patch('/orders/{order}/cancel', 'App\\Http\\Controllers\\OrderController@cancel')->middleware('auth')->name('order.cancel');
Route::patch('/orders/{order}/return', 'App\\Http\\Controllers\\OrderController@return')->middleware('auth')->name('order.return');
Route::get('/orders/{order}/invoice', 'App\\Http\\Controllers\\OrderController@invoice')->middleware('auth')->name('order.invoice');
Route::get('/orders/{order}/invoice/download', 'App\\Http\\Controllers\\OrderController@invoiceDownload')->middleware('auth')->name('order.invoice.download');

// Mobile Phones
Route::get('/mobilePhones', 'App\Http\Controllers\MobilePhoneController@index')->name('mobilePhones.index');
Route::get('/mobilePhones/{id}', 'App\Http\Controllers\MobilePhoneController@show')->name('mobilePhones.show');

// Compare
Route::get('/compare', 'App\Http\Controllers\CompareController@index')->name('compare.index');
Route::post('/compare', 'App\Http\Controllers\CompareController@show')->name('compare.show');

// Cart
Route::get('/cart', 'App\Http\Controllers\CartController@index')->name('cart.index');
Route::post('/cart', 'App\Http\Controllers\CartController@add')->name('cart.add');
Route::put('/cart/{id}', 'App\Http\Controllers\CartController@update')->name('cart.update');
Route::delete('/cart/{id}', 'App\Http\Controllers\CartController@remove')->name('cart.remove');
Route::post('/cart/checkout', 'App\Http\Controllers\CartController@checkout')->middleware('auth')->name('cart.checkout');