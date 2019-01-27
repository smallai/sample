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

Route::get('/', 'StaticPagesController@home')->name('home');
Route::get('help', 'StaticPagesController@help')->name('help');
Route::get('about', 'StaticPagesController@about')->name('about');

Route::get('signup', 'UsersController@create')->name('signup');     //显示注册页面
Route::get('signup/confirm/{token}', 'UsersController@confirmEmail')->name('confirm_email');
Route::resource('users', 'UsersController');

Route::get('login', 'SessionsController@create')->name('login');        //显示登陆页面
Route::post('login', 'SessionsController@store')->name('login');        //提交登陆请求
Route::delete('logout', 'SessionsController@destroy')->name('logout');  //提交退出请求