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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//Route::get('/products', 'ProductController@index');
//Route::get('/products/{id}', 'ProductController@show');
//Route::post('/create', 'ProductController@create');
Route::get('/edit_product/{id}', 'ProductController@edit');
Route::post('/update_product/{id}', 'ProductController@update');
Route::any('/delete/{id}', 'ProductController@destroy');

Route::get('/products', 'ProductController@getAllProducts');
Route::get('/products/{id}', 'ProductController@getProduct');
Route::post('/create', 'ProductController@createProduct');


