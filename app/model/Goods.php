<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Goods extends Model
{
    use SoftDeletes;
    public $table = 'goods';
    public $guarded = [];
    /**
     * 需要被转换成日期的属性。
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    public function goodsdetail()
    {
        return $this->hasOne('App\model\GoodsDetail','gid');
    }

    //多对多关系商品表与标签表
    public function label(){
        return $this->belongsToMany('App\model\Label', 'goods_label', 'gid', 'tid');
    }

    //多对多关系商品表与标签表
    public function labelpid(){
        return $this->belongsToMany('App\model\Label', 'goods_label', 'gid', 'tid')->where('pid',0);
    }

    //多对多关系用户表与商品表
    public function users(){
        return $this->belongsToMany('App\model\users', 'users_goods', 'gid', 'uid');
    }
    //多对多关系购物车表与商品表
    public function cart()
    {
        return $this->belongsToMany('App\model\Cart', 'cart_goods', 'gid', 'cid');
    }

    //与订单表的一对多关系
    //属于
    public function orders()
    {
        return $this->belongsTo('App\model\Order','oid');

    }
}
