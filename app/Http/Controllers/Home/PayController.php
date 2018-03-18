<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\Address;
use App\model\Order;
use DB;
class PayController extends Controller
{
    /**
     * 结算页面控制器
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //session中获取用户id
        $users = session('users');
        $uid = $users['id'];
        // dd($id);                        
        $address = Address::where('uid', $uid)->get();

        //获取登陆用户的id，并且地址状态为默认选中状态。支付界面的订单详情。
        $addr = Address::where('uid', $uid)->where('status',1)->get();
        foreach ($addr as $key => $value) {
            $addr = $value;
        }
        //查询订单表里的总价格, 商品id怎么获取？从商品表里获取。
        //$uid = session('id');
        //
       // $order = Order::where('uid', $uid)->where('gid',gid)->first();
        // dd($address);
        return view('home.index.pay',['address'=>$address,'addr'=>$addr]);
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

    /**
     * //前台支付页面收货地址添加，用ajax
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addaddress(Request $request)
    {
        //获取ajax发送过来的序列化后的表单数据
        $data = $request->data;
        foreach ($data as $k => $v) {
            $arr[] = $v['value'];
        }
        $name = $arr[0];
        $phone = $arr[1];
        $addr = $arr[2].$arr[3].$arr[4];//地址
        $address_detail = $arr[5];//详细地址

        $address = new Address; 
        //获取session中id。//添加地址时也应该插入uid，uid 从session中获取。
        //session中获取用户id
        $users = session('users');
        $uid = $users['id'];
        $address->uid = $uid;
        $address->name = $name;
        $address->phone = $phone;
        $address->address = $addr;
        $address->address_detail = $address_detail;
        $res = $address->save();
        if($res){
            $data = [
                'status' => 1,
                'msg' => '添加成功'    
            ];
        }else{
            $data = [
                'status' => 0,
                'msg' => '添加失败'
            ];
        }
        return $data;

    }
}
