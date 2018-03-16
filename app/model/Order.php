<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //订单模型
    //设置操作的表名
    public $table = 'order';

    //与商品表是一对多关系
    public function goods()
    {
   		return $this->hasMany('App\model\Goods','oid'); 
    }

    //与前台用户表的属于关系
    //属于
    public function users()
    {
        return $this->belongsTo('App\model\Users','uid');
    }
}
