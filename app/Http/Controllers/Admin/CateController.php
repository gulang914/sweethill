<?php

namespace App\Http\Controllers\Admin;

use App\model\Cate;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CateController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //搜索
//        dd($request->input('perPage'));
        if(!empty($request['search'])) {
            $search = $request['search'];
            Session(['cate_search'=>$search]);
        } else if(!empty(Session(['cate_search']))) {
            $search = Session(['cate_search']);
        } else {
            $search = '';
        }
        //分页
        if(!empty($request['perPage'])) {
            $perPage = $request['perPage'];
            Session(['cate_perPage'=>$perPage]);
        } else if(!empty(Session(['cate_perPage']))) {
            $perPage = Session(['cate_perPage']);
        } else {
            $perPage = '2';
        }
        if(empty($search)) {
            $cates = Cate::paginate($perPage);
        } else {
            $cates = Cate::where('cate_name','like','%'.$search.'%')->orderBy('path','asc')->paginate($perPage);
        }
        foreach($cates as $k => $v){
            $cates[$k]['cname'] = str_replace(',','|----',$cates[$k]['path']);
        };
        return view('admin.cate.list',['cates'=>$cates,'search'=>$search,'perPage'=>$perPage]);
    }
    /**
     *添加分类
     *
     */
    public function create()
    {
        return view('admin/cate/create');
    }
    /**
     *添加分类操作
     *
     */
    public function store(Request $request)
    {
        //接收数据
        $input = $request -> except('_token','repass');
//        处理数据
        $cates = new Cate();
        $cates->cate_name = $input['cate_name'];
        $cates->pid = 0;
        $cates->path = 0;
        $res = $cates->save();
        if($res) {
            return redirect('admin/cate');
        } else {
            return back()->withErrors('添加失败')->withInput();
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function created($id)
    {
         return view('admin/cate/created',['id'=>$id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function docreate(Request $request)
    {
        //接收数据
        $input = $request -> except('_token','repass');
//        处理数据
        $id = $input['id'];
        $cate = Cate::find($id);
        $oldpath = $cate->path;
        $path = $oldpath.','.$id;
        $cate_name = $input['cate_name'];

        $cates = new Cate();
        $cates->cate_name = $cate_name;
        $cates->pid = $id;
        $cates->path = $path;
        $res = $cates->save();
        if($res) {
            return redirect('admin/cate');
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
        $res = Cate::where('pid',$id)->first();
        if($res){
            return back()->withErrors('有子分类不可以删除');
        }
        $cate = Cate::find($id);
        $res = $cate -> delete();
        if($res) {
            return redirect('admin/cate');
        } else {
            return back()->withErrors('删除失败');
        }
    }
}
