<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });



// Route for Login page
Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

// Route for landing pge for authorised user
Route::get('/home', 'HomeController@index')->name('home');

// Route for products and user
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
    Route::resource('products','ProductController');
});




Route::get('/', 'HomeController@index')->name('home');





