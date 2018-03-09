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
	//异步文件上传
	Route::post('user/uploads', 'UploadController@uploads');
	//站点配置
	Route::get('set/alter','SetController@alter');
	Route::post('set/amend','SetController@amend');
	Route::post('set/cajax','SetController@cajax');
	Route::get('set/delete','SetController@delete');
	Route::post('set/remove','SetController@remove');
	Route::resource('set','SetController');
	//友情链接
	Route::resource('link','LinkController');
	//导航
	Route::resource('gps','GpsController');
});

//后台主界面路由
Route::resource('admin/index','Admin\IndexController');
//商品图片上传路由
Route::post('admin/goods/upload','Admin\GoodsController@upload');
Route::post('admin/goods/uploads','Admin\GoodsController@uploads');
//商品详情添加路由
Route::post('admin/goods/detail/{id}','Admin\GoodsController@detail');
//分类路由
//添加子分类路由
Route::get('admin/cate/created/{id}','Admin\CateController@created');
Route::post('admin/cate/docreate','Admin\CateController@docreate');
Route::resource('admin/cate','Admin\CateController');

Route::get('admin/goods/created/{id}','Admin\GoodsController@created');
Route::resource('admin/goods','Admin\GoodsController');


//后台订单路由
Route::resource('admin/order','Admin\OrderController');

//后台广告模块文件上传路由
Route::post('admin/upload','Admin\AdvController@upload');
//后台广告模块路由
Route::resource('admin/adv','Admin\AdvController');
//后台轮播图模块路由
Route::resource('admin/carousel','Admin\CarouselController');
//后台推荐位模块路由
Route::resource('admin/recommend','Admin\RecommendController');

