<?php

namespace App\Http\Controllers\Home;

use App\model\Cate;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Session;
use App\model\Config;
use App\model\recommend;
use App\model\Carousel;
use App\model\Adv;
class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //友情链接
        $li = [];
        $link = DB::table('link')->get();
        foreach ($link as $k => $v) {
            $li[$k] = $v; 
        }
        Session::put('link',$li);
        //导航
        $gp = [];
        $gps = DB::table('gps')->get();
        foreach ($gps as $k => $v) {
            $gp[$k] = $v; 
        }
        Session::put('gps',$gp);
        //网站配置
        $title[]='';
        $content[]='';
        $config = Config::get();
        //遍历数组
        foreach ($config as $key => $value) {
            $content[$value['title']] = $value['content'];
        }
        // dd($title);
        // dd($content);
        // Session::put('title',$title);
        Session::put('content',$content);
        $cate = Cate::where('pid',0)->get();
        $cates = [];
        foreach ($cate as $v) {
            $cates[] = Cate::where('pid',$v->id)->get();
        }
        $users = Session()->get('users');

        //前台轮播图
        $car = Carousel::get();
        $onecar = $car[0];
        $twocar = $car[1];
        $threecar = $car[2];
        $forecar = $car[3];

        //商城公告
        // $adv = Adv::get();

        //推荐位
        $recommend = recommend::get();
        // dd($recommend);
        return view('home/index/index',['cate'=>$cate,'cates'=>$cates,'users',$users,'onecar'=>$onecar, 'twocar'=>$twocar, 'threecar'=>$threecar, 'forecar'=>$forecar,'recommend'=>$recommend]);

    }

}

