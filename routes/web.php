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


Route::get('/', 'User\HomeController@index');
Route::get('post/{postslug}', 'User\PostController@index')->name('post');

//Show Posts by Tag
Route::get('post/tag/{tag}','User\HomeController@tag')->name('tag');
//Show Posts by Category
Route::get('post/category/{category}','User\HomeController@category')->name('category');

Route::get('admin/home','Admin\HomeController@index')->name('admin.home');
Route::resource('admin/category', 'Admin\CategoryController');
Route::resource('admin/tag', 'Admin\TagController');
Route::resource('admin/post', 'Admin\PostController');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
