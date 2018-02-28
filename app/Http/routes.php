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
//后台界面
Route::resource('admin/index','Admin\IndexController');
//商品页面
Route::resource('admin/goods','Admin\GoodsController');