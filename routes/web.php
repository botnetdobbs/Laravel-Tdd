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

Route::get('/posts/create', 'PostsController@create');

Route::get('/posts/{id}', 'PostsController@show');

Route::get('/posts/{id}/edit', 'PostsController@edit');

Route::put('/posts/{id}', 'PostsController@update');

Route::delete('/posts/{id}', 'PostsController@destroy');

Route::post('/posts/{id}/comments', 'CommentsController@store');

Auth::routes();

Route::get('/home', 'PagesController@index')->name('home');
