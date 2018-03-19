<?php

namespace App\Http\Controllers\Admin;

use App\model\Cate;
use App\model\Goods;
use App\model\GoodsDetail;
use App\model\Label;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class GoodsController extends Controller
{

    //修改页面文件上传
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


    /**
     * Display a listing of the resource.
     *
     * @return 用户列表页
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
            Session(['goods_search'=>$search]);
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

    public function create()
    {
        $cates = Cate::all();
        return view('admin.goods.create11',['cates'=>$cates,'title'=>'添加商品']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param
     * @return 用户添加页面处理
     */
    public function store(Request $request)
    {
        $input = $request->except('_token','file_upload');
        $input['goods_status'] = 0;
        //添加的返回值
        $res = Goods::create($input);
        //判断是否添加成功，成功就进入添加商品详情，否则就返回
        if($res){
            //获取商品id
            $id = $res->id;
            $label = Label::where('pid',0)->get();
            $labels[] = '';
            foreach ($label as $v){
                $resd = Label::where('pid',$v->id)->get();
                $labels[$v->id] = $resd;
            }
            return view('admin/goods_detal/create',['id'=>$id,'label'=>$label,'labels'=>$labels]);
        }else{
            return back()->withErrors('添加失败')->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return 用户详情页面
     */
    public function show($id)
    {
        //

//        dd($id);
        $goods = Goods::find($id);
        $goodsd = $goods->goodsdetail;
//        dd($goodsd);
        if(!empty($goodsd)){
            $label = Label::where('pid',0)->get();
            $labels[] = '';
            foreach ($label as $v){
                $resd = Label::where('pid',$v->id)->get();
                $labels[$v->id] = $resd;
            }
            $tid = DB::table('goods_label')->where('gid',$id)->lists('tid');
            return view('Admin/goods_detal/show',['id'=>$id,'goodsd'=>$goodsd,'labels'=>$labels,'label'=>$label,'tid'=>$tid]);
        }
        return back()->withErrors('添加失败')->withInput();
    }

    /**
     * Show the form for editing the specified resource.`
     *
     * @param  int  $id
     * @return 商品修改页面
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
     * @return 商品修改页面处理
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
     * @return 商品删除处理
     */
    public function destroy($id)
    {
        $goods = Goods::find($id);
        $res = $goods -> delete();
        if($res) {
            return redirect('/admin/goods');
        } else {
            return back();
        }
    }
    //商品添加文件上传
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

    public function recy(Request $request)
    {
        //
        if(!empty($request['search'])) {
            $search = $request['search'];
            Session(['goods_search'=>$search]);
        } else if(!empty(Session(['goods_search']))) {
            $search = Session(['goods_search']);
        } else {
            $search = '';
            Session(['goods_search'=>$search]);
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
            $goods = Goods::onlyTrashed()->paginate($perPage);
        } else {
            $goods = Goods::onlyTrashed()->where('goods_name','like','%'.$search.'%')->paginate($perPage);
        }
        return view('Admin/goods/recy',['goods'=>$goods,'search'=>$search,'perPage'=>$perPage]);
    }

    //商品恢复方法
    public function recyc($id)
    {
        $res = Goods::withTrashed()->where('id',$id)->restore();
        if($res){
            return redirect('/admin/goods');
        } else {
            return back();
        }
    }

    //商品彻底删除方法
    public function recyd($id)
    {
//        dd($id);
        $res = Goods::onlyTrashed()->where('id', $id)->forceDelete();
        if($res){
            return redirect('/admin/goods');
        } else {
            return back();
        }
    }
}
