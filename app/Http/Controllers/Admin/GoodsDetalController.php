<?php

namespace App\Http\Controllers\Admin;

use App\model\GoodsDetail;
use App\model\Label;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class GoodsDetalController extends Controller
{
    //给商品标签表添加数据
    public function adc($gid,$parm){
        DB::table('goods_label')->insert(['gid'=>$gid,'tid'=>$parm]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd(123123);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        dd($id);
        return view('Admin/goods_detal/create');
    }


    public function created($id)
    {
        dd($id);
        return view('Admin/goods_detal/create');
    }
    /**
     * 处理商品详情添加页面
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fenlei = $request->input('fenlei');
        $input = $request->except('_token','fenlei');
        $gid = $request->gid;
        $res = GoodsDetail::create($input);
        if($res){
            $typeone = [];
            foreach($fenlei as $v) {
                if($v == 1||$v == 6|| $v == 10){

                }else{
                    $pid = Label::where('id',$v)->first()->pid;
                    if(!in_array($pid, $typeone)){
                        $typeone[] = $pid;
                    }
                    $this->adc($gid,$v);
                }

            }
            foreach ($typeone as $v){
                $this->adc($gid,$v);
            }
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
    public function update(Request $request, $gid)
    {
        $input  =  $request->except('_token','id','fenlei','_method');
        $res = GoodsDetail::where('gid',$gid)->first()->update($input);
        $fenlei = $request->input('fenlei');
        if($res){
            $typeone = [];
            foreach($fenlei as $v) {
                if($v == 1||$v == 6|| $v == 10){

                }else{
                    $pid = Label::where('id',$v)->first()->pid;
                    if(!in_array($pid, $typeone)){
                        $typeone[] = $pid;
                    }
                    $this->adc($gid,$v);
                }

            }
            foreach ($typeone as $v){
                $this->adc($gid,$v);
            }
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
    }
}
