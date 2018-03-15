<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\Gps;
class GpsController extends Controller
{
    /**
     * 显示导航列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gps = new Gps;
        $gps = $gps -> all();
        return view('admin/gps/list',['gps'=>$gps]);
    }

    /**
     * 显示导航添加页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/gps/create');
    }

    /**
     * 处理导航添加操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->input('name');
        $routes = $request->input('routes');
        $gps = new Gps;
        $gps -> name = $name;
        $gps -> routes = $routes;
        $res = $gps->save();
        if($res) {
            return redirect('admin/gps');
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
     * 显示导航修改页面.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gps = Gps::find($id);
        return view('admin/gps/edit',['gps'=>$gps]);
    }

    /**
     * 处理导航修改操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $name = $request->input('name');
        $routes = $request->input('routes');
        $gps = Gps::find($id);
        $gps -> name = $name;
        $gps -> routes = $routes;
        $res = $gps -> save();
        if($res) {
            return redirect('admin/gps');
        } else {
            return back()->withErrors('修改失败')->withInput();
        }
    }

    /**
     * 处理导航删除操作
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gps = Gps::find($id);
        $res = $gps -> delete($gps);
        if($res) {
            return redirect('admin/gps');
        } else {
            return back()->withErrors('删除失败')->withInput();
        }
    }
}
