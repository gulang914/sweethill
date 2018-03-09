@extends('admin.layout.index')
@section('content')
<div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">推荐位</div>
                                <div class="widget-function am-fr">
                                    <a href="javascript:;" class="am-icon-cog"></a>
                                </div>
                            </div>
                            <div class="widget-body  widget-body-lg am-fr">
                                <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>推荐位文本</th>
                                            <th>推荐位图片</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $v)
                                        <tr class="gradeX">
                                            <td>{{$v['id']}}</td>
                                            <td>{{$v['re_text']}}</td>
                                            <!-- <td>{{$v['car_img']}}</td> -->
                                            
                                            <td><img src="{{$v['re_img']}}" style="width: 70px"></td>
                                            <td>
                                                <div class="tpl-table-black-operation">
                                                    <a href="/admin/recommend/{{$v['id']}}">
                                                        <i class="am-icon-pencil"></i> 编辑
                                                    </a>
                                                   <!--  <a href="javascript:;" class="tpl-table-black-operation-del">
                                                        <i class="am-icon-trash"></i> 删除
                                                    </a> -->
                                                </div>
                                            </td>
                                        </tr>
										  @endforeach                                    
                                        </tr>
                                        <!-- more data -->
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

@endsection