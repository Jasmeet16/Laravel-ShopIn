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

Route::get('/', 'ProductController@show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get( '/products/{id}' , 'ProductController@showsingle' );


Route::get('/admin', 'AdminController@dashboard');
Route::get('/admin/products', 'AdminController@show');

Route::get('/admin/products/create', 'ProductController@create');

Route::post('/admin/products', 'ProductController@store');

Route::get( 'admin/products' , 'ProductController@index' );





