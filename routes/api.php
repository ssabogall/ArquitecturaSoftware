<?php

use Illuminate\Support\Facades\Route;

Route::get('/mobilePhones', 'App\Http\Controllers\Api\MobilePhoneApiController@index');
Route::get('/mobilePhones/paginate', 'App\Http\Controllers\Api\MobilePhoneApiController@paginate');
