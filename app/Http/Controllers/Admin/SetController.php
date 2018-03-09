<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\config;
use DB;
use Storage;
class SetController extends Controller
{
    /**
     * 网站配置列表的显示
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //获取网站配置表的数据
        $config = Config::get();
        //给title和content分为两个数组
        $title[]='';
        $content[]='';
        //遍历数组
        foreach ($config as $key => $value) {
            $title[]=$value['title'];
            $content[]=$value['content'];
        }
        // dump($title);
        // dd($content);
        return view('admin/set/list',['title'=>$title,'content'=>$content]);
    }

    /**
     * 网站配置添加的显示
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/set/create');
    }

    /**
     * 处理网站配置的添加操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        //获取表单提交的数据
        $title = $request->input('title');
        //获取添加的数据类型
        $type = $request->input('type');
        //如果类型是文件 1为文件
        if($type == '1') {
            //如果type是1 那么type就应该是文件 所以 $type = 'file'
            $type = 'file';
            //获取文件
            $content = $request->file('content');
            // 检测文件是否有效
            if($content->isValid()){
                //修改文件名并存入upload文件夹
                $extension = $content->getClientOriginalExtension();
                $newName = date('YmdHis').mt_rand(100,999).".".$extension;
                $path = $content -> move(public_path().'/uploads/config',$newName);
                $content = 'uploads/config/'.$newName;
            }
            // 如果类型是checkbox 2为checkbox
        } else if($type == '2') {
            //如果type是1 那么type就应该是单选按钮 所以 $type = 'checkbox'
            $type = 'checkbox';
            // 如果获取到的值为on 就代表开启 改成1 并存入数据库
            if($request->input('content') == 'on') {
                //1 为开启 0 为关闭
                $content = '1';
            } else {
                $content = '0';
            }
        } else {
            //否则数据只能是文本 所以直接获取传过来的文本 所以$type = 'text'
            $type = 'text';
            $content = $request->input('content');
        }
        // dd($content);
        //获取数据库里的数据
        $DBtitle = Config::where('title',$title)->first();
        // dd($DBtitle);
        //判断title是否存在
        if(!empty($DBtitle)) {
            return back()->withErrors('重复的网站标题')->withInput();
        }
        //添加数据
        $config = new Config;
        $config->title = $title;
        $config->content = $content;
        $config->type = $type;
        $res = $config->save(); 
        //判断是否添加成功
        if($res) {
            return redirect('admin/set');
        } else {
            return back()->withErrors('添加失败')->withInput();
        }
    }


    //修改网站配置的页面显示
    public function alter() 
    {
        //获取数据表里所以的type
        $type = Config::all('type');
        //获取数据表里的所有title
        $title = Config::all('title');
        // $text = DB::table('config')->where('type'=>'text')->get();
        // $file = DB::table('config')->where('type'=>'file')->get();
        // $check = DB::table('config')->where('type'=>'check')->get();
        // 获取所有title为status的对应的值content
        $status = DB::table('config')->where('title','status')->value('content');
        return view('/admin/set/alter',['title'=>$title,'status'=>$status,'type'=>$type]);
    }
    //接收ajax
    public function cajax(Request $request)
    {
        // return 1;
        $value = $request->input();
        $type = DB::table('config')->where('title',$value)->value('type');
        return $type;
    }
    //修改网站配置的修改操作
    public function amend(Request $request)
    {
        // dd($request->all());
        //获取form表单传过来的title
        $title = $request->input('title');
        //获取form表单提交过来的type
        $type = $request->input('type');
        if($type == 'checkbox') {
            //代表传过来的数据是status
            $content = $request->input('content');
            // 如果status不是空的 网站开启
            // 1 为开启 0 为关闭
            if(!empty($content)) {
                $content = '1';
            } else {
                $content = '0';
            }
        } else if($type == 'file') {
            //否则如果传过来的数据是文件
            $content = $request->file('content');
            //检测文件是否有效
            if($content->isValid()){
                //修改文件名并存到upload文件夹
                $extension = $content->getClientOriginalExtension();
                $newName = date('YmdHis').mt_rand(100,999).".".$extension;
                $path = $content -> move(public_path().'/uploads/config',$newName);
                $content = 'uploads/config/'.$newName;
            }
        } else {
            //代表传过来的数据是文本
            $content = $request->input('content');
        }
        //把传过来的title作为条件判断修改的content
        $res = DB::table('config')->where('title',$title)->update(['content'=>$content]);
        //判断是否修改成功
        if($res) {

            return redirect('admin/set');
        } else {
            return back()->withErrors('修改失败')->withInput();
        }
    }

    //网站配置删除页面的显示
    public function delete(Request $request)
    {
        //获取数据表config里的所有title
        $title = Config::all('title');
        return view('admin/set/delete',['title'=>$title]);
    }

    //网站配置的删除操作
    public function remove(Request $request)
    {
        // 获取表单提交过来的title 也就是要删除的title
        $title = $request->input('title');
        //把title作为条件进行删除操作
        $res = DB::table('config')->where('title',$title)->delete();
        //判断是否修改成功
        if($res) {
            return redirect('admin/set');
        } else {
            return back()->withErrors('删除失败')->withInput();
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
