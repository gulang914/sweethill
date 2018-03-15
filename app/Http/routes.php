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


//前台路由
//前台首页
Route::group(['namespace'=>'home'],function(){	
//前台首页
Route::get('index','IndexController@index');

//前台用户
Route::get('user','UserController@index');

// 前台登录页面显示
Route::get('login','LoginController@login');

// 前台注册页面显示
Route::get('register','LoginController@register');

//前台找回密码页面显示
Route::get('pass','LoginController@pass');

// 前台发送手机验证码
Route::post('sendcode','LoginController@sendCode');

// 前台处理注册操作
Route::post('doRegister','LoginController@doRegister');

// 前台处理登陆操作
Route::post('doLogin','LoginController@doLogin');

//前台找回密码处理
Route::post('doPass','LoginController@doPass');

//个人中心的显示
Route::get('user/index','UserController@index');
//个人信息的添加和修改页面的显示
Route::get('user/create','UserController@create');
//个人信息的添加和修改处理
Route::post('user/userAlter','UserController@userAlter');
//安全设置页面的显示
Route::get('user/secure','UserController@secure');
//修改密码页面显示
Route::get('user/setpass','UserController@setPass');
//修改密码操作
Route::post('user/changepass','UserController@changePass');
//修改支付密码的显示
Route::get('user/paypass','UserController@payPass');
//修改支付密码的操作
Route::post('user/setPaypass','UserController@setPaypass');
//手机换绑页面显示
Route::get('user/phone','UserController@phone');
//手机换绑操作
Route::post('user/setphone','UserController@setPhone');
//换绑新手机号页面
Route::get('user/newphone','UserController@newPhone');
//换绑新手机号操作
Route::post('user/setnewphone','UserController@setNewPhone');
//实名认证页面显示
Route::get('user/autonym','UserController@autonym');
//实名认证操作
Route::post('user/setautonym','UserController@setAutonym');

});