@extends('home.layout.user')
@section('content')
<div class="user-order">

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(Session::has('success'))
<div class="alert alert-info">
 	{{Session::get('success')}} 
</div>
@endif
<script type="text/javascript">
	setInterval(function(){
		$('.alert-info').hide();
	},2000);
</script>

						<!--标题 -->
						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">订单管理</strong> / <small>Order</small></div>
						</div>
						<hr>

						<div class="am-tabs am-tabs-d2 am-margin" data-am-tabs="">

							<ul class="am-avg-sm-5 am-tabs-nav am-nav am-nav-tabs">
								<li class="am-active"><a href="#tab1">所有订单</a></li>
								<li><a href="#tab3">待发货</a></li>
								<li><a href="#tab4">待收货</a></li>
								<li><a href="#tab5">待评价</a></li>
							</ul>

							<div class="am-tabs-bd" style="touch-action: pan-y; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
								<div class="am-tab-panel am-fade am-in am-active" id="tab1">
									<div class="order-top">
										<div class="th th-item">
											商品
										</div>
										<div class="th th-price">
											单价
										</div>
										<div class="th th-number">
											数量
										</div>
										<div class="th th-operation">
											商品操作
										</div>
										<div class="th th-amount">
											合计
										</div>
										<div class="th th-status">
											交易状态
										</div>
										<div class="th th-change">
											交易操作
										</div>
									</div>

									<div class="order-main">
										<div class="order-list">
										<!-- 所有订单 -->
										<!--交易成功-->
										<!-- 所有订单====遍历====开始 -->
										@foreach($order as $k => $v)
										<div class="order-status5">
											<div class="order-title">
												
												<div class="dd-num">订单编号：<a href="javascript:;">{{ $v['order_member'] }}</a></div>
												<span>成交时间：{{ $v['order_time'] }}</span>
												<!-- <em>店铺：小桔灯</em> -->
											</div>
											<div class="order-content">
												<div class="order-left">
													<ul class="item-list">
														<li class="td td-item">
															<div class="item-pic">
																
																<!-- 商品的图片 -->
																<a href="#" class="J_MakePoint">
																	<img src="{{ $goods['goods_photo'] }}" class="itempic J_ItemImg">
																</a>
															</div>
															<div class="item-info">
																<div class="item-basic-info">
																	
																	<!-- 商品名称 -->
																	
																		<p>商品名称：{{ $goods['goods_name'] }}</p>
																		<p class="info-little">类型：{{$v['type']}}</p>
																		
																</div>
															</div>
														</li>
														<li class="td td-price">

															<!-- 商品的单价 -->
															<div class="item-price">
																￥{{ $price}}
															</div>
														</li>
														<li class="td td-number">
															<div class="item-number">
																<span>×</span>{{(int)($v['totalmoney']/$price)}}
															</div>
														</li>
														<li class="td td-operation">
															<div class="item-operation">
																<div class="item-operation">
																	<a href="#">退款</a>
																</div>
															</div>
														</li>
													</ul>
										
												</div>
												<div class="order-right">
												
													
											
													<li class="td td-amount">
														<!-- 商品总价 -->

														<div class="item-amount">
															合计：{{ $v['totalmoney'] }}
														</div>
													</li>
													<div class="move-right">
														<li class="td td-status">
															<div class="item-status">
																@if($v['status'] == 2)
																<p class="Mystatus">交易成功</p>
																@endif
																@if($v['status'] == 1)
																	<p class="Mystatus">买家已付款</p>
																@endif
																<!-- <p class="order-info"><a href="orderinfo.html">订单详情</a></p> -->
																<p class="order-info"><a href="logistics.html"></a></p>
															</div>
														</li>
														@if($v['status'] <= 2)
														<li class="td td-change">
															
																<!-- <div class="am-btn am-btn-danger anniu"> -->
																	<form action="/index/order/{{ $v['id'] }}" method="get">
																		<!-- <input type="hidden" name="id" value="{{ $v['id'] }}"> -->
																		{{ csrf_field() }}
																		<a href="#">
																			<input type="submit" value="删除订单" class="am-btn am-btn-danger anniu">
																		</a>
																	</form>
																<!-- </div> -->
														</li>
														@endif

															<script type="text/javascript">
																// $('.delete').click(function(){
																	
																// 	var oid = $('.oid').val();
																// 	console.log(oid);

									                                
									                                // window.location.href = '/index/success?gid='+gid+'&aid='+aid+'&money='+money+'&type='+type;
																// });

																// 删除地址
																// $('.delete').click(function(){
																// 	alert(1);
																// 	//获取id
																// 	var addid = $(this).parent('.new-addr-btn').find('.addressid').val();
																// 	// console.log(addid);	
																// 	var formData = new FormData();
																// 	formData.append('addid',addid);				
																	// console.log(addid);
																	// $.ajax({
																 //            type: "POST",
																 //            url: "/index/deleteaddress",
																	// 		headers: {
																	//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
																	//         },
																 //            data: formData, //要发送的数据
																 //            contentType: false,
																 //            processData: false,
																	//     	async:true,
																	//     	cache:false,
																 //            success: function(data) {
																 //            	// console.log(data);
																 //            	if(data.status == 1){
																	// 				layer.msg('删除成功', {
																	// 								  icon: 6,
																	// 								  time: 1000 //1秒关闭（如果不配置，默认是3秒）
																	// 								}, function(){
																	// 								  parent.location.reload()
																	// 						});
																	// 			}else{
																	// 				layer.alert('删除失败', {
																	// 									  icon: 5,
																	// 									  skin: 'layer-ext-moon'
																	// 									})
																	// 			}
																 //            },
																 //            error: function(XMLHttpRequest, textStatus, errorThrown) {
																 //                alert("上传失败，请检查网络后重试");
																 //            }
																 //        });
																// });
															</script>

													</div>
												</div>
											</div>
										</div>
										<!-- 所有订单====遍历====结束 -->	
										@endforeach	
											

										</div>

									</div>

								</div>
								<div class="am-tab-panel am-fade" id="tab2">

									<div class="order-top">
										<div class="th th-item">
											商品
										</div>
										<div class="th th-price">
											单价
										</div>
										<div class="th th-number">
											数量
										</div>
										<div class="th th-operation">
											商品操作
										</div>
										<div class="th th-amount">
											合计
										</div>
										<div class="th th-status">
											交易状态
										</div>
										<div class="th th-change">
											交易操作
										</div>
									</div>

								
								</div>
								<div class="am-tab-panel am-fade" id="tab3">
									<div class="order-top">
										<div class="th th-item">
											商品
										</div>
										<div class="th th-price">
											单价
										</div>
										<div class="th th-number">
											数量
										</div>
										<div class="th th-operation">
											商品操作
										</div>
										<div class="th th-amount">
											合计
										</div>
										<div class="th th-status">
											交易状态
										</div>
										<div class="th th-change">
											交易操作
										</div>
									</div>
									
									<!-- 待发货标签中的订单 -->
									@foreach($order as $k => $v)
									<div class="order-main">
										<div class="order-list">
											<div class="order-status2">
												<div class="order-title">
													<div class="dd-num">订单编号：<a href="javascript:;">{{ $v['order_member'] }}</a></div>
													<span>成交时间：{{ $v['order_time'] }}</span>
													<!--    <em>店铺：小桔灯</em>-->
												</div>
												<div class="order-content">
													<div class="order-left">
														<!-- 订单中的商品 -->
														<ul class="item-list">
															<li class="td td-item">
																<div class="item-pic">
																	<a href="#" class="J_MakePoint">
																		<!-- 此图片是商品图片，从商品表获取 -->
																		<img src="{{ $goods['goods_photo'] }}" class="itempic J_ItemImg">
																	</a>
																</div>
																<div class="item-info">
																	<div class="item-basic-info">
																	<!-- 商品名称 -->
																		<p>商品名称：{{ $goods['goods_name'] }}</p>
																		<p class="info-little">类型：{{$v['type']}}</p>
																</div>
																</div>
															</li>
															<li class="td td-price">
																<div class="item-price">
																	￥{{ $price}}
																</div>
															</li>
															<li class="td td-number">
																<div class="item-number">
																	<span>×</span>{{(int)($v['totalmoney']/$price)}}
																</div>
															</li>
															<li class="td td-operation">
																<div class="item-operation">
																	<a href="#">退款</a>
																</div>
															</li>
														</ul>

														
													</div>
													<div class="order-right">
														<li class="td td-amount">
															<div class="item-amount">
																合计：{{ $v['totalmoney'] }}
															</div>
														</li>
														<div class="move-right">
															<li class="td td-status">
																<div class="item-status">
																@if($v['status'] == 1)
																	<p class="Mystatus">买家已付款</p>
																@endif
																</div>
															</li>
															<li class="td td-change">
																<div class="am-btn am-btn-danger anniu">
																	提醒发货</div>
															</li>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									@endforeach
								</div>
								<div class="am-tab-panel am-fade" id="tab4">
									<div class="order-top">
										<div class="th th-item">
											商品
										</div>
										<div class="th th-price">
											单价
										</div>
										<div class="th th-number">
											数量
										</div>
										<div class="th th-operation">
											商品操作
										</div>
										<div class="th th-amount">
											合计
										</div>
										<div class="th th-status">
											交易状态
										</div>
										<div class="th th-change">
											交易操作
										</div>
									</div>

									




									<div class="order-main">
										<div class="order-list">
										
											<!-- 待收货标签中的订单 -->
											@foreach($order as $k => $v)
											<div class="order-status3">
												<div class="order-title">
													<div class="dd-num">订单编号：<a href="javascript:;">{{ $v['order_member'] }}</a></div>
													<span>成交时间：{{ $v['order_time'] }}</span>
													<!--    <em>店铺：小桔灯</em>-->
												</div>
												<div class="order-content">
													<div class="order-left">
														<ul class="item-list">
															<li class="td td-item">
																<div class="item-pic">
																	<a href="#" class="J_MakePoint">
																		<img src="{{ $goods['goods_photo'] }}" class="itempic J_ItemImg">
																	</a>
																</div>
																<div class="item-info">
																	<div class="item-basic-info">
																		
																		<!-- 商品名称 -->
																		
																			<p>商品名称：{{ $goods['goods_name'] }}</p>
																			<p class="info-little">类型：{{$v['type']}}</p>
																			
																	</div>
																</div>
															</li>
															<li class="td td-price">
																<div class="item-price">
																	￥{{ $price}}
																</div>
															</li>
															<li class="td td-number">
																<div class="item-number">
																	<span>×</span>{{(int)($v['totalmoney']/$price)}}
																</div>
															</li>
															<li class="td td-operation">
																<div class="item-operation">
																	<a href="#">退款</a>
																</div>
															</li>
														</ul>

													</div>
													<div class="order-right">
														<li class="td td-amount">
															<div class="item-amount">
																合计：{{ $v['totalmoney'] }}
															</div>
														</li>
														<div class="move-right">
															<li class="td td-status">
																<div class="item-status">
																	<p class="Mystatus">卖家已发货</p>
																	<!-- <p class="order-info"><a href="orderinfo.html">订单详情</a></p> -->
																	<p class="order-info"><a href="logistics.html"></a></p>
																	<p class="order-info"><a href="#"></a></p>
																</div>
															</li>
															<li class="td td-change">
																<div class="am-btn am-btn-danger anniu">
																	确认收货</div>
															</li>
														</div>
													</div>
												</div>
											</div>
											@endforeach

										</div>
									</div>
								</div>

								<div class="am-tab-panel am-fade" id="tab5">
									<div class="order-top">
										<div class="th th-item">
											商品
										</div>
										<div class="th th-price">
											单价
										</div>
										<div class="th th-number">
											数量
										</div>
										<div class="th th-operation">
											商品操作
										</div>
										<div class="th th-amount">
											合计
										</div>
										<div class="th th-status">
											交易状态
										</div>
										<div class="th th-change">
											交易操作
										</div>
									</div>

									<div class="order-main">
										<div class="order-list">
											

											<!--待评价中的订单	-->
										@foreach($order as $k => $v)
										<div class="order-status4">
												<div class="order-title">
													<div class="dd-num">订单编号：<a href="javascript:;">{{ $v['order_member'] }}</a></div>
													<span>成交时间：{{ $v['order_time'] }}</span>

												</div>
												<div class="order-content">
													<div class="order-left">
														<ul class="item-list">
															<li class="td td-item">
																<div class="item-pic">
																	<a href="#" class="J_MakePoint">
																		<img src="{{ $goods['goods_photo'] }}" class="itempic J_ItemImg">
																	</a>
																</div>
																<div class="item-info">
																	<div class="item-basic-info">
																		<!-- 商品名称 -->
																		
																			<p>商品名称：{{ $goods['goods_name'] }}</p>
																			<p class="info-little">类型：{{$v['type']}}</p>
																			
																	</div>
																</div>
															</li>
															<li class="td td-price">
																<div class="item-price">
																	￥{{ $price}}
																</div>
															</li>
															<li class="td td-number">
																<div class="item-number">
																	<span>×</span>{{(int)($v['totalmoney']/$price)}}
																</div>
															</li>
															<li class="td td-operation">
																<div class="item-operation">
																	<!-- <a href="refund.html">退款/退货</a> -->
																</div>
															</li>
														</ul>

													</div>
													<div class="order-right">
														<li class="td td-amount">
															<div class="item-amount">
																合计：{{ $v['totalmoney'] }}
															</div>
														</li>
														<div class="move-right">
															<li class="td td-status">
																<div class="item-status">
																	<p class="Mystatus">交易成功</p>
																	<!-- <p class="order-info"><a href="orderinfo.html">订单详情</a></p> -->
																	<p class="order-info"><a href="logistics.html"></a></p>
																</div>
															</li>
															<li class="td td-change">
																<a href="#">
																	<div class="am-btn am-btn-danger anniu">
																		评价商品</div>
																</a>
															</li>
														</div>
													</div>
												</div>
										</div>
										@endforeach
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>			
@endsection