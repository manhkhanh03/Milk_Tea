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
Route::get('/{address}', 'App\Http\Controllers\Controller@show_web');
Route::get('/menu/products', 'App\Http\Controllers\Controller@show_pagination');
Route::get('/menu/products/product/{title}', 'App\Http\Controllers\Controller@show_product');
Route::get('/menu/products/checkout', 'App\Http\Controllers\Controller@show_checkout');
