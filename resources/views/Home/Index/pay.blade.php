<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0 ,minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<title>{{Session::get('content')['title']}}</title>
		<link href="/model/home/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />
		<link href="/model/home/basic/css/demo.css" rel="stylesheet" type="text/css" />
		<link href="/model/home/css/cartstyle.css" rel="stylesheet" type="text/css" />
		<link href="/model/home/css/jsstyle.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="/model/home/js/address.js"></script>
		 <!-- 这是任高磊引入的layer弹层 -->
    	<script type="text/javascript" src="/layer/layer.js"></script>

		<link href="/model/home/css/orstyle.css" rel="stylesheet" type="text/css">
		<script src="/model/home/AmazeUI-2.4.2/assets/js/jquery.min.js" type="text/javascript"></script>		
		<script src="/model/home/AmazeUI-2.4.2/assets/js/amazeui.js" type="text/javascript"></script>	   
		<!-- <link href="/model/home/css/addstyle.css" rel="stylesheet" type="text/css"> -->
		<link href="/model/home/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
		<meta name="csrf-token" content="{{ csrf_token() }}">
	</head>
	<body>
		<!--顶部导航条 -->
		<div class="am-container header">
			<ul class="message-l">
				<div class="topMessage">
					<div class="menu-hd">
						<a href="#" target="_top" class="h">尊敬的用户，{{Session::get('users')['nickname']}} 您好</a>
						<!-- <a href="#" target="_top">免费注册</a> -->
					</div>
				</div>
			</ul>
			<ul class="message-r">
				<div class="topMessage home">
					<div class="menu-hd"><a href="{{ url('/index') }}" target="_top" class="h">商城首页</a></div>
				</div>
				<div class="topMessage my-shangcheng">
					<div class="menu-hd MyShangcheng"><a href="{{url('/user/index')}}" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
				</div>
				<div class="topMessage mini-cart">
					<div class="menu-hd"><a id="mc-menu-hd" href="{{ url('/cart') }}" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">0</strong></a></div>
				</div>
				<div class="topMessage favorite">
				</div>
			</ul>
			</div>
			<!--悬浮搜索框-->
			<div class="nav white">
				<div class="logo"><img src="/model/home/images/logo.png" /></div>
				<div class="logoBig">
					<li><img src="{{Session::get('users')['photo']}}" /></li>
				</div>
				<div class="search-bar pr">
					<a name="index_none_header_sysc" href="#"></a>
					<form action="/goods/search" method="post">
						{{ csrf_field() }}
						<input id="searchInput" name="index_none_header_sysc" type="text" placeholder="搜索" autocomplete="off">
						<input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit">
					</form>
				</div>
			</div>
			<div class="clear"></div>
			<div class="concent">
				<!--地址 -->
				<div class="paycont">
					<div class="address">
						<h3>确认收货地址 </h3>
						<div class="control">
							<div class="tc-btn createAddr theme-login am-btn am-btn-danger">使用新地址</div>
						</div>
						<div class="clear"></div>
						<ul>
							<div class="per-border"></div>
				<!-- 遍历的用户的地址 -->
				@foreach($address as $k => $v)
					@if($v['status'] == 1  )	
					<li class="user-addresslist defaultAddr">
					@else
					<li class="user-addresslist ">
					@endif
								<div class="address-left">
									<div class="user DefaultAddr">
										<span class="buy-address-detail"></span>
                   						<span class="buy-user">{{ $v['name'] }}</span>
										<span class="buy-phone">{{ $v['phone'] }}</span>
									</div>
									<div class="default-address DefaultAddr">
										<span class="buy-line-title buy-line-title-type">收货地址：</span>
										<span class="buy--address-detail">
								   			<span class="province">{{ $v['address'] }}</span>
											
											<span class="street">{{ $v['address_detail'] }}</span>
										</span>
									</div>
								</div>
								<div class="address-right">
									<a href="person/address.html">
										<span class="am-icon-angle-right am-icon-lg"></span>
									</a>
								</div>
								<div class="clear"></div>

								<div class="new-addr-btn">
									<!-- 此隐藏域用来呈现地址要被修改为默认地址的id -->
								<input type="hidden" name="addr" class="addressid " value="{{ $v['id'] }}">
									<span class="moren" style="cursor:pointer">默认地址</span>
									<span class="new-addr-bar">|</span>
									<a href="javascript:void(0);" class="delete">删除</a>
								</div>
							</li>
				@endforeach
				<!-- 默认地址遍历结束 -->
				<script type="text/javascript">
				$('.moren').click(function(){
					//获取
					var addid = $(this).parent('.new-addr-btn').find('.addressid').val();
					// console.log(addid);	
					var formData = new FormData();
					formData.append('addid',addid);				
					$.ajax({
				            type: "POST",
				            url: "/index/addredit",
							headers: {
					            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					        },
				            data: formData, //要发送的数据
				            contentType: false,
				            processData: false,
					    	async:true,
					    	cache:false,
				            success: function(data) {
				            	// console.log(data);
				            	if(data.status == 1){
				          //   		layer.alert('设置成功', {
														//   icon: 6,
														//   skin: 'layer-ext-moon'
														// });

				            		layer.msg('设置成功', {
													  icon: 6,
													  time: 1000 //1秒关闭（如果不配置，默认是3秒）
													}, function(){
													  parent.location.reload();
											});
								}else{
									layer.alert('设置失败', {
														  icon: 5,
														  skin: 'layer-ext-moon'
														});
								}
				            },
				            error: function(XMLHttpRequest, textStatus, errorThrown) {
				                alert("上传失败，请检查网络后重试");
				            }
				        });
				});
			</script>
			<script type="text/javascript">
				// 删除地址
				$('.delete').click(function(){
					//获取id
					var addid = $(this).parent('.new-addr-btn').find('.addressid').val();
					// console.log(addid);	
					var formData = new FormData();
					formData.append('addid',addid);				
					// console.log(addid);
					$.ajax({
				            type: "POST",
				            url: "/index/deleteaddress",
							headers: {
					            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					        },
				            data: formData, //要发送的数据
				            contentType: false,
				            processData: false,
					    	async:true,
					    	cache:false,
				            success: function(data) {
				            	// console.log(data);
				            	if(data.status == 1){
									layer.msg('删除成功', {
													  icon: 6,
													  time: 1000 //1秒关闭（如果不配置，默认是3秒）
													}, function(){
													  parent.location.reload()
											});
								}else{
									layer.alert('删除失败', {
														  icon: 5,
														  skin: 'layer-ext-moon'
														})
								}
				            },
				            error: function(XMLHttpRequest, textStatus, errorThrown) {
				                alert("上传失败，请检查网络后重试");
				            }
				        });
				});
			</script>
							<div class="per-border"></div>
						</ul>
						<div class="clear"></div>
					</div>
					<!--物流 -->
					
					<div class="clear"></div>

					<!--支付方式-->
					
					<div class="clear"></div>

					<!--订单 -->
					<div class="concent">
						<div id="payTable">
							<h3>确认订单信息</h3>
							<div class="cart-table-th">
								<div class="wp">

									<div class="th th-item">
										<div class="td-inner">商品信息</div>
									</div>
									<div class="th th-price">
										<div class="td-inner">单价</div>
									</div>
									<div class="th th-amount">
										<div class="td-inner">数量</div>
									</div>
									<div class="th th-sum">
										<div class="td-inner">金额</div>
									</div>
									<div class="th th-oplist">
										<div class="td-inner">配送方式</div>
									</div>

								</div>
							</div>
							<div class="clear"></div>

							<tr class="item-list">
								<div class="bundle  bundle-last">

									<div class="bundle-main">
										<ul class="item-content clearfix">
											<div class="pay-phone">
												<li class="td td-item">
													<div class="item-pic">
														<a href="#" class="J_MakePoint">
															<img src="{{ $goods->goods_photo }}" style="width: 50px;" class="itempic J_ItemImg">
														</a>
														<input type="hidden" class="gid" value="{{ $goods->id }}">
													</div>
													<div class="item-info">
														<div class="item-basic-info">
															<a href="#" class="item-title J_MakePoint" data-point="tbcart.8.11">{{ $goods->goods_name }}</a>
														</div>
													</div>
												</li>
												<li class="td td-info">
													<div class="item-props">
														<span class="sku-line">{{ $type }}</span>
													</div>
												</li>
												<li class="td td-price">
													<div class="item-price price-promo-promo">
														<div class="price-content">
															<em class="J_Price price-now">{{ $price }}</em>
														</div>
													</div>
												</li>
											</div>
											<li class="td td-amount">
												<div class="amount-wrapper ">
													<div class="item-amount ">
														<span class="phone-title">购买数量</span>
														<div class="sl">
															<input class="min am-btn" name="" type="button" value="-" />
															<input class="text_box" name="" type="text" value="{{ $num }}" style="width:30px;" />
															<input class="add am-btn" name="" type="button" value="+" />
														</div>
													</div>
												</div>
											</li>
											<li class="td td-sum">
												<div class="td-inner">
													<em tabindex="0" class="J_ItemSum number">{{ $price*$num }}</em>
												</div>
											</li>
											<li class="td td-oplist">
												<div class="td-inner">
													<span class="phone-title">配送方式</span>
													<div class="pay-logis">
														免运费
													</div>
												</div>
											</li>

										</ul>
										<div class="clear"></div>

									</div>
							</tr>
							<div class="clear"></div>
							</div>

							<tr id="J_BundleList_s_1911116345_1" class="item-list">
								<div id="J_Bundle_s_1911116345_1_0" class="bundle  bundle-last">
									
							</tr>
							</div>
							<div class="clear"></div>
							<div class="pay-total">
						
							<div class="clear"></div>
							</div>

					
							<!-- form表单提交订单信息 -->
							<form id="dingdan" method="POST">
								<!-- {{ csrf_field() }} -->
							<div class="order-go clearfix">
								<!-- 支付页面的订单情况 -->
								<div class="pay-confirm clearfix">
									<div class="box">
										<div tabindex="0" id="holyshit267" class="realPay"><em class="t">实付款：</em>
											<span class="price g_price ">
                                   				 <span>¥</span> <em class="style-large-bold-red" id="J_ActualFee" name="totalmoney"></em>
											</span>
										</div>

										<div id="holyshit268" class="pay-address">
											<p class="buy-footer-address">
												<span class="buy-line-title buy-line-title-type">寄送至：</span>
												<span class="buy--address-detail">
													<span class="dist" name="address">{{ $addr['address'] or '' }}</span>
													<input type="hidden" class="aid" value="{{ $addr['id'] or '' }}">
													<span class="street xiangqing" name="address_detail">{{ $addr['address_detail'] or '' }}</span>
												</span>
												
											</p>
											<p class="buy-footer-address">
												<span class="buy-line-title">收货人：</span>
												<span class="buy-address-detail">   
                                        		 <span class="buy-user" id="name" name="name">{{ $addr['name'] or ''}} </span>
												<span class="buy-phone" id="tel" name="phone">{{ $addr['phone'] or ''}}</span>
												</span>
											</p>
										</div>
									</div>

									<div id="holyshit269" class="submitOrder">
										<div class="go-btn-wrap">
											<a id="order" href="#" class="btn-go " tabindex="0" title="点击此按钮，提交订单">提交订单</a>
											<!-- <input type="submit" value="提交"> -->
										</div>
										<!-- 点击提交订单会生成订单 -->
									</div>
									<div class="clear"></div>
								</div>
							</div>
						</form>
						</div>
						<script type="text/javascript">
							var price = $('.number').text();
							$('.style-large-bold-red').text(price);

                            $('.add').click(function(){
                                var a = $(this).parent().find('.text_box').val();
                                var b = parseInt(a);
                                $(this).parent().find('.text_box').val(b);
                                var c = $(this).parent().parent().parent().parent().parent().find('.td-price').find('.price-now').text();
                                c = parseFloat(c);
                                $(this).parent().parent().parent().parent().parent().find('.td-sum').find('em').text(c*(b+1));
                                $('.style-large-bold-red').text(c*(b+1));

                            });
                            $('.min').click(function(){
                                var a = $(this).parent().find('.text_box').val();
                                var b = parseInt(a);
                                if(b != 0){
                                    $(this).parent().find('.text_box').val(b);
                                    var c = $(this).parent().parent().parent().parent().parent().find('.td-price').find('.price-now').text();
                                    c = parseFloat(c);
                                    $(this).parent().parent().parent().parent().parent().find('.td-sum').find('em').text(c*(b-1));
                                    $('.style-large-bold-red').text(c*(b-1));
                                }

                            });

							$('#order').click(function(){
								// 获取的订单表中的信息。 还需要商品id。？
								var gid = $('.gid').val();
								var type = $('.sku-line').text();
								var aid = $('.aid').val();
								var money = $('.style-large-bold-red').text();

                                if(aid == ''){
                                    return false;
								}
                                window.location.href = '/index/success?gid='+gid+'&aid='+aid+'&money='+money+'&type='+type;
							});
						</script>

						<div class="clear"></div>
					</div>
				</div>
				<div class="footer">
					<div class="footer-hd">
						<p>
							<b style="color:#000;">友情链接：</b>
							@foreach(Session::get('link') as $k => $v)
								<a href="{{$v['url']}}">{{$v['name']}}</a>
								<b>|</b>
							@endforeach
						</p>
					</div>
					<div class="footer-bd">
						<p>
							<a href="#">关于甜丘</a>
							<a href="#">合作伙伴</a>
							<a href="#">联系我们</a>
							<a href="#">网站地图</a>
							<em>© 2015-2025 Hengwang.com 版权所有</em>
						</p>
					</div>
				</div>
			</div>
			<div class="theme-popover-mask"></div>

			<!-- 新增地址的弹框 -->
			<div class="theme-popover">

				<!--标题 -->
				<div class="am-cf am-padding">
					<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">新增地址</strong> / <small>Add address</small></div>
				</div>
				<hr/>

				<div class="am-u-md-12">
					<!-- 添加新地址开始 -->
					<form class="am-form am-form-horizontal" id="art_form" method="POST">
						<div class="am-form-group">
							<label for="user-name" class="am-form-label">收货人</label>
							<div class="am-form-content">
								<input type="text" id="user-name" name="name" value="" placeholder="收货人">
							</div>
						</div>

						<div class="am-form-group">
							<label for="user-phone" class="am-form-label">手机号码</label>
							<div class="am-form-content">
								<input id="user-phone" placeholder="手机号必填" name="phone" value="" type="email">
							</div>
						</div>
						
						<!-- 三级联动开始 -->
						<div class="am-form-group">
							<label for="user-address" class="am-form-label">所在地</label>
							<div class="am-form-content address">
								<!-- 城市联动 -->
								<div id="city">  
								    <select id="s_province" name="s_province"></select>   
									<select id="s_city" name="s_city" ></select>   
									<select id="s_county" name="s_county"></select>
								</div>
							</div>
							<script class="resources library" src="/model/home/liandong/area.js" type="text/javascript"></script> 
							<script type="text/javascript">_init_area();</script>
						</div>
						<!-- 三级联动结束 -->

						<div class="am-form-group">
							<label for="user-intro" class="am-form-label">详细地址</label>
							<div class="am-form-content">
								<textarea class="" rows="3" id="user-intro" name="address_detail" value="" placeholder="输入详细地址"></textarea>
								<small>100字以内写出你的详细地址...</small>
							</div>
						</div>

						<div class="am-form-group theme-poptit">
							<div class="am-u-sm-9 am-u-sm-push-3">
								<div class="am-btn am-btn-danger save">保存</div>
								<div class="am-btn am-btn-danger close">取消</div>
							</div>
						</div>
					</form>
					<!-- 添加新地址结束 -->
				</div>
			</div>
			<script type="text/javascript">
				$('.save').click(function(){
					//获取
					var data = $("#art_form").serializeArray(); 
					// console.log(data);    			
					$.ajax({
				            type: "POST",
				            url: "/index/addaddress",
							headers: {
					            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					        },
				            data: {'data':data}, //要发送的数据
					    	async:true,
					    	cache:false,
				            success: function(data) {
				            	console.log(data);
				            	if(data.status == 1){
				          			layer.msg('添加成功', {
													  icon: 6,
													  anim: 4,
													  time: 1000 //1秒关闭（如果不配置，默认是3秒）
													}, function(){
													  parent.location.reload()
											});
								}else{
									layer.alert('添加失败', {
														  icon: 5,
														  skin: 'layer-ext-moon'
														})
								}
				            },
				            error: function(XMLHttpRequest, textStatus, errorThrown) {
				                alert("上传失败，请检查网络后重试");
				            }
				        });
				});
			</script>			
			<div class="clear"></div>
	</body>

</html>