<?php

namespace App\Http\Controllers\Home;

use App\model\Goods;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GoodsDetalController extends Controller
{
    public function detal(Request $request)
    {
        $id = $request->id;
//        return $request->all();
        $goods = Goods::find($id);
//        $goods = json_encode($goods);
        return $goods;
//        return view('/Home/Goods/detal',['$goods'=>$goods]);
//        $ids = {'id'=>$id};
    }
}
