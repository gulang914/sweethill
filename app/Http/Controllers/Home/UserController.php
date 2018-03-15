<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\Users;
use App\model\UserDetail;
use Session;
use DB;
use Hash;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/home/User/index');
    }

    public function create()
    {
        return view('/home/User/create');
    }

    public function userAlter(Request $request)
    {
        $id = Session::get('users')->id;
        $nickname = $request->input('nickname');
        $email = $request->input('email');
        $age = $request->input('age');
        $sex = $request->input('sex');
        $users = Users::find($id);
        $users -> nickname = $nickname;
        $users -> email = $email;
        $res = $users->save();
        if($res){
                $users->UserDetail->age = $age;
                $users->UserDetail->sex = $sex;
                $res = $users->UserDetail->save();
                if($res) {
                    session()->put('users',$users);
                    return redirect('user/create')->withErrors('信息更新成功');
                }
        } else {
            return back()->withErrors('信息更新失败')->withInput();
        }  

    }

    public function secure()
    {
        return view('/home/user/secure');
    }

    public function setPass()
    {
        return view('/home/user/setpass');
    }

    public function changePass(Request $request)
    {
        $id = Session::get('users')->id;
        $oldpass = $request->oldpass;
        $password = $request->password;
        $repass = $request->repass;
        $dbpass = DB::table('users')->where('id',$id)->value('password');
        // dd($dbpass);
        //判断原密码是否为空
        if(empty($oldpass)) {
            return back()->withErrors('原密码不能为空')->withInput();
        }
        //判断新密码是否为空
        if(empty($password)) {
            return back()->withErrors('新密码不能为空')->withInput();
        }
        //判断表单提交的密码和确认密码是否一致
        if($password != $repass) {
            return back()->withErrors('两次密码不一致')->withInput();
        }
        //判断input表单提交的原密码和数据库里的密码是否一致
        if (Hash::check($oldpass, $dbpass)) {
            //如果一致 就把新密码加密
            $password = Hash::make($password);
        } else {
            return back()->withErrors('新旧密码不一致');
        }
        //修改数据库里的密码
        $users = Users::find($id);
        $users->password = $password;
        $res = $users->save();
        //判断是否修改成功
        if($res) {
            session()->put('users',$users);
            return redirect('/user/setpass');
        } else {
            return back()->withErrors('修改失败');
        }

    }

    public function payPass()
    {
        return view('/home/user/paypass');
    }

    public function setPaypass(Request $request)
    {
        $id = Session::get('users')['id'];
        $input = $request->except('_token');
        //判断验证码是否正确
        $code = Session::get('code');
        // dd($code);
        if($input['paycode'] != $code) {
            return back()->withErrors('验证码错误');
        }
        //判断两次密码是否一致
        if($input['paypass'] != $input['repaypass']) {
            return back()->withErrors('两次密码不一致');
        }
        //如果一致就加密支付密码
        $paypass = Hash::make($input['paypass']);
        $users = Users::find($id);
        $users->UserDetail->paypass = $paypass;
        $res = $users->UserDetail->save();
        //判断是否修改成功
        if($res) {
            session()->put('users',$users);
            return redirect('/user/secure');
        } else {
            return back()->withErrors('修改失败');
        }
    }

    public function phone(Request $request)
    {
        return view('/home/user/phone');
    }

    public function setPhone(Request $request)
    {
        $input = $request->except('_token');
        //判断验证码是否正确
        $code = Session::get('code');
        // dd($code);
        if($input['phonecode'] != $code) {
            return back()->withErrors('验证码错误');
        }
        return redirect('/user/newphone');
    }

    public function newPhone()
    {
        return view('/home/user/newphone');
    }

    public function setNewPhone(Request $request)
    {
        $id = Session::get('users')['id'];
        $input = $request->except('_token');
        //判断手机号是否存在 
        $res = DB::table('users')->where('phone',$input['newPhone'])->first();
        if($res){
            return redirect('user/newphone')->withErrors('手机号已存在');
        }
        //判断验证码是否正确
        $code = Session::get('code');
        // dd($code);
        if($input['newPhonecode'] != $code) {
            return back()->withErrors('验证码错误');
        }

        //如果验证通过 修改进数据库
        $users = Users::find($id);
        $users->phone = $input['newPhone'];
        $res = $users->save();
        //判断是否修改成功
        if($res) {
            session()->put('users',$users);
            return redirect('/user/secure');
        } else {
            return back()->withErrors('修改失败');
        }
    }

    public function autonym()
    {
        return view('/home/user/autonym');
    }

    public function setAutonym(Request $request)
    {
        $id = Session::get('users')['id'];
        $input = $request->except('_token');
        $users = Users::find($id);
        $users->UserDetail->name = $input['name'];
        $users->UserDetail->id_card = $input['id_card'];
        $res = $users->UserDetail->save();
        //判断是否修改成功
        if($res) {
            session()->put('users',$users);
            return redirect('/user/secure');
        } else {
            return back()->withErrors('修改失败');
        }
    }
}
