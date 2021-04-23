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




use App\Http\Controllers\OrderController;


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

        Route::get('/users' , 'UserController@index');

        Route::get('/users/{id}' , 'UserController@show');

        Route::get('/orders' , 'OrderController@index');

        Route::get('/orders/status' , 'OrderController@status');


    });
});

Route::post( '/products/cart' , 'CartController@store' );

Route::get( '/cart' , 'CartController@index' );

Route::get( '/carttotal' , 'CartController@total' );

Route::delete( 'cart' , 'CartController@destroy' );

Route::post( 'cart' ,'CartController@update' );

 Route::get( 'cart/checkout/profile' ,'ProfileController@create' );
 
 Route::post( '/profile' ,'ProfileController@store' );

 Route::post('/orders', 'OrderController@store' );
 
 Route::get('/orders', 'OrderController@show' );
