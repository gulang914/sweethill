@extends('admin/layout/index')
@section('content')
        <!-- 内容区域 -->
        @if (count($errors) > 0)
                    <div class="alert alert-danger" style="color:red;">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <script type="text/javascript">
                    $("#hide").click(function() {
                        $(".alert").hide("slow");
                    });
                </script>
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="row-content am-cf">
                <div class="row">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title  am-cf">友情链接列表</div>


                            </div>
                            <div class="widget-body  am-fr">

                                <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                                    <div class="am-form-group">
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                                <button type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> <a href="{{url('/admin/link/create')}}"><font color="#fff">新增</font></a></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="am-u-sm-12">
                                    <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
                                        <thead>
                                            <tr>
                                                <th>id </th>
                                                <th>友情链接名 </th>
                                                <th>地址</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($link as $k=>$v)
                                            <tr>
                                                <td>{{$v['id']}}</td>
                                                <td>{{$v['name']}}</td>
                                                <td>{{$v['url']}}</td>
                                                    <td><div class="tpl-table-black-operation">
                                                        <form action="/admin/link/{{$v['id']}}/edit" method="get" style="display:inline">
                                                           <span class="am-icon-edit am-icon-sm" style="position:relative;">
                                                           <input type="submit" style="position:absolute;opacity:0;top:0px;" value="" >
                                                           </span>
                                                        </form>
                                                        <form action="/admin/link/{{$v['id']}}" style="display:inline" method="post">
                                                            {{csrf_field()}}
                                                            {{method_field('DELETE')}}

                                                           <span class="am-icon-trash am-icon-sm" style="position:relative;">
                                                           <input type="submit" style="position:absolute;opacity:0;top:0px;" value="" >
                                                           </span>
                                                        </form>
                                                    </div></td>
                                                </tr>
                                            @endforeach
                                            <!-- more data -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection