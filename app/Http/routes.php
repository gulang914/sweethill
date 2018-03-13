<?php
//后台路由

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
//商品详情资源路由
Route::resource('admin/goodsdetal','Admin\GoodsDetalController');
//分类路由
//添加子分类路由
Route::get('admin/cate/created/{id}','Admin\CateController@created');
//添加子分类处理路由
Route::post('admin/cate/docreate','Admin\CateController@docreate');
//分类资源路由
Route::resource('admin/cate','Admin\CateController');
//商品回收站路由
Route::get('admin/goods/recy','Admin\GoodsController@recy');
//商品恢复路由
Route::get('admin/goods/recy/{id}','Admin\GoodsController@recyc');
//商品彻底删除路由
Route::post('admin/goods/recyd/{id}','Admin\GoodsController@recyd');
//商品详情添加页面路由
Route::get('admin/goods/created/{id}','Admin\GoodsController@created');
//商品资源路由
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
Route::get('index','home\IndexController@index');
Route::get('user','home\UserController@index');