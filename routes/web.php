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

Route::get('/', function () {
    return view('user.blog');
});

Route::get('post', function () {
    return view('user.post');
})->name('post');


Route::get('admin/home','Admin\HomeController@index')->name('admin.home');
Route::resource('admin/category', 'Admin\CategoryController');
Route::resource('admin/tag', 'Admin\TagController');
Route::resource('admin/post', 'Admin\PostController');

