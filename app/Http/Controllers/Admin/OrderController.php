<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\Order;
use App\model\Address;
use App\model\Goods;
use DB;

class OrderController extends Controller
{
    /**
     * 后台订单列表
     * @author [rengaolei]
     * @param   $[Request] [$request]
     * @return 返回一个订单列表
     */
    public function index(Request $request)
    {
        // dump($request->num);
        // dump($request->keywords1);

        // 多条件查询
        $order = Order::orderBy('id','asc')->where(function($query) use($request){
            //检测关键字
            $ordermember = $request->input('keywords1');
            //如果用户名不为空
            if(!empty($ordermember)) {
                // $query->where('order_member','like','%'.$ordermember.'%');
                $query->where('order_member','=',$ordermember);
            }
        })->paginate($request->input('num', 5));
        

        return view('admin.order.list',['order'=>$order, 'request'=> $request]);
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
        //
    }

    /**
     * 后台订单详情
     * @author [rengaolei]
     * @param  [$id]
     * @return [订单详情页]
     */
    public function show($id)
    {
        $address = Address::find($id);
        //查询订单详情表中的商品名
        $order = Order::find($id);
        // dump($order->goods);
    
        // 获取商品名
        $data = $order->goods;
        foreach ($data as $key => $value) {
            $value = $value;
        }
        // dd($value->goods_name);
        $goods = $value->goods_name;


        return view('admin.order.detail',['address'=>$address,'goods'=>$goods]);
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
