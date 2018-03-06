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
                                <div class="widget-title  am-cf">用户列表</div>


                            </div>
                            <div class="widget-body  am-fr">

                                <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                                    <div class="am-form-group">
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                                <button type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> <a href="{{url('/admin/cates/create')}}"><font color="#fff">新增</font></a></button>
                                                <!-- <button type="button" class="am-btn am-btn-default am-btn-secondary"><span class="am-icon-save"></span> 保存</button>
                                                <button type="button" class="am-btn am-btn-default am-btn-warning"><span class="am-icon-archive"></span> 审核</button>
                                                <button type="button" class="am-btn am-btn-default am-btn-danger"><span class="am-icon-trash-o"></span> 删除</button> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form action="/admin/cate" method="get">
                                    <div class="am-u-sm-12 am-u-md-6 am-u-lg-3">
                                        <div class="am-form-group tpl-table-list-select">
                                            <select data-am-selected="{btnSize: 'sm'}" name="perPage">
                                              <option value="0">请选择分页</option>
                                              @foreach ( [2,4,6,8] as $e)
                                                <option value="{{$e}}" {{ $e == request('perPage') ? 'selected' : '' }} >{{$e}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-3">
                                        <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">
                                            <input type="text" class="am-form-field " name="search" value="{{$search}}">
                                            <span class="am-input-group-btn">
                                        <!-- <button class="am-btn  am-btn-default am-btn-success tpl-table-list-field am-icon-search" type="button">搜索</button> -->
                                            <input type="submit" class="am-btn  am-btn-default am-btn-success tpl-table-list-field am-icon-search" type="button" value="搜索">
                                            </span>
                                        </div>
                                    </div>
                                </form>

                                <div class="am-u-sm-12">
                                    <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
                                        <thead>
                                        <tr>
                                            <th>编号 </th>
                                            <th>分类名称</th>
                                            <th>父级分类编号</th>
                                            <th>分类路径</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($cates as $k=>$v)
                                            <tr class="gradeX">
                                                <td>{{ $k+1 }} </td>
                                                <td>{{ $v->cate_name }}</td>
                                                <td>{{ $v->pid }}</td>
                                                <td>{{ $v->cname }}</td>

                                                <td>
                                                    <div class="tpl-table-black-operation">
                                                        <form action="/admin/cate/created/{{$v->id}}" method="get" style="display:inline">
                                                            {{--<input type="hidden" name="id" value="{{ $v->id }}">--}}
                                                           <span class="am-icon-plus-square am-icon-sm" style="position:relative;">
                                                                <input type="submit" style="position:absolute;opacity:0;top:0px;left:0px;" value="" >
                                                           </span>
                                                        </form>
                                                        <form action="/admin/cate/{{$v['id']}}" style="display:inline" method="post">
                                                            {{csrf_field()}}
                                                            {{method_field('DELETE')}}
                                                            <span class="am-icon-trash am-icon-sm" style="position:relative;">
                                                                <input type="submit" style="position:absolute;opacity:0;top:0px;" value="" >
                                                            </span>

                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            <!-- more data -->
                                        </tbody>
                                    </table>
                                </div>
                                <div class="am-u-lg-12 am-cf">

                                    <div class="am-fr" style="margin-right:300px;">
                                        <ul class="am-pagination tpl-pagination">
                                            <li class="am-disabled">
                                                @if(!empty(Session('cates_search')) && !empty(Session('cates_perPage')))
                                                {!! $cates->appends(['search'=>Session('cates_search'),'perPage'=>Session('cates_perPage')])->render() !!}
                                                @else
                                                {!! $cates->appends(['search'=>$search,'perPage'=>$perPage])->render() !!}
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
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
