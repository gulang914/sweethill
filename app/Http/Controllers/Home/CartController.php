<?php

namespace App\Http\Controllers\Home;

use App\model\Cart;
use App\model\CartGoods;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $id = $request->id;
        $cart = Cart::find($id);
        $res = $cart -> delete();
        if($res){
            $data = [
                'status'=>1,
                'msg'=>'删除成功'
            ];
        }else{
            $data = [
                'status'=>0,
                'msg'=>'删除失败'
            ];
        }
        return $data;
    }

    public function index()
    {
        $users = session()->get('users');
        $uid = $users->id;
        $cart = Cart::where('uid',$uid)->get();
        $goods = [];
//        foreach ($cart as $v) {
//            $goods[] = $v->goods;
//            foreach ($v->goods as $a) {
//                $b[] = $a['goods_name'];
//            }
//        }
////
//            dd($b);
        return view('home/goods/cart',['cart'=>$cart,'goods'=>$goods]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//       return Session::all();
        $uid = session()->get('users')->id;
        $gid = $request->gid;
        $num = $request->num;
        $cart = Cart::where('uid',$uid)->get();
        $n = 0;
        foreach ($cart as $v) {
            $goods = CartGoods::where('cid',$v->id)->get();
            foreach ($goods as $a) {
                if($gid == $a->gid){
                    $n = 1;
                    $cid = $v->id;
                }
            }
        }

//        return $cid;
        if($n == 0){
            $data1 = $request->data1;
            json_encode($data1);
            $data2 = 'a'.$request->data2;
            $type =[];
            $str = '';
            foreach ($data1 as $k=>$v) {
                if(strpos($data2,$v['value'])!= 0){
                    $type[$k][1] = $v['name'];
                    $type[$k][2] = $v['value'];
                    $str .=$v['name'].':'.$v['value'].',';
                }
//
            }
            $id = DB::table('cart')->insertGetId(
                ['uid'=>$uid,'num'=>$num,'type'=>$str]
            );
//            $cart = new Cart;
//            $cart->uid = $uid;
//            $cart->num = $num;
//            $cart->type = $str;
//            $res = $cart->save();
//            $cid = $res->id;
//            return $id;
            $res = DB::table('cart_goods')->insert(
                [ 'cid'=>$id,'gid'=>$gid]
            );
//            return $res;
        }else{
            $cart = Cart::find($cid);
//            return $cart;
            $cart->num = $cart->num+$num;
            $res =$cart->save();
        }
        if($res){
            $data = [
                'status'=>1,
                'msg'=>'添加成功'
            ];
        }else{
            $data = [
                'status'=>0,
                'msg'=>'添加失败'
            ];
        }
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

}
