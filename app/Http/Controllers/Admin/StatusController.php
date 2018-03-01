<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\User;
class StatusController extends Controller
{
    public function status($id)
    {
        $user = User::find($id);
        if($user->status == 0) {
            $user->status = '1';
            $res = $user->save();
        } else if($user->status == 1) {
            $user->status = '0';
            $res = $user->save();
        } else {
            return back()->withErrors('获取用户状态失败');
        }

       if($res) {
            return back()->withErrors('修改成功');
       } else {
        return back()->withErrors('修改失败');
       }
    }
}
