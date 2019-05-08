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

Route::get('/', 'PagesController@index');

Route::get('/posts', 'PostsController@index');

Route::post('/posts', 'PostsController@store');

Route::get('/post/{id}', 'PostsController@show');

Route::get('/post/{id}/edit', 'PostsController@edit');

Route::put('/post/{id}', 'PostsController@update');

Route::get('/posts/create', 'PostsController@create');

Auth::routes();

Route::get('/home', 'PagesController@index')->name('home');
