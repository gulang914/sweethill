<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //地址表模型
    public $table = 'address';
    //允许批量添加数据
	Public $guarded = [];
	
    //与前台用户表的属于关系
    //属于
    public function users()
    {
        return $this->belongsTo('App\model\Users','uid');
    }
}
