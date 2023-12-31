<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Call api web routes
Route::get('', function (Request $request) {
    $url = $request->getSchemeAndHttpHost();
    return view('home')->with('url_web', $url);
});
Route::get('login', 'App\Http\Controllers\Controller@show_login')->name('login');
Route::get('/{address}', 'App\Http\Controllers\Controller@show_web')->middleware('web');


Route::prefix('menu')->group(function () {
    Route::get('/products', 'App\Http\Controllers\Controller@show_pagination');
    Route::get('/products/product/{title}', 'App\Http\Controllers\Controller@show_product');
    Route::get('/products/checkout', 'App\Http\Controllers\Controller@show_checkout');
});

Route::prefix('user')->group(function () {
    Route::get('/account/{address}', 'App\Http\Controllers\Controller@show_web')->middleware('auth');
    Route::get('/{address}', 'App\Http\Controllers\Controller@show_web_order')->middleware('auth');
    Route::get('/purchase/order/{address}', 'App\Http\Controllers\Controller@show_web_shipping_information')->middleware('auth');
});

Route::prefix('notification')->group(function () {
    Route::get('/{address}', 'App\Http\Controllers\Controller@show_update');
});