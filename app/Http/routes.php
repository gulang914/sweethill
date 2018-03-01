<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('index',function (){
    return view('Admin\Index\index');
});

//后台主界面路由
Route::resource('admin/index','Admin\IndexController');
//商品路由
Route::resource('admin/goods','Admin\GoodsController');
//分页路由
Route::resource('admin/cate','Admin\CateController');

//显示登陆页面
Route::get('admin/login','Admin\LoginController@login');
//处理登陆操作
Route::post('admin/handle','Admin\LoginController@handle');
//获取验证码
Route::get('/code/captcha/{tmp}', 'Admin\LoginController@captcha');


Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>'login'],function(){	
	//登录
	//后台首页
	Route::get('index','IndexController@index');
	//退出登录
	Route::get('logout','LoginController@logout');
	//用户
	Route::resource('user','UserController');
	//状态
	Route::get('status/{id}','StatusController@status');
});

