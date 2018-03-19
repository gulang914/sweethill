@extends('home.layout.user')
@section('css')
<link href="/model/home/css/systyle.css" rel="stylesheet" type="text/css">
@endsection
@section('content')
					<div class="wrap-left">
						<div class="wrap-list">
							<div class="m-user">
								<!--个人信息 -->
								
								<div class="m-bg"></div>
								<div class="m-userinfo">
									<div class="m-baseinfo">
										<a href="javascript:void();" type="button"   data-am-modal="{target: '#doc-modal-1', closeViaDimmer: 0, width: 400, height: 225}"><img src="{{Session::get('users')['photo']}}">
										</a>
										<em class="s-name">({{Session::get('users')['nickname']}})</em>
										<div class="s-prestige am-btn am-round">
										</div>
									</div>
								<!-- 	<button type="button" class="am-btn am-btn-primary"  data-am-modal="{target: '#doc-modal-1', closeViaDimmer: 0, width: 400, height: 225}">  Modal</button> -->

									<div class="am-modal am-modal-no-btn" tabindex="-1" id="doc-modal-1">
									  <div class="am-modal-dialog">
									    <div class="am-modal-hd">请上传图片
									      <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
									    </div>
									    <div class="am-modal-bd">
									    <form action="{{url('/user/setButton')}}" method="post">
									    	{{csrf_field()}}
									      <div class="am-form-group">
									    	<input id="uploads" name="uploads" type="file">
									    	<input type="hidden" name="photo" id="photo" value="">
									    </div>
									    <div class="am-form-group">
										    <label for="doc-vld-name-2-1">预览：</label>
										    <img id="users" style="width:50px;">
									    </div>
									    </form>
										    <div class="am-form-group">
											<button type="button" class="am-btn am-btn-primary" data-am-modal="{target: '#my-alert'}" id="button">确认修改</button></div>
											<div class="am-modal am-modal-alert" tabindex="-1" id="my-alert">
											  <div class="am-modal-dialog">
											    <div class="am-modal-hd">您好</div>
											    <div class="am-modal-hd upload">
											    </div>
											  </div>
											</div>

									  </div>
									</div>
									</div>
									<script type="text/javascript">
										 $(function () {
									          $("#uploads").change(function () {
									              uploadImage();
									          });
									      });
									  function uploadImage() {
									  	// alert(1);
									 // 判断是否有选择上传文件
									  var imgPath = $("#uploads").val();
									  if (imgPath == "") {
									      alert("请选择上传图片！");
									      return;
									  }
									  //判断上传文件的后缀名
									  var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
									  if (strExtension != 'jpg' && strExtension != 'gif' && strExtension != 'png' && strExtension != 'bmp') {
									      alert("请选择图片文件");
									      return;
									  }
									  //将整个表单打包进formData
									//                                          var formData = new FormData($('#art_forml'));
									//									  console.log(formData)
										// var photo = document.getElementById('photo');
									  //只将上传文件打包进formData
									   var formData = new FormData();
									   formData.append('uploads',$('#uploads')[0].files[0]);
									   formData.append('_token','{{ csrf_token() }}');
									  $.ajax({
									      type: "POST",
									      url: "{{url('/user/setPhoto')}}",
									      headers: {
									          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
									      },
									      data: formData,
									      contentType: false,
									      processData: false,
									      success: function(data) {
									      	// var data = data;
									          $('#users').attr('src',data);
									          $('#photo').val(data);

									      },
									      error: function(XMLHttpRequest, textStatus, errorThrown) {
									          alert("上传失败，请检查网络后重试");
									      }
									  });
									}

							          $('#button').click(function() {
							          		$(".upload").text('上传成功');
							          		setTimeout("location.reload();",1000);
					         		 	});							
									</script>
									
									<div class="m-right">
										<div class="m-new">
											<a href="news.html"><i class="am-icon-bell-o"></i>消息</a>
										</div>
										<div class="m-address">
											<a href="address.html" class="i-trigger">我的收货地址</a>
										</div>
									</div>
								</div>
							</div>
							<!-- <div class="box-container-bottom"></div> -->

							<!--订单 -->
							<div class="m-order">
								<div class="s-bar">
									<i class="s-icon"></i>我的订单
									<a class="i-load-more-item-shadow" href="order.html">全部订单</a>
								</div>
								<ul>
									<li><a href="order.html"><i><img src="/model/home/images/pay.png"/></i><span>待付款</span></a></li>
									<li><a href="order.html"><i><img src="/model/home/images/send.png"/></i><span>待发货<em class="m-num">1</em></span></a></li>
									<li><a href="order.html"><i><img src="/model/home/images/receive.png"/></i><span>待收货</span></a></li>
									<li><a href="order.html"><i><img src="/model/home/images/comment.png"/></i><span>待评价<em class="m-num">3</em></span></a></li>
									<li><a href="change.html"><i><img src="/model/home/images/refund.png"/></i><span>退换货</span></a></li>
								</ul>
							</div>
							<!--九宫格-->
							<div class="user-patternIcon">
								<div class="s-bar">
									<i class="s-icon"></i>我的常用
								</div>
								<ul>

									<a href="home/shopcart.html"><li class="am-u-sm-4"><i class="am-icon-shopping-basket am-icon-md"></i><img src="/model/home/images/iconbig.png"/><p>购物车</p></li></a>
									<a href="collection.html"><li class="am-u-sm-4"><i class="am-icon-heart am-icon-md"></i><img src="/model/home/images/iconsmall1.png"/><p>我的收藏</p></li></a>
									<a href="home/home.html"><li class="am-u-sm-4"><i class="am-icon-gift am-icon-md"></i><img src="/model/home/images/iconsmall0.png"/><p>为你推荐</p></li></a>
									<a href="comment.html"><li class="am-u-sm-4"><i class="am-icon-pencil am-icon-md"></i><img src="/model/home/images/iconsmall3.png"/><p>好评宝贝</p></li></a>
									<a href="foot.html"><li class="am-u-sm-4"><i class="am-icon-clock-o am-icon-md"></i><img src="/model/home/images/iconsmall2.png"/><p>我的足迹</p></li></a>                                                                        
								</ul>
							</div>
						

							<!--收藏夹 -->
							<div class="you-like">
								
							</div>

						</div>
					</div>
					<div class="wrap-right">

						<!-- 日历-->
						<div class="day-list">
							<div class="s-bar">
								<a class="i-history-trigger s-icon" href="#"></a>我的日历
								<a class="i-setting-trigger s-icon" href="#"></a>
							</div>
							<div class="s-care s-care-noweather">
								<div class="s-date">
									<em>21</em>
									<span>星期一</span>
									<span></span>
								</div>
							</div>
						</div>
						<!--新品 -->
						<div class="new-goods">
							<div class="s-bar">
								<i class="s-icon"></i>今日新品
								<a class="i-load-more-item-shadow">15款新品</a>
							</div>
							<div class="new-goods-info">
								<a class="shop-info" href="#" target="_blank">
									<div class="face-img-panel">
										<img src="/model/home/images/imgsearch1.jpg" alt="">
									</div>
									<span class="new-goods-num ">4</span>
									<span class="shop-title">剥壳松子</span>
								</a>
								<a class="follow " target="_blank">关注</a>
							</div>
						</div>

						<!--热卖推荐 -->
						<div class="new-goods">
							<div class="s-bar">
								<i class="s-icon"></i>热卖推荐
							</div>
							<div class="new-goods-info">
								<a class="shop-info" href="#" target="_blank">
									<div >
										<img src="/model/home/images/imgsearch1.jpg" alt="">
									</div>
                                    <span class="one-hot-goods">￥9.20</span>
								</a>
							</div>
						</div>

					</div>

@endsection