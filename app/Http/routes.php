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



Route::get('user','home\UserController@index');
//商品列表页路由
Route::get('goods/{id}','home\GoodsController@index');
//商品详情处理路由
Route::post('detal','home\GoodsDetalController@detal');
//商品详情页面显示路由
Route::get('goods/detal/show/{id}','home\GoodsController@show');
//购物车相关路由
Route::resource('cart','home\CartController');

Route::post('cart/delete','home\CartController@delete');

//前台路由组
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
//前台退出登录
Route::get('logout','LoginController@logout');

});

Route::group(['namespace'=>'home','middleware'=>'homeLogin'],function(){	
//前台首页
Route::get('index','IndexController@index');
//前台用户
Route::get('user','UserController@index');

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
//修改头像
Route::post('user/setPhoto','UserController@setPhoto');
Route::post('user/setButton','UserController@setButton');
//休息一下特效
Route::get('rest','UserController@rest');
//评论显示
Route::get('comment','UserController@comment');
});



//前台个人中心订单路由
Route::resource('index/order','Home\OrderController');
//前台个人中心收货地址路由
Route::resource('index/address','Home\AddressController');
//前台个人中心修改默认收货地址 用ajax
Route::post('index/addredit','Home\AddressController@editAddress');
//前台个人中心删除默认收货地址 用ajax
Route::post('index/deleteaddress','Home\AddressController@deleteAddress');
//前台从购物车跳转到结算页面的路由
Route::resource('index/pay','Home\PayController');
//前台支付页面地址添加路由，用ajax
Route::post('index/addaddress','Home\PayController@addaddress');
//前台提交订单到支付成功界面
Route::resource('index/success','Home\SuccessController');
//前台提交订单ajax，生成订单。
Route::post('index/payorder','Home\OrderController@addorder');
