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
//登录
Route::post('login', 'SessionsController@store')->name('login');
Route::delete('logout', 'SessionsController@destroy')->name('logout');

//用户资源路由
Route::get('/users', 'UsersController@index')->name('users.index');
//Route::get('/users/{user}', 'UsersController@show')->name('users.show');
//Route::get('/users/create', 'UsersController@create')->name('users.create');
Route::post('/users', 'UsersController@store')->name('users.store');
Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');
Route::patch('/users/{user}', 'UsersController@update')->name('users.update');
//Route::delete('/users/{user}', 'UsersController@destroy')->name('users.destroy');
//网站设置
Route::get('/config', 'UsersController@config')->name('users.config');

//分类资源路由
//Route::get('/categories', 'CategoriesController@index')->name('categories.index');
//Route::get('/categories/{category}', 'CategoriesController@show')->name('categories.show');
//Route::get('/categories/create', 'CategoriesController@create')->name('categories.create');
Route::post('/categories', 'CategoriesController@store')->name('categories.store');
//Route::get('/categories/{category}/edit', 'CategoriesController@edit')->name('categories.edit');
Route::patch('/categories/{category}', 'CategoriesController@update')->name('categories.update');
Route::delete('/categories/{category}', 'CategoriesController@destroy')->name('categories.destroy');

//文章资源路由
Route::get('/articles/manage','ArticlesController@manage')->name('articles.manage');
Route::get('/articles', 'ArticlesController@index')->name('articles.index');
Route::get('/articles/{article}', 'ArticlesController@show')->name('articles.show');
Route::get('/articles/create', 'ArticlesController@create')->name('articles.create');
Route::post('/articles', 'ArticlesController@store')->name('articles.store');
Route::get('/articles/{article}/edit', 'ArticlesController@edit')->name('articles.edit');
Route::patch('/articles/{article}', 'ArticlesController@update')->name('articles.update');
Route::delete('/articles/{article}', 'ArticlesController@destroy')->name('articles.destroy');


//首页
Route::get('/','HomeController@home')->name('home');
//列表
Route::get('/list','HomeController@list')->name('list');
