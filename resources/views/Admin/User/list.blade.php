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
                                                <button type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> <a href="{{url('/admin/user/create')}}"><font color="#fff">新增</font></a></button>
                                                <!-- <button type="button" class="am-btn am-btn-default am-btn-secondary"><span class="am-icon-save"></span> 保存</button>
                                                <button type="button" class="am-btn am-btn-default am-btn-warning"><span class="am-icon-archive"></span> 审核</button>
                                                <button type="button" class="am-btn am-btn-default am-btn-danger"><span class="am-icon-trash-o"></span> 删除</button> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form action="/admin/user" method="get">
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
                                                <th>id </th>
                                                <th>头像 </th>
                                                <th>用户名</th>
                                                <th>手机号</th>
                                                <th>邮箱</th>
                                                <th>状态</th>
                                                <th>权限</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($user as $k=>$v)
                                            <tr class="gradeX">
                                                <td>{{$v['id']}} </td>
                                                <!-- <td><img style="width:40px;" src="/upload/{{$v['photo']}}"></td> -->
                                            <td>
                                                <img style="width:40px;" src="{{$v['photo']}}">
                                            </td>
                                                <td>{{$v['username']}}</td>
                                                <td>{{$v['phone']}}</td>
                                                <td>{{$v['email']}}</td>
                                                @if($v['status'] == 0)
                                                    <td>启用</td>
                                                @else
                                                    <td>禁用</td>  
                                                @endif

                                                @if($v['auth'] == 0)
                                                    <td>管理员</td>
                                                @else
                                                    <td>普通用户</td>  
                                                @endif
                                                <td>
                                                    <div class="tpl-table-black-operation">
                                                        <a href="/admin/status/{{$v['id']}}" class="tpl-table-black-operation-del">
                                                            @if($v['status'] == 0)
                                                                <i class="am-icon-user-times am-icon-sm"></i>禁用
                                                            @else
                                                                <i class="am-icon-user am-icon-sm"></i>启用
                                                            @endif
                                                        </a>
                                                        <form action="/admin/user/{{$v['id']}}/edit" method="get" style="display:inline">
                                                           <span class="am-icon-edit am-icon-sm" title="修改" style="position:relative;">
                                                           <input type="submit" style="position:absolute;opacity:0;top:0px;" value="" >
                                                           </span>
                                                           <!-- @if(!empty($search))
                                                            <input type="hidden" name="search" value="{{$search}}">
                                                           @endif
                                                           @if(!empty($perPage))
                                                            <input type="hidden" name="perPage" value="{{$perPage}}">
                                                            @endif -->
                                                        </form>
                                                        <form action="/admin/user/{{$v['id']}}" style="display:inline" method="post">
                                                            {{csrf_field()}}
                                                            {{method_field('DELETE')}}

                                                           <span class="am-icon-trash am-icon-sm" title="删除" style="position:relative;">
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
                                                @if(!empty(Session('user_search')) && !empty(Session('user_perPage')))
                                                {!! $user->appends(['search'=>Session('user_search'),'perPage'=>Session('user_perPage')])->render() !!}
                                                @else
                                                {!! $user->appends(['search'=>$search,'perPage'=>$perPage])->render() !!}
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