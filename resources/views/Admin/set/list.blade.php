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
                                <div class="widget-title  am-cf">站点列表</div>


                            </div>
                            <div class="widget-body  am-fr">

                                <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                                    <div class="am-form-group">
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                                <button type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> <a href="{{url('/admin/set/create')}}"><font color="#fff">新增</font></a></button>

                                                <button type="button" style="margin-left:3px;" class="am-btn am-btn-default am-btn-warning"><span class="am-icon-plus"></span> <a href="/admin/set/alter"><font color="#fff">修改</font></a></button>

                                                <button type="button" style="margin-left:3px;" class="am-btn am-btn-default am-btn-danger"><span class="am-icon-plus"></span> <a href="{{url('/admin/set/delete')}}"><font color="#fff">删除</font></a></button>
                                                <!-- <button type="button" class="am-btn am-btn-default am-btn-secondary"><span class="am-icon-save"></span> 保存</button>
                                                <button type="button" class="am-btn am-btn-default am-btn-warning"><span class="am-icon-archive"></span> 审核</button>
                                                <button type="button" class="am-btn am-btn-default am-btn-danger"><span class="am-icon-trash-o"></span> 删除</button> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="am-u-sm-12">
                                    <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
                                        <thead>
                                            <tr>
                                               @foreach($title as $k=>$v)
                                                <th>{{$v}}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                            @foreach($content as $k=>$v)
                                                <th>{{$v}}</th>
                                            @endforeach
                                            </tr>
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