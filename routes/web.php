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

//网站首页
Route::get('/','HomeController@index')->name('home');

//注册页
Route::get('/login','UserController@login')->name('login');
//用户注册数据
Route::post('/loginpost','UserController@loginpost')->name('loginpost');


//工具类
Route::any('/code/send','Util\CodeController@send')->name('code.send');

