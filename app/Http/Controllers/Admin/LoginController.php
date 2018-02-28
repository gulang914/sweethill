<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\User;
use Gregwar\Captcha\CaptchaBuilder; 
use Gregwar\Captcha\PhraseBuilder;
use Hash;
use Session;
use Validator;
class LoginController extends Controller
{
    /**
     * 登陆页面的显示
     * @return 登陆页面
     */
    public function login()
    {
        return view('admin.login');
    }

    /**
     * 处理登录操作
     * @param  Request $request 请求
     * @return 后台主页
     */
    public function handle(Request $request)
    {
        //获取表单提交的数据
        $input = $request->except('_token');

        $rule = [
            'username' => 'required|between:5,18',
            'password' => 'required|between:5,20|alpha_dash',
            'captcha' => 'required'
        ];
        $msg = [
            'username.required' => '用户名是必填的哟',
            'password.required'  => '密码是必填的哟',
            'captcha.required'  => '验证码是必填的哟',
            'username.between'  => '用户名长度必须在5-18位之间哟',
            'password.between'  => '密码长度必须在5-20位之间哟',
            'password.alpha_dash'  => '密码格式不对哟',
        ];
        $validator = Validator::make($input, $rule, $msg);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        // 验证是否存在用户
        $user = User::where('username',$input['username'])->first();
        if(empty($user)) {
            return back()->withErrors('用户不存在')->withInput();
        }
        //数据库里的密码
        $upass = $user->password;
        //表单提交过来的密码
        $password = $input['password'];
        // 判断密码是否一致
        if (!Hash::check($password , $upass))
        {
            return back()->withErrors('两次密码不一致')->withInput();
        }

        //验证码验证
        if ($input['captcha'] != Session::get('code')) {
            return back()->withErrors('验证码不正确')->withInput();
        }

        //登陆成功以后把数据存到session
        session()->put('user',$input);

        return redirect('admin/index');
    }
    
    // 验证码生成
    public function captcha($tmp)
    {
        $phrase = new PhraseBuilder;
        // 设置验证码位数
        $code = $phrase->build(4);
        // 生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder($code, $phrase);
        // 设置背景颜色
        $builder->setBackgroundColor(220, 210, 230);
        $builder->setMaxAngle(25);
        $builder->setMaxBehindLines(0);
        $builder->setMaxFrontLines(0);
        // 可以设置图片宽高及字体
        $builder->build($width = 100, $height = 40, $font = null);
        // 获取验证码的内容
        $phrase = $builder->getPhrase();
        // 把内容存入session
        \Session::flash('code', $phrase);
        // 生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header("Content-Type:image/jpeg");
        $builder->save('admin/code/out.jpg');
        $builder->output();
    }
}
