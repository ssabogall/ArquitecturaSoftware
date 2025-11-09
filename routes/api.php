<?php

use App\Http\Controllers\Api\MobilePhoneApiControllerV3;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application.
| These routes are loaded by the RouteServiceProvider and are assigned
| the "api" middleware group. Enjoy building your API!
|
*/

// MobilePhones API - Version equipo 4
Route::get('/v3/mobilePhones', [MobilePhoneApiControllerV3::class, 'index']);
Route::get('/v3/mobilePhones/paginate', [MobilePhoneApiControllerV3::class, 'paginate']);