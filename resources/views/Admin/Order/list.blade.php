@extends('admin.layout.index')
@section('content')
            <div class="row-content am-cf">
                <div class="row">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title  am-cf">订单列表</div>
                            </div>
                            <div class="widget-body  am-fr">
                                <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                                    <div class="am-form-group">
                                        
                                    </div>
                                </div>
                            <!-- 搜索分页   -->
                            <form action="{{url('admin/order')}}" method="get">
                                <div class="am-u-sm-12 am-u-md-6 am-u-lg-3">
                                    <div class="am-form-group tpl-table-list-select">
                                        <select name="num" data-am-selected="{btnSize: 'sm'}" style="display: none;">
                                                <option>分页</option>
                                                <option value="2"
                                                  @if($request['num'] == 2)  selected  @endif
                                                >2
                                                </option> <option value="5"
                                                  @if($request['num'] == 5)  selected  @endif
                                                >5
                                                </option>
                                                <option value="10"
                                                  @if($request['num'] == 10)  selected  @endif
                                                >10
                                                </option>
                                                <option value="15"
                                                  @if($request['num'] == 15)  selected  @endif
                                                >15
                                                </option>
                                        </select>          
                                    </div>
                                </div>
                                <div class="am-u-sm-12 am-u-md-12 am-u-lg-3">
                                    <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">
                                        <input type="text" class="am-form-field"  name="keywords1" value="{{$request->keywords1}}" placeholder="订单编号">
                                        <span class="am-input-group-btn">
                                        <input class="am-btn  am-btn-default am-btn-success tpl-table-list-field am-icon-search" type="submit" value="搜索">
                                        </span>
                                    </div>
                                </div>
                                </div>
                            </form>    
                            <!-- 搜索分页   -->    

                                <div class="am-u-sm-12">
                                    <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black ">
                                        <thead>
                                            <tr>
                                                <!-- <th></th> -->
                                                <th>ID</th>
                                                <th>订单编号</th>
                                                <th>订单总金额</th>
                                                <th>订单时间</th>
                                                <th>订单状态</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($order as $k => $v)
                                            <tr class="gradeX">
                                               <!--  <td>
                                                   <img src="assets/img/k.jpg" class="tpl-table-line-img" alt="">
                                               </td> -->

                                                <td class="am-text-middle">{{ $v['id'] }}</td>
                                                <td class="am-text-middle">{{ $v['order_member'] }}</td>
                                                <td class="am-text-middle">{{ $v['totalmoney'] }}</td>
                                                <td class="am-text-middle">{{ $v['order_time'] }}</td>
                                                
                                                @if($v['status'] == 1)
                                                    <td class="am-text-middle">{{'待发货'}}</td>
                                                @elseif($v['status'] == 2)
                                                    <td class="am-text-middle">{{'已发货'}}</td>
                                                @else
                                                     <td class="am-text-middle">{{'待评价'}}</td>
                                                @endif
                                                
                                                <td class="am-text-middle">
                                                    <div class="tpl-table-black-operation">
                                                            <a href="/admin/order/{{ $v['id'] }}" class="tpl-table-black-operation-del">
                                                                <i class="am-icon-trash"></i> 订单详情
                                                            </a>
                                                    </div>
                                                </td>
                                            </tr>
                                                @endforeach
                                     
                                            <!-- more data -->
                                        </tbody>
                                    </table>
                                </div>
                                <div class="am-u-lg-12 am-cf">

                                    <div class="am-fr">
                                       <ul class="am-pagination tpl-pagination" >
                                       </ul>
                                           {!! $order->appends($request->all())->render() !!}
                              
                                   </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- </div> -->
@endsection