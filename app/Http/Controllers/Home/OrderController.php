<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\Order;
use App\model\Goods;
use DB;

class OrderController extends Controller
{
    /**
     * 前台个人中心订单
     * @author [rengaolei]
     * @return 前台订单页面
     */
    public function index()
    {   
        //获取session中用户的id
        $users = session('users');
        $uid = $users['id'];
        //用户的所有订单
        $order = Order::where('uid',$uid)->get();
        // dd($order);        

        //根据用户id获取订单表中的商品gid。
        // DB::table('order')->where('uid',$uid)->get()
        $gid = DB::table('order')->where('uid',$uid)->value('gid');
        // dd($gid);

        //根据商品的id获取商品的信息。
        $goods = Goods::where('id', $gid)->first();
        // dd($goods);

        //查商品单价在商品详情表中。
        $price = $goods->goodsdetail->goods_price;
        // dd($price);

        //获取商品对应的标签
        

        
        return view('home.index.order',['order'=>$order,'goods'=>$goods,'price'=>$price]);
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
    public function addorder(Request $request)
    {
//        money':money, 'address':address, 'address_detail':address_detail, 'name':name, 'phone':phone
        // $money = $request->money;
        // $address = $request->address;
        // $address_detail = $request->address_detail;
        // $name = $request->name;
        // $phone = $request->phone;
        // $users = session('users');
        // $uid = $users['id'];
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
