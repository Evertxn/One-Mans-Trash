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

Route::get('/browse', 'PagesController@browse');

Route::get('/help', 'PagesController@help');

Route::get('/privacy', 'PagesController@privacy');

Route::get('/search', 'PagesController@geocode');


Route::resource('posts', 'PostsController');
Auth::routes();

Route::get('/dashboard', 'DashboardController@index');
