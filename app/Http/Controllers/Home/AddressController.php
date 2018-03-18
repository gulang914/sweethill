<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\Address;
use DB;
class AddressController extends Controller
{
    /**
     * 前台收货地址控制器
     * @author [rengaolei]
     * @return 返回一个页面
     */
    public function index()
    {
        //查询数据 根据用户的id查。 用户模型与地址模型是一对多的关系。
        //获取用户id  根据uid查
        // 3是从session中取出现在登陆的用户的id
        $users = session('users');
        $uid = $users['id'];
        $address = Address::where('uid',$uid)->get();
        // dd($address);
        return view('home.index.address',['address'=>$address]);
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
     * 处理用户中心地址表单添加的数据
     * @author [rengaolei]
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
       
        $s_province = $request->input('s_province');
        $s_city = $request->input('s_city');
        $s_county = $request->input('s_county');
        $address = $s_province.$s_city.$s_county;

        //表单验证
         $this->validate($request, [
            'name' => 'required|max:6',
            'phone' => 'required|regex:/^1[345789][0-9]{9}$/',
            'address_detail' => 'required',
        ],[
            'name.required' => '收货人不能为空',
            'name.max' => '收货人姓名不能超过6位',
            'phone.required'  => '手机号码不能为空',
            'phone.regex'  => '手机号码不合法',
            'address_detail.required'  => '详细地址不能为空',
        ]);
        // dump($data['name']);
        //插入数据
        $add = new Address;
        //获取session中id。//添加地址时也应该插入uid，uid 从session中获取。
        $users = session('users');
        $uid = $users['id'];
        $add->uid = $uid;
        $add->name = $data['name'];
        $add->phone = $data['phone'];
        $add->address = $address;
        $add->address_detail = $data['address_detail'];
        $res = $add->save();
        if($res){
            return redirect('/index/address')->with('success','添加成功');
        }else{
            return back()->with('error','添加失败');
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
        $address = Address::find($id);
        // $address = Address::where('id', $id)->first();
        // dd($address);
        return view('home.index.editaddress',['address'=>$address]);
    }

    /**
     * 修改地址
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //接收用户修改数据
        $data = $request->except(['_token','_method']);  
        
        $s_province = $request->input('s_province');
        $s_city = $request->input('s_city');
        $s_county = $request->input('s_county');
        $address = $s_province.$s_city.$s_county;

         //表单验证
         $this->validate($request, [
            'name' => 'required|max:6',
            'phone' => 'required|regex:/^1[345789][0-9]{9}$/',
            'address_detail' => 'required',
        ],[
            'name.required' => '收货人不能为空',
            'name.max' => '收货人姓名不能超过6位',
            'phone.required'  => '手机号码不能为空',
            'phone.regex'  => '手机号码不合法',
            'address_detail.required'  => '详细地址不能为空',
        ]);


        //修改数据库
        $address = Address::find($id);
        $address->name = $data['name'];
        $address->phone = $data['phone'];
        $address->address_detail = $data['address_detail'];
        $address->address = $s_province.$s_city.$s_county;
        $res = $address->save();

        if($res){
            return redirect('/index/address')->with('success','修改成功');
        }else{
            return back()->with('error','修改失败');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //根据id删除对应的一条地址数据
    }

   /**
     * 前台个人中心设置（默认）收货地址
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editAddress(Request $request)
    {
        //接收ajax传来的要修改的默认地址的id
        $addid = $request->addid;
        $users = session('users');
        $uid = $users['id'];
        DB::table('Address')->where('uid', $uid)->where('status', 1)->update(['status' => 0]);

        // 根据获取的id（地址表中的id）修改status值。
        $address = Address::find($addid);
        $address->status = '1'; //每次传过来的id都要把状态修改成默认地址也就是 1.
        $res = $address->save();

        if($res){
            $data = [
                'status' => 1,
                'msg' => '修改成功'
            ];
        }else{
            $data = [
                'status' => 0,
                'msg' => '修改失败'
            ];
        }
        return $data;
    }
        
    /**
     * 前台个人中心删除默认收货地址
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteAddress(Request $request)
    {
        //接收ajax传来的要删除的默认地址的id
        $addid = $request->addid;
        $address = Address::find($addid);
        $res = $address->delete();       
        if($res){
            $data = [
                'status' => 1,
                'msg' => '删除成功'
            ];
        }else{
            $data = [
                'status' => 0,
                'msg' => '删除失败'
            ];
        }
        return $data;
    }
}
