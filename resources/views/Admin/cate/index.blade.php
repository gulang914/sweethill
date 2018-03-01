@extends('admin.layout.index')

@section('content')

    <div class="row am-cf">

        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12 widget-margin-bottom-lg">

            <div class="widget am-cf widget-body-lg">

                <div class="widget-body  am-fr">
                    <div class="am-scrollable-horizontal ">
                        <table width="100%" class="am-table am-table-compact am-text-nowrap tpl-table-black " id="example-r">
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
                            <tr class="even gradeC">
                                <td>{{ $k+1 }}</td>
                                <td>{{ $v->cate_name }}</td>
                                <th>{{ $v->pid }}</th>
                                <td>{{ $v->path }}</td>
                                <td>
                                    <div class="tpl-table-black-operation">
                                        <a href="javascript:;">
                                            <i class="am-icon-pencil"></i> 添加子分类
                                        </a>
                                        <a href="javascript:;" class="tpl-table-black-operation-del">
                                            <i class="am-icon-trash"></i> 删除
                                        </a>
                                    </div>
                                </td>
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
@endsection