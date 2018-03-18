<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\Order;
use App\model\Goods;

class OrderController extends Controller
{
    /**
     * 前台个人中心订单
     * @author [rengaolei]
     * @return 前台订单页面
     */
    public function index()
    {
        //查询订单数据表，将数据绑定到模板中
        //根据用户的id查询该用户的订单，根据该用户的订单查询商品信息 三表联查。
        $order = Order::all();
        $goods = Goods::all();
        // dd($order);
            
        return view('home.index.order',['order'=>$order,'goods'=>$goods]);
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
        $money = $request->money;
        $address = $request->address;
        $address_detail = $request->address_detail;
        $name = $request->name;
        $phone = $request->phone;
        $users = session('users');
        $uid = $users['id'];
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
