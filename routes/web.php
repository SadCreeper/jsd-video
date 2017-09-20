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

//反馈
Route::post('/feedback', 'HomeController@feedback')->name('feedback');

//上传头像
Route::post('/users/avatar', 'UsersController@avatar')->name('users.avatar');
//用户资源路由
Route::get('/users', 'UsersController@index')->name('users.index');
//Route::get('/users/create', 'UsersController@create')->name('users.create');
Route::post('/users', 'UsersController@store')->name('users.store');
//Route::get('/users/{user}', 'UsersController@show')->name('users.show');
Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');
Route::patch('/users/{user}', 'UsersController@update')->name('users.update');
//Route::delete('/users/{user}', 'UsersController@destroy')->name('users.destroy');
//发送验证码
Route::post('/verify', 'UsersController@verify')->middleware('throttle:1')->name('users.verify');
//网站设置
Route::get('/config', 'UsersController@config')->name('users.config');
Route::patch('/conf', 'ConfController@update')->name('conf');

//分类资源路由
//Route::get('/categories', 'CategoriesController@index')->name('categories.index');
//Route::get('/categories/create', 'CategoriesController@create')->name('categories.create');
Route::post('/categories', 'CategoriesController@store')->name('categories.store');
//Route::get('/categories/{category}', 'CategoriesController@show')->name('categories.show');
//Route::get('/categories/{category}/edit', 'CategoriesController@edit')->name('categories.edit');
Route::patch('/categories/{category}', 'CategoriesController@update')->name('categories.update');
Route::delete('/categories/{category}', 'CategoriesController@destroy')->name('categories.destroy');

//上传视频（网页向后端请求签名后直传OSS）
Route::get('/upload', 'ArticlesController@upload')->name('articles.upload');
//上传相片（先传到后端）
Route::post('/upload-photo', 'ArticlesController@uploadPhotos')->name('articles.upload-photo');
//点赞和取消赞
Route::get('/articles/praise/{article}', 'ArticlesController@praise')->name('articles.praise');
//赞过的文章
Route::get('/articles/praised', 'ArticlesController@praised')->name('articles.praised');
//文章搜索页
Route::post('/articles/search', 'ArticlesController@search')->name('articles.search');
//文章分类页
Route::get('/articles/category/{category}', 'ArticlesController@category')->name('articles.category');
//文章管理
Route::get('/articles/manage','ArticlesController@manage')->name('articles.manage');
//文章资源路由
Route::get('/articles', 'ArticlesController@index')->name('articles.index');
Route::get('/articles/create', 'ArticlesController@create')->name('articles.create');
Route::post('/articles', 'ArticlesController@store')->name('articles.store');
Route::get('/articles/{article}', 'ArticlesController@show')->name('articles.show');
Route::get('/articles/{article}/edit', 'ArticlesController@edit')->name('articles.edit');
Route::patch('/articles/{article}', 'ArticlesController@update')->name('articles.update');
Route::delete('/articles/{article}', 'ArticlesController@destroy')->name('articles.destroy');


//首页
Route::get('/','HomeController@home')->name('home');
