<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    //轮播模型
    //设置操作的表名
    public $table = 'carousel';
    //允许批量
	Public $guarded = [];
    //与商品表是一对一的关系
}
