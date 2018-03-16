<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //前台用户模型
    //设置操作的表名
    public $table = 'users';

    //与商品表是一对多关系
    public function orders()
    {
   		return $this->hasMany('App\model\Order','uid');
    }

    //与地址表表是一对多关系
    public function address()
    {
   		return $this->hasMany('App\model\Address','uid');
    }
}
