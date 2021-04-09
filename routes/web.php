<?php

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

// use Illuminate\Routing\Route;

Route::get('/', 'ProductController@show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/products/{id}', 'ProductController@showsingle');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', 'AdminController@dashboard');
        Route::get('/products', 'AdminController@show');

        Route::get('/products/create', 'ProductController@create');

        Route::post('/products', 'ProductController@store');

        Route::delete('/products/{id}', 'ProductController@destroy');


        Route::get('/products', 'ProductController@index');
    });
});

Route::post( '/products/cart/{id}' , 'CartController@store' );