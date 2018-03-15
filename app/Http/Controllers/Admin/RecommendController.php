<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\Recommend;

class RecommendController extends Controller
{
    /**
     * 推荐位控制器
     * @author [rengaolei]
     * @return 推荐位模板首页
     */
    public function index()
    {
        $data = Recommend::get();
        return view('admin.adv.recommendlist',['data'=>$data]);
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
        //获取表单提交的数据
        $input = $request->except('_token');
        // dd($input);
        //更改数据库中数据
        $data = Recommend::find($input['id']);
        $data->re_text = $input['re_text'];
        $data->re_img = $input['re_img'];
        $res = $data->save();
        // dump($res);
        if($res){
            return redirect('admin/recommend');
        }else{
            return back();
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
        $data = Recommend::find($id);
        return view('admin.adv.recommend',['data'=>$data]);
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
