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

// Route::get('/home', 'HomeController@index');

//首页
Route::get('/','PagesController@home')->name('home');
//列表
Route::get('/list','PagesController@list')->name('list');
//用户
Route::get('/user','PagesController@user')->name('user');
