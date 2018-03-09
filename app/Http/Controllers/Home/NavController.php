<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\Gps;
class NavController extends Controller
{
    public function __construct()
    {
        //导航栏数据
        $nav = Gps::take(5)->get();
        view()->share('nav',$nav);
    }
}
