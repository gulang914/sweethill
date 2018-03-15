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
}
