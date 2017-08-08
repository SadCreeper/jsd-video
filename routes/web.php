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
//用户资源路由
Route::get('/users', 'UsersController@index')->name('users.index');
//Route::get('/users/{user}', 'UsersController@show')->name('users.show');
//Route::get('/users/create', 'UsersController@create')->name('users.create');
Route::post('/users', 'UsersController@store')->name('users.store');
Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');
Route::patch('/users/{user}', 'UsersController@update')->name('users.update');
//Route::delete('/users/{user}', 'UsersController@destroy')->name('users.destroy');

//登录
Route::post('login', 'SessionsController@store')->name('login');
Route::delete('logout', 'SessionsController@destroy')->name('logout');

//首页
Route::get('/','PagesController@home')->name('home');
//列表
Route::get('/list','PagesController@list')->name('list');
//用户
Route::get('/user','PagesController@user')->name('user');
