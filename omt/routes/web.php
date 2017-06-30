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


Auth::routes();

Route::get('/', 'PagesController@index');

Route::get('/about', 'PagesController@about');

Route::get('/categories', 'PagesController@categories');

Route::get('/help', 'PagesController@help');

Route::get('/privacy', 'PagesController@privacy');

Route::get('/account', 'PagesController@account');

Route::get('/home', 'HomeController@index')->name('home');
