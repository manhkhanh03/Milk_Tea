<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('cart')->group(function () {
    Route::get('/decode_token', 'App\Http\Controllers\Api\CartController@decodeTokenCart');
    Route::get('/customer', 'App\Http\Controllers\Api\CartController@show_cart');
    Route::post('', 'App\Http\Controllers\Api\CartController@store');
    Route::post('/token', 'App\Http\Controllers\Api\CartController@createTokenCart');
    Route::delete('/{id}', 'App\Http\Controllers\Api\CartController@destroy');

});

Route::prefix('user')->group(function () {
    Route::get('', 'App\Http\Controllers\Api\UserController@index');
    Route::get('/token', 'App\Http\Controllers\Api\UserController@decodeToken');
    Route::get('/logout', 'App\Http\Controllers\Api\UserController@handle_logout');
    Route::get('/profile/{id}', 'App\Http\Controllers\Api\UserController@show') ;
    Route::post('', 'App\Http\Controllers\Api\UserController@store');
    Route::post('/check_pass', 'App\Http\Controllers\Api\UserController@check_login');
    Route::put('/{id}', 'App\Http\Controllers\Api\UserController@update');
    Route::put('/password/{id}', 'App\Http\Controllers\Api\UserController@update_password');
});

Route::prefix('product')->group(function () {
    Route::get('/{id}', 'App\Http\Controllers\Api\ProductController@show');
    Route::get('/', 'App\Http\Controllers\Api\ProductController@index');
});

Route::prefix('order')->group(function () {
    Route::get('/decode_token', 'App\Http\Controllers\Api\OrderController@decodeTokenOrder');
    Route::post('/token', 'App\Http\Controllers\Api\OrderController@createTokenOrder');
    Route::post('', 'App\Http\Controllers\Api\OrderController@store'); 
});

Route::prefix('shipping')->group(function () {
    Route::put('/{id}', 'App\Http\Controllers\Api\ShippingController@update_delivery_person');
    Route::put('/status/{id}', 'App\Http\Controllers\Api\ShippingController@update_delivery_person');
});

Route::prefix('notification')->group(function () {
    Route::get('/update/order/{id}', 'App\Http\Controllers\Api\NotificationController@show_update_order');
});

Route::get('test', 'App\Http\Controllers\Api\UserController@checkuser');