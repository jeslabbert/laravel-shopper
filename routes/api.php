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
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('login', 'App\Http\Controllers\UserController@login');
Route::post('register', 'App\Http\Controllers\UserController@register');
Route::get('/products', 'App\Http\Controllers\ProductController@index');
Route::post('/upload-image', 'App\Http\Controllers\ProductController@uploadImage');
Route::get('/products/{product}', 'App\Http\Controllers\ProductController@show');

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('/users','App\Http\Controllers\UserController@index');
    Route::get('users/{user}','App\Http\Controllers\UserController@show');
    Route::patch('users/{user}','App\Http\Controllers\UserController@update');
    Route::get('users/{user}/orders','App\Http\Controllers\UserController@orders');
    Route::patch('products/{product}/units/add','App\Http\Controllers\ProductController@updateQuantity');
    Route::patch('orders/{order}/finalise','App\Http\Controllers\OrderController@finaliseOrder');
    Route::resource('/orders', 'App\Http\Controllers\OrderController');
    Route::resource('/products', 'App\Http\Controllers\ProductController')->except(['index','show']);
});
