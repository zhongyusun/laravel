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

//网站首页Route::get('/','Home\HomeController@index')->name('home');
Route::get('/','Home\HomeController@index')->name('home');


////前台路由组
Route::group(['prefix'=>'home','namespace'=>'Home','as'=>'home.'],function (){
//    //加载前台页面
    Route::get('/','HomeController@index')->name('home');
//    //创建模型同时创建迁移文件和工厂
//    //artisan make:model --migration --factory Models/Artcle
//    //创建控制器指定模型
//    //artisan make:controller --model=Models/Category Home/ArtcleController
    Route::resource('article','ArticleController');
});


//会员中心路由组
Route::group(['prefix'=>'member','namespace'=>'Member','as'=>'member.'],function (){
    //加载用户管理页面
    Route::resource('user','UserController');
    //定义取消关注和关注
    Route::get('attention/{user}','UserController@attention')->name('attention');
});



//注册页
Route::get('/login','UserController@login')->name('login');
//用户注册数据
Route::post('/loginpost','UserController@loginpost')->name('loginpost');
//登录页
Route::get('/register','UserController@register')->name('register');
//登录数据
Route::post('/registerpost','UserController@registerpost')->name('registerpost');
//注销登录
Route::get('/registerout','UserController@registerout')->name('registerout');
//密码重置页面
Route::get('/passwordreplace','UserController@passwordreplace')->name('passwordreplace');
//密码数据
Route::post('/passwordpost','UserController@passwordpost')->name('passwordpost');


//工具路由组
Route::group(['prefix'=>'util','namespace'=>'Util','as'=>'util.'],function (){
    //验证码
    Route::any('/code/send','CodeController@send')->name('code.send');
    //上传
    Route::any('/uploader','UploadController@uploader')->name('uploader');
    //处理图片
    Route::any('/filesLists','UploadController@filesLists')->name('filesLists');
});





//后台路径  middleware:中间件  prefix：前缀  namespace:命名空间   as：别名
Route::group(['middleware'=>['admin.auth'],'prefix'=>'admin','namespace'=>'Admin','as'=>'admin.'],function(){
    //加载后台页面
    Route::get('index','IndexController@index')->name('index');
    //创建模型同时创建迁移文件和工厂
    //artisan make:model --migration --factory Models/Category
    //创建控制器指定模型
    //artisan make:controller --model=Models/Category Admin/CategoryController
    Route::resource('category','CategoryController');
});
