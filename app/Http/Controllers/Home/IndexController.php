<?php

namespace App\Http\Controllers\Home;

use App\model\Cate;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $cate = Cate::where('pid',0)->get();
        $cates = [];
        foreach ($cate as $v) {
            $cates[] = Cate::where('pid',$v->id)->get();
        }
        $users = Session()->get('users');
        return view('home/index/index',['cate'=>$cate,'cates'=>$cates,'users',$users]);

    }

}

