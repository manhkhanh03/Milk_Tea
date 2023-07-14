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

Route::prefix('user')->group(function () {
    Route::get('', 'App\Http\Controllers\Api\UserController@index');
    Route::get('/token', 'App\Http\Controllers\Api\UserController@decodeToken');
    Route::get('/logout', 'App\Http\Controllers\Api\UserController@handle_logout');
    Route::post('', 'App\Http\Controllers\Api\UserController@store');
    Route::post('/check_pass', 'App\Http\Controllers\Api\UserController@check_login');
});

Route::prefix('product')->group(function () {
    Route::get('/{id}', 'App\Http\Controllers\Api\ProductController@show');
    Route::get('/', 'App\Http\Controllers\Api\ProductController@index');
});
