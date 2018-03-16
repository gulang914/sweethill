<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $table = 'cart';
    public $timestamps = false;
    Public $guarded = [];
    //与商品表一对多关系

    public function goods(){
        return $this->belongsToMany('App\model\Goods', 'cart_goods', 'cid', 'gid');
    }
}
