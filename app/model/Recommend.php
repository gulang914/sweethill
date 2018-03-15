<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Recommend extends Model
{
    //推荐位模型
    //设置操作的表名
	public $table = 'recommend';
	//允许批量
	Public $guarded = [];
	//与商品表是一对一的关系
}
