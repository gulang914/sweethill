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
                        <div class="widget-title  am-cf">商品列表</div>


                    </div>
                    <div class="widget-body  am-fr">

                        <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                            <div class="am-form-group">
                                <div class="am-btn-toolbar">
                                    <div class="am-btn-group am-btn-group-xs">
                                        <button type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> <a href="{{url('/admin/goods/create')}}"><font color="#fff">新增</font></a></button>
                                        <!-- <button type="button" class="am-btn am-btn-default am-btn-secondary"><span class="am-icon-save"></span> 保存</button>
                                        <button type="button" class="am-btn am-btn-default am-btn-warning"><span class="am-icon-archive"></span> 审核</button>
                                        <button type="button" class="am-btn am-btn-default am-btn-danger"><span class="am-icon-trash-o"></span> 删除</button> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form action="/admin/goods" method="get">
                            <div class="am-u-sm-12 am-u-md-6 am-u-lg-3">
                                <div class="am-form-group tpl-table-list-select">
                                    <select data-am-selected="{btnSize: 'sm'}" name="perPage">
                                        <option value="0">请选择分页</option>
                                        @foreach ( [8,10,12] as $e)
                                            <option value="{{ $e }}" {{ $e == request('perPage') ? 'selected' : '' }} >{{$e}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="am-u-sm-12 am-u-md-12 am-u-lg-3">
                                <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">
                                    <input type="text" class="am-form-field " name="search" value="{{ $search }}">
                                    <span class="am-input-group-btn">
                                <!-- <button class="am-btn  am-btn-default am-btn-success tpl-table-list-field am-icon-search" type="button">搜索</button> -->
                                    <input type="submit" class="am-btn  am-btn-default am-btn-success tpl-table-list-field am-icon-search" type="button" value="搜索">
                                    </span>
                                </div>
                            </div>
                        </form>

                        <div class="am-u-sm-12">
                            <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
                                <tr>
                                    <th>编号 </th>
                                    <th>商品名称</th>
                                    <th>商品状态</th>
                                    <th>商品图片</th>
                                    <th>商品分类id</th>
                                    <th>操作</th>
                                </tr>
                                <tbody>
                                @foreach($goods as $k=>$v)
                                    <tr class="gradeX">
                                        <td>{{ $k+1 }} </td>
                                        <td>{{ $v->goods_name }}</td>
                                        <td>{{ $v->goods_status }}</td>
                                        <td><img src="{{ $v->goods_photo }}" style="height: 80px;" alt=""></td>
                                        <td>{{ $v->cid }}</td>
                                        <td>

                                            <div class="tpl-table-black-operation">
                                                <form action="/admin/goods/{{$v['id']}}" method="get" title="商品详情" style="display:inline">
                                                    {{--<input type="hidden" name="id" value="{{ $v->id }}">--}}
                                                    <span class="am-icon-plus-square am-icon-sm" style="position:relative;">
                                                        <input type="submit" style="position:absolute;opacity:0;top:0px;left:0px;" value="" >
                                                   </span>
                                                </form>&nbsp;&nbsp;&nbsp;
                                                <form action="/admin/goods/{{$v['id']}}/edit" method="get" title="商品修改" style="display:inline">
                                                    {{--<input type="hidden" name="id" value="{{ $v->id }}">--}}
                                                    <span class="am-icon-plus-square am-icon-sm" style="position:relative;">
                                                        <input type="submit" style="position:absolute;opacity:0;top:0px;left:0px;" value="" >
                                                   </span>
                                                </form>&nbsp;&nbsp;&nbsp;
                                                <form action="/admin/goods/{{$v['id']}}" style="display:inline" title="商品删除" method="post">
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
                                        @if(!empty(Session('goods_search')) && !empty(Session('goods_perPage')))
                                            {!! $goods->appends(['search'=>Session('goods_search'),'perPage'=>Session('goods_perPage')])->render() !!}
                                        @else
                                            {!! $goods->appends(['search'=>$search,'perPage'=>$perPage])->render() !!}
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
@endsection
