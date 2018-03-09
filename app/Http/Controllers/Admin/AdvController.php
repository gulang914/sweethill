<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\Adv;

class AdvController extends Controller
{
    //广告图片上传
    public function upload(Request $request)
   {
        
        //1.获取上传文件
        $file = $request->file('file_upload');
        // return $file;
        //2.判断上传文件的有效性
        if($file->isValid()){
            //获取文件后缀名
            $ext = $file->getClientOriginalExtension();
            //生成新文件名
            $newfilename = md5(date('YmdHis').rand(1000,9999).uniqid()).'.'.$ext;
            //1.上传到本地服务器
            $res = $file->move(public_path().'/upload/adv', $newfilename);
            //将上传文件的位置返回给客户端
            return '/upload/adv/'.$newfilename;
        }
    }

    /**
     * 显示广告位列表
     * @author [rengaolei]
     * @param
     * @return 广告模板
     */
    public function index()
    {
        //广告表中就一条数据 
        $adv = Adv::get();
        foreach ($adv as $key => $value) {
            $adv = $value;
        }
        // dump($adv);
        return view('admin.adv.advlist',['adv'=>$adv]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * 处理数据
     * @author [rengaolei]
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //获取广告位提交的数据
        $data = $request->except('_token');
        // dump($data['id']);
        // dump($data);
        //表单验证
        // $this->validate($request, [
        // 'adv_title' => 'required',
        // 'adv_post' => 'required',
        // 'adv_disc' => 'required',
        
        // ],[
        //     'adv_title'=>'广告标题不能为空',
        //     'adv_post'=>'广告公告不能为空',
        //     'adv_disc'=>'广告特惠不能为空'

        // ]);
               
        // 将数据更新到数据库
        $adv = adv::find($data['id']);
        $adv->adv_title = $data['adv_title'];
        $adv->adv_post = $data['adv_post'];
        $adv->adv_disc = $data['adv_disc'];
        $adv->adv_img = $data['adv_img'];
        $res = $adv->save();
        if($res){
            return redirect('admin/adv');
        }else{
            return back();
        }
    }

    /**
     * 展示广告位详情
     *
     * @param  int  $id
     * @return 返回广告位详情页面
     */
    public function show($id)
    {
        $adv = Adv::find($id);
        return view('admin.adv.adv',['adv'=>$adv]);
    }

    /**
     * 修改页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 处理修改数据
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
