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

Route::get('blog/{slug}', ['as' => 'blog.single', 'uses'=>'BlogController@getSingle'])->where('slug', '[\w\d\-\_0]+');

Route::get('blog', ['as' => 'blog.index', 'uses' => 'BlogController@getIndex']);

Route::get('contact', ['as' => 'contact', 'uses' => 'PagesController@getContact']);

Route::get('about', ['as' => 'about', 'uses' => 'PagesController@getAbout']);

Route::get('/', 'PagesController@getIndex');

Route::resource('posts', 'PostController');

Route::resource('categories', 'CategoryController', ['except' => ['show', 'create']]);

Route::resource('tags', 'TagController', ['except' => ['create']]);


Auth::routes();
