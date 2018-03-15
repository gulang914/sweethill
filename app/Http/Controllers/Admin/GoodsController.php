<?php

namespace App\Http\Controllers\Admin;

use App\model\Goods;
use App\model\GoodsDetail;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Symfony\Component\Console\Input\Input;

class GoodsController extends Controller
{

    public function uploads(Request $request)
    {
        //1.获取上传文件

        $file = $request->file('fileupload');
//        2.判断上传文件的有效性
        if($file->isValid()) {
//            获取文件后缀名
            $ext = $file->getClientOriginalExtension();    //文件拓展名

            //生成新文件名

            $newfilename = md5(date('YmdHis') . rand(1000, 9999) . uniqid()) . '.' . $ext;


            //上传到本地服务器
//            return $newfilename;
            $res = $file->move(public_path() . '/upload/image/goods/', $newfilename);

            //将上传文件的位置返回给客户端

            return '/upload/image/goods/' . $newfilename;
        }
    }

    public function detail($id)
    {
        dd(123);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if(!empty($request['search'])) {
            $search = $request['search'];
            Session(['goods_search'=>$search]);
        } else if(!empty(Session(['goods_search']))) {
            $search = Session(['goods_search']);
        } else {
            $search = '';
        }
        //分页
        if(!empty($request['perPage'])) {
            $perPage = $request['perPage'];
            Session(['goods_perPage'=>$perPage]);
        } else if(!empty(Session(['goods_perPage']))) {
            $perPage = Session(['goods_perPage']);
        } else {
            $perPage = '8';
        }
        if(empty($search)) {
            $goods = Goods::paginate($perPage);
        } else {
            $goods = Goods::where('goods_name','like','%'.$search.'%')->paginate($perPage);
        }
        return view('Admin/goods/list',['goods'=>$goods,'search'=>$search,'perPage'=>$perPage]);
    }

    /**
     * 加载添加页面
     *
     * @return \Illuminate\Http\Response
     */
    public function created(Request $request , $cid)
    {
        return view('Admin/Goods/create',['cid'=>$cid]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except('_token','file_upload');
        $input['goods_status'] = 0;
        $res = Goods::create($input);
        if($res){
            return redirect('admin/goods');
        }else{
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
        $goods = Goods::find($id);
        $goodsd = $goods->goodsdetail;
        $goods_name = $goods->goods_name;
//        dd($goodsd);
        if(!empty($goodsd)){
            return view('Admin/Goods/show',['goodsd'=>$goodsd,'goods_name'=>$goods_name]);
        }
        $id = $goodsd->gid;
        dd($id);
        return view('Admin/Goods/show');
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
        $goods = Goods::find($id);
        return view('admin/goods/edit',['goods'=>$goods]);
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
        $input = $request->except('_token');
        $goods = Goods::find($id);
        $goods->goods_name = $input['goods_name'];
        $goods->goods_photo = $input['goods_photo'];
        $res = $goods->save();
        if($res) {
            return redirect('admin/goods');
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
        //
        $goods = Goods::find($id);
        $res = $goods -> delete();
        if($res) {
            return redirect('admin/Goods');
        } else {
            return back();
        }
    }

    public function upload(Request $request)
    {
        //1.获取上传文件
        $file = $request->file('file_upload');
//        2.判断上传文件的有效性
        if($file->isValid()) {
//            获取文件后缀名
            $ext = $file->getClientOriginalExtension();    //文件拓展名

            //生成新文件名

            $newfilename = md5(date('YmdHis') . rand(1000, 9999) . uniqid()) . '.' . $ext;


            //上传到本地服务器
//            return $newfilename;
            $res = $file->move(public_path() . '/upload/image/goods/', $newfilename);

            //将上传文件的位置返回给客户端

            return '/upload/image/goods/' . $newfilename;
        }
    }
}
