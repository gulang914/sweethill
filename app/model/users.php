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
}
