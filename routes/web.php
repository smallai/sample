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

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');    //1.用户输入自己的邮箱，提交重置密码
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');      //2.收到用户的重置密码请求后，发送重置密码邮件
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');     //3.用户在邮箱点击重置密码，显示密码输入框
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');                   //4.重置用户密码

Route::resource('statuses', 'StatusesController', ['only' => ['store', 'destroy']]);