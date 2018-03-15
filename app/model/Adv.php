<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Adv extends Model
{
    //广告模型
    //设置操作的表名
	public $table = 'adv';
	//	自动维护字段
	// public $timestamps = false;
	//修改默认的主键名称
	// public $primaryKey = 'id';
	//允许批量添加数据
	Public $guarded = [];

	//与商品表是一对一的关系
}
