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
        $data = $request->all();
        $id = Session::get('users')->id;
        $nickname = $data['nickname'];
        $email = $data['email'];
        $sex = $data['sex'];
        $age = $data['age'];
        $users = Users::find($id);
        $users -> nickname = $nickname;
        $users -> email = $email;
        $res = $users->save();
        if($res){
                $res = DB::table('user_detail')->where('uid',$id)->update(['age'=>$age,'sex'=>$sex]);
                if($res) {
                    session()->put('users',$users);
                    return '信息更新成功';
                }
        } else {
            return '信息更新失败';
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
            return '原密码不能为空';
        }
        //判断新密码是否为空
        if(empty($password)) {
            return '新密码不能为空';
        }
        //判断表单提交的密码和确认密码是否一致
        if($password != $repass) {
            return '两次密码不一致';
        }
        //判断input表单提交的原密码和数据库里的密码是否一致
        if (Hash::check($oldpass, $dbpass)) {
            //如果一致 就把新密码加密
            $password = Hash::make($password);
        } else {
            return '新旧密码不一致';
        }
        //修改数据库里的密码
        $users = Users::find($id);
        $users->password = $password;
        $res = $users->save();
        //判断是否修改成功
        if($res) {
            session()->put('users',$users);
            return '修改成功';
        } else {
            return '修改失败';
        }

    }

    public function payPass()
    {
        return view('/home/user/paypass');
    }

    public function setPaypass(Request $request)
    {
        $id = Session::get('users')['id'];
        $data = $request->all();
        //判断验证码是否正确
        $code = Session::get('code');
        // dd($code);
        if($data['paycode'] != $code) {
            return '验证码错误';
        }
        //判断两次密码是否一致
        if($data['paypass'] != $data['repaypass']) {
            return '两次密码不一致';
        }
        //如果一致就加密支付密码
        $paypass = Hash::make($data['paypass']);
        $users = Users::find($id);
        $users->UserDetail->paypass = $paypass;
        $res = $users->UserDetail->save();
        //判断是否修改成功
        if($res) {
            session()->put('users',$users);
            return '修改成功';
        } else {
            return '修改失败';
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
        $data = $request->all();
        //判断手机号是否存在 
        $res = DB::table('users')->where('phone',$data['newPhone'])->first();
        if($res){
            return '手机号已存在';
        }
        //判断验证码是否正确
        $code = Session::get('code');
        // dd($code);
        if($data['newPhonecode'] != $code) {
            return '验证码错误';
        }

        //如果验证通过 修改进数据库
        $users = Users::find($id);
        $users->phone = $data['newPhone'];
        $res = $users->save();
        //判断是否修改成功
        if($res) {
            session()->put('users',$users);
            return '修改成功';
        } else {
            return '修改失败';
        }
    }

    public function autonym()
    {
        return view('/home/user/autonym');
    }

    public function setAutonym(Request $request)
    {
        $id = Session::get('users')['id'];
        $data = $request->all();
        //判断真实姓名是否存在 
        $res = DB::table('user_detail')->where('name',$data['name'])->first();
        if($res){
            return '姓名已存在';
        }
        //判断真实姓名是否存在 
        $res = DB::table('user_detail')->where('id_card',$data['id_card'])->first();
        if($res){
            return '身份证号已存在';
        }
        $users = Users::find($id);
        $users->UserDetail->name = $data['name'];
        $users->UserDetail->id_card = $data['id_card'];
        $res = $users->UserDetail->save();
        //判断是否修改成功
        if($res) {
            session()->put('users',$users);
            return '修改成功';
        } else {
            return '修改失败';
        }
    }

    public function setPhoto(Request $request)
    {
        $photo = $request->file('uploads');
        // return $photo;
        if($photo->isValid()){
            //修改文件名并存入upload文件夹
            $extension = $photo->getClientOriginalExtension();
            $newName = date('YmdHis').mt_rand(100,999).".".$extension;
            $path = $photo -> move(public_path().'/uploads/users',$newName);
            $photo = '/uploads/users/'.$newName;

                if(empty($photo)) {
                 return '亲~还没有上传图片哟';
                }
                $id = Session::get('users')['id'];
                $users = Users::find($id);
                $users -> photo = $photo;
                $res = $users->save();
                if($res) {
                    Session::put('users',$users);
                    return '/uploads/users/'.$newName;
                } else {
                    return '头像上传失败，请确定网络是否连接或重新上传';
                }
        }
    }

    public function rest()
    {
        return view('/home/index/rest');
    }

    public function comment()
    {
        return view('/home/user/comment');
    }

}
