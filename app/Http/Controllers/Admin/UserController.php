<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\User;
use DB;
use Hash;
use Validator;
use Session;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!empty($request['search'])) {
            $search = $request['search'];
            Session(['user_search'=>$search]);
        } else if(!empty(Session('user_search'))) {
            $search = Session('user_search');
        } else {
            $search = '';
        }

        if(!empty($request['perPage'])) {
            $perPage = $request['perPage'];
            Session(['user_perPage'=>$perPage]);
        } else if(!empty(Session('user_perPage'))) {
            $perPage = Session('user_perPage');
        } else {
            $perPage = '2';
        }

        if(empty($search)) {
            $user = DB::table('user')->paginate($perPage);
        } else { 
            $user = DB::table('user')->where('username','like','%'.$search.'%')->paginate($perPage);
        }
        return view('admin/user/list',['user'=>$user,'search'=>$search,'perPage'=>$perPage]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/user/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //表单提交的确认密码
        $repass = $request->input('repass');
        //判断表单提交的密码和确认密码是否一致
        //表单提交的数据
        $input = $request -> except('_token','repass','uploads');
        // dd($input);
        //判断表单提交的密码和确认密码是否一致
        if($input['password'] != $repass) {
            return back()->withErrors('两次密码不一致')->withInput();
        }
        //加密表单提交的密码
        $input['password'] = Hash::make($input['password']);
        //执行添加操作
        $res = DB::table('user')->insert($input);
        //判断操作是否成功
        if($res) {
            return redirect('admin/user');
        } else {
            return back()->withErrors('添加失败')->withInput();
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

        $user = User::find($id);
        return view('admin/user/edit',['user'=>$user]);
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
        //从数据库取出的数据
        $user = User::find($id);
        //数据库里的加密后的密码
        $userpass = $user['password'];
        //input表单提交的原密码
        $oldpass = $request->input('oldpass');
        //input表单提交的确认密码
        $repass = $request->input('repass');
        //input表单提交的数据
        $input = $request->except('_token','repass','oldpass','_method','search','perPage','uploads');
        //判断确认密码和新密码是否一致
        if($repass != $input['password']) {
            return back()->withErrors('两次密码不一致');
        }
        //判断input表单提交的原密码和数据库里的密码是否一致
        if (Hash::check($oldpass, $userpass)) {
            //如果一致 就把新密码加密
            $input['password'] = Hash::make($input['password']);
        } else {
            return back()->withErrors('新旧密码不一致');
        }
        //修改数据库里的原数据
        $res = DB::table('user')->where('id',$id)->update($input);
        //判断是否修改成功
        if($res) {
            return redirect('admin/user');
        } else {
            return back()->withErrors('修改失败');
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
        $user = User::find($id);
        $res = $user -> delete();
        if($res) {
            return redirect('admin/user');
        } else {
            return back()->withErrors('删除失败');
        }
    }
}
