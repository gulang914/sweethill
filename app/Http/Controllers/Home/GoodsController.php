<?php

namespace App\Http\Controllers\Home;

use App\model\Cate;
use App\model\Goods;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$id)
    {
//        dd($id);
        $cate = Cate::find($id);
        $pid = $cate->pid;
        if($pid == 0){
            $id = Cate::where('pid',$id)->lists('id');

        }
        $goods = Goods::where('cid',$id)->get();

        return view('home/goods/index',['goods'=>$goods]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //获取商品信息
        $goods = Goods::find($id);
        $detail = $goods->goodsdetail;

        //获取商品对应的标签
        $label = $goods->label;
        //一级标签存储数组
        $label_one = [];
        //二级标签存储数组
        $label_two = [];
        //遍历标签数组
        foreach ($label as $v) {
            if($v->pid == 0){
                $label_one[] = $v;
                foreach ($label as $a) {
                    if($a->pid == $v->id){
                        $label_two[$v->id][] = $a;
                    }
                }
            }
        }
//        dump($label_one);
//        dump(123123123);
//        dump($label_two);
//
//        dd($detail);
        return view('/Home/Goods/detal',['goods'=>$goods,'detail'=>$detail,'lable_one'=>$label_one,'lable_two'=>$label_two]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
