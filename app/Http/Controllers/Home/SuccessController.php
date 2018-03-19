<?php

namespace App\Http\Controllers\Home;

use App\model\Address;
use App\model\Order;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SuccessController extends Controller
{
    /**
     * 支付成功界面
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $gid = $request->gid;
        $aid = $request->aid;
        $money = $request->money;
        $users = session('users');
        $uid = $users['id'];
        $order_member = date('YmdHis',time()).rand('1111','9999');
        $order_time = date('Y-m-d H:i:s',time());

        $type = $request->type;
        // dd($type);                        //订单生成时间

        $res = Order::create(['gid'=>$gid,'aid'=>$aid,'uid'=>$uid,'order_member'=>$order_member,'totalmoney'=>$money,'status'=>1,'order_time'=>$order_time,'type'=>$type]);

        if($res){
            $addr =Address::find($aid);
            return view('home.index.success',['res'=>$res,'addr'=>$addr]);
        }else{
            return redirect()->back();
        }
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
}
