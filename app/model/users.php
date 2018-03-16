<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    public $table = 'users';
    public $timestamps = false;
    public function UserDetail()
	{
		return $this->hasOne('App\model\UserDetail','uid');
	}
	//与购物车一对一关系
    public function Cart()
    {
        return $this->hasOne('App\model\Cart','uid');
    }
}
