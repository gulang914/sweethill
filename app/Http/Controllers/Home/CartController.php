<?php

namespace App\Http\Controllers\Home;

use App\model\Cart;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $n = Cart::where('uid',$uid)->where('gid',gid)->get();
        if(empty($n)){
            $data1 = $request->data1;
            json_encode($data1);
            $data2 = 'a'.$request->data2;
            $type =[];
            $a = '';
            $str = '';
            foreach ($data1 as $k=>$v) {
                if(strpos($data2,$v['value'])!= 0){
                    $type[$k][1] = $v['name'];
                    $type[$k][2] = $v['value'];
                    $str .=$v['name'].':'.$v['value'].',';
                }
//
            }
            $cart = new Cart;
            $cart->uid = $uid;
            $cart->gid = $gid;
            $cart->num = $num;
            $cart->type = $str;
            $res = $cart->save();

            return $data;
        }else{
            $n->num +=$num;
            $res =$n-save();
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
    public function destroy($id)
    {
        //
    }
}
