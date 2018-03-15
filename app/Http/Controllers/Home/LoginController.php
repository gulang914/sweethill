<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SMS\M3Result;
use App\SMS\SendTemplateSMS;
use DB;
use Hash;
use App\model\Users;
class LoginController extends Controller
{
    /**
     * 前台注册页面的显示
     * @return [type] [description]
     */
    public function register()
    {
        return view('/home/index/register');
    }

    /**
     * 前台登陆页面的显示
     * @return [type] [description]
     */
    public function login()
    {
        return view('/home/index/login');
    }

     //    发送手机验证码
    public function sendCode(Request $request)
    {
        $phone = $request['phone'];
        $m3result = new M3Result();
        $sendTempeSms = new SendTemplateSMS();
        //        发送手机验证码的方法需要三个参数
        //        参数1 要发送的手机号
        //        参数2 短信模板中需要替换的变量，是个两个元素的数组，元素1是随机的验证码，元素是时间，单位是分
        //    参数3 短信的模板号，如果是测试账号，只有模板一可用
        $code = rand(0000,9999);
        Session()->put('code',$code);
        $m3result = $sendTempeSms->sendTemplateSMS($phone,array($code,5),1);
        return $m3result->toJson();
    }

    public function doRegister(Request $request)
    {
        //获取表单提交的所有数据
        $input = $request->except('_token');
        $nickname = $request['nickname'];
        // dd($nickname);
        //判断手机号是否为空
        if(empty($input['phone'])) {
            return back()->withErrors('账号不能为空')->withInput();
        }
        //判断code是否一致
        $Scode = Session()->get('code');
        //判断验证码是否为空
        if(empty($Scode)) {
            return back()->withErrors('验证码不能为空')->withInput();
        }
        //判断密码是否为空
        if(empty($input['password'])) {
            return back()->withErrors('密码不能为空')->withInput();
        }
        if($input['code'] != $Scode) {
            return back()->withErrors('验证码错误')->withInput();
        }
        //判断手机号是否存在 
        $res = DB::table('users')->where('phone',$input['phone'])->first();
        if($res){
            return redirect('login')->withErrors('用户已存在，请直接登录');
        }
        //获取手机号
        $phone = $input['phone'];
        //判断表单提交的密码和确认密码是否一致
        if($input['password'] != $input['repass']) {
            return back()->withErrors('两次密码不一致')->withInput();
        }
        //加密表单提交的密码
        $password = Hash::make($input['password']);
        //将验证完的数据保存到数据库
        $users = new Users;
        $users -> phone = $phone;
        $users -> password = $password;
        $users -> nickname = $nickname;
        $res = $users->save();
        if($res){
            return redirect('login')->withErrors('注册成功，请登录');
        } else {
            return back()->withErrors('注册失败，请检查网络连接后重新注册')->withInput();
        }    
    }

    public function doLogin(Request $request)
    {
        $input = $request->except('_token');
        // 验证是否存在用户
        $users = Users::where('phone',$input['phone'])->first();
        if(empty($users)) {
            return back()->withErrors('用户不存在')->withInput();
        }
        //数据库里的密码
        $upass = $users->password;
        //表单提交过来的密码
        $password = $input['password'];
        // 判断密码是否一致
        if (!Hash::check($password , $upass))
        {
            return back()->withErrors('您输入的密码不正确')->withInput();
        }
        //登陆成功以后把数据存到session
        session()->put('users',$users);
        //成功跳转index页面
        return redirect('index');
    }

    public function pass()
    {
        return view('home/index/pass');
    }

    public function doPass(Request $request)
    {
        //获取表单提交的所有数据
        $input = $request->except('_token');
        //判断code是否一致
        $Scode = Session()->get('code');
        //判断手机号是否为空
        if(empty($input['phone'])) {
            return back()->withErrors('账号不能为空')->withInput();
        }
        //判断验证码是否为空
        if(empty($Scode)) {
            return back()->withErrors('验证码不能为空')->withInput();
        }
        //判断密码是否为空
        if(empty($input['password'])) {
            return back()->withErrors('密码不能为空')->withInput();
        }

        //判断验证码是否正确
        if($input['code'] != $Scode) {
            return back()->withErrors('验证码错误')->withInput();
        }

        //判断手机号是否存在 
        $res = DB::table('users')->where('phone',$input['phone'])->first();
        if(!$res){
            return redirect('register')->withErrors('用户不存在,请注册之后登陆');
        }
        //获取手机号
        $phone = $input['phone'];
        //判断表单提交的密码和确认密码是否一致
        if($input['password'] != $input['repass']) {
            return back()->withErrors('两次密码不一致')->withInput();
        }
        //加密表单提交的密码
        $password = Hash::make($input['password']);
        //将验证完的数据保存到数据库
        $users = Users::find($res['id']);
        $users -> password = $password;
        $res = $users->save();
        if($res){
            return redirect('login')->withErrors('密码找回成功，请登录');
        } else {
            return back()->withErrors('注册失败，请检查网络连接后重新注册')->withInput();
        }    
    }
}
