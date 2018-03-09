@extends('admin.layout.index')
@section('content')
<div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">广告位</div>
                                <div class="widget-function am-fr">
                                    <a href="javascript:;" class="am-icon-cog"></a>
                                </div>
                            </div>
                            <div class="widget-body  widget-body-lg am-fr">

                                <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>广告标题</th>
                                            <th>广告公告</th>
                                            <th>广告特惠</th>
                                            <th>广告图片</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <tr class="gradeX">
                                            <td>{{$adv['id']}}</td>
                                            <td>{{$adv['adv_title']}}</td>
                                            <td>{{$adv['adv_post']}}</td>
                                            <td>{{$adv['adv_disc']}}</td>
                                            <td><img src="{{$adv['adv_img']}}" style="width: 70px"></td>
                                            <td>
                                                <div class="tpl-table-black-operation">
                                                    <a href="/admin/adv/{{$adv['id']}}">
                                                        <i class="am-icon-pencil"></i> 编辑
                                                    </a>
                                                   <!--  <a href="javascript:;" class="tpl-table-black-operation-del">
                                                        <i class="am-icon-trash"></i> 删除
                                                    </a> -->
                                                </div>
                                            </td>
                                        </tr>
										                                      
                                        </tr>
                                        <!-- more data -->
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

@endsection