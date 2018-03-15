<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\Carousel;

class CarouselController extends Controller
{
    /**
     * 轮播图控制器
     * @author  [rengaolei]
     * @return 轮播图首页模板
     */
    public function index()
    {
        $data = Carousel::get();
    
        return view('admin.adv.carousellist',['data'=>$data]);
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
     * 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //获取表单提交的数据
        $input = $request->except('_token');
        //更改数据库中数据
        $data = Carousel::find($input['id']);
        $data->car_title = $input['car_title'];
        $data->car_img = $input['car_img'];
        $res = $data->save();
        if($res){
            return redirect('admin/carousel');
        }else{
            return back();
        }
    }

    /**
     * 显示轮播图详情
     * @author [rengaolei]
     * @param  int  $id
     * @return 轮播图详情页面
     */
    public function show($id)
    {
        $data = Carousel::find($id);
        return view('admin.adv.carousel',['data'=>$data]);
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
