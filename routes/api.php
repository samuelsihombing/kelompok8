<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building    your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('login', 'Api\UserController@login');
Route::post('register', 'Api\UserController@register');
Route::get('produk', 'Api\ProdukController@index');
Route::post('chekout', 'Api\TransaksiController@store');
Route::post('checkout', 'Api\TransaksiController@store');
Route::get('checkout/user/{id}', 'Api\TransaksiController@history');
// Route::post('checkoutmakanan', 'Api\PemesananController@store');
// Route::get('checkoutmakanan/user/{id}',  'Api\PemesananController@history');
Route::post('push', 'Api\TransaksiController@pushNotif');
