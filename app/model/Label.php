<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    //
    public $table = 'label';
    public $guarded = [];
    public $timestamps = false;

    //多对多关系商品表与标签表
    public function goods(){
        return $this->belongsToMany('App\model\Goods', 'goods_label', 'tid', 'gid');
    }
}
