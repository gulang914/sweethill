@extends('home.layout.user')

@section('header')
<link href="/model/home/css/addstyle.css" rel="stylesheet" type="text/css">
@endsection

@section('content')
<!-- <div class="main-wrap"> -->
<div class="user-address">
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
<!-- 点击它重新刷新页面 -->
<script type="text/javascript">
	$('.alert-danger').click(function(){
		location.reload(true);
	});
</script>
<!-- 点击它重新刷新页面 -->
<script type="text/javascript">
	setInterval(function(){
		$('.alert-info').hide();
	},2000);
</script>
		<!--标题 -->
		<div class="am-cf am-padding">
			<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">地址管理</strong> / <small>Address&nbsp;list</small></div>
		</div>
		<hr>

		<ul class="am-avg-sm-1 am-avg-md-3 am-thumbnails">
			<!-- 默认地址遍历开始 -->
			@foreach($address as $k => $v)

				@if($v['status'] == 1  )	
				
			<li class="user-addresslist defaultAddr ">
				@else
			<li class="user-addresslist"  >
				@endif
				<!-- 此隐藏域用来呈现地址要被修改为默认地址的id -->
				<input type="hidden" name="addr" class="addressid " value="{{ $v['id'] }}">
				<span class="new-option-r address" ><i class="am-icon-check-circle"></i>默认地址</span>
				<p class="new-tit new-p-re">
					<span class="new-txt">{{ $v['name'] }}</span>
					<span class="new-txt-rd2">{{ $v['phone'] }}</span>
				</p>
				<div class="new-mu_l2a new-p-re">
					<p class="new-mu_l2cw">
						<span class="title">地址：</span>
						<span class="province">{{ $v['address'] }}</span>
						<!-- <span class="city">武汉</span>
						<span class="dist">洪山</span> -->
						<span class="street">{{ $v['address_detail'] }}</span></p>
				</div>
				<div class="new-addr-btn">
					<input type="hidden" name="addr" class="addressid " value="{{ $v['id'] }}">
					<a href="{{ url('index/address'.'/'.$v['id'].'/'.'edit') }}"><i class="am-icon-edit"></i>编辑</a>
					<span class="new-addr-bar">|</span>
					<a href="#" class="delete"><i class="am-icon-trash"></i>删除</a>

					<!-- <form action="/index/address/{{$v['id']}}" method="post" style="display: inline;">
					    {{csrf_field()}}
					    {{method_field('DELETE')}}
					    <span class="am-icon-trash" style="position: relative;">删除
					    <input type="submit" style="position: absolute;opacity: 0;top: -3px;left: -3px;width: 45px" title="确定要删除吗？" value='删除'>
					    </span>
					</form> -->
					
				</div>
			</li>
			@endforeach
			<!-- 默认地址遍历结束 -->

			<script type="text/javascript">
				// 删除地址
				$('.delete').click(function(){
					//获取id
					var addid = $(this).parent('.new-addr-btn').find('.addressid').val();
					// console.log(addid);	
					
					var formData = new FormData();
					formData.append('addid',addid);				
					
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
				          //   		layer.alert('删除成功', {
														//   icon: 6,
														//   skin: 'layer-ext-moon',
														//   time: 5000
														// })
									layer.msg('删除成功', {
													  icon: 6,
													  time: 1000 //1秒关闭（如果不配置，默认是3秒）
													}, function(){
													  parent.location.reload()
											});
				            		// location.reload(true);
				            		// parent.location.reload()
				            		// window.parent.frames[1].location.reload(); 
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


			<script type="text/javascript">
				$('.address').click(function(){
					//获取
					var addid = $(this).parent('.user-addresslist').find('.addressid').val();
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
				            		layer.alert('设置成功', {
														  icon: 6,
														  skin: 'layer-ext-moon'
														})
								}else{
									layer.alert('设置失败', {
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
			

		</ul>
		<div class="clear"></div>
		<a class="new-abtn-type" data-am-modal="{target: '#doc-modal-1', closeViaDimmer: 0}">添加新地址</a>
		<!--例子-->
		<div class="" id="doc-modal-1">

			<div class="add-dress">

				<!--标题 -->
				<div class="am-cf am-padding">
					<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">新增地址</strong> / <small>Add&nbsp;address</small></div>
				</div>
				<hr>

				<div class="am-u-md-12 am-u-lg-8" style="margin-top: 20px;">
					
					<!-- 用户添加地址form表单开始 -->
					<form class="am-form am-form-horizontal" method="post" action="{{ url('index/address') }}">
						{{ csrf_field() }}
						<div class="am-form-group">
							<label for="user-name" class="am-form-label">收货人</label>
							<div class="am-form-content has-error">
								<input type="text" id="user-name" name="name" placeholder="收货人" value="{{old('name')}}">
							</div>
						</div>

						<div class="am-form-group">
							<label for="user-phone" class="am-form-label">手机号码</label>
							<div class="am-form-content">
								<input id="user-phone" name="phone" placeholder="手机号必填" type="text" value="{{old('phone')}}">
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
								<textarea class="" rows="3" id="user-intro" name="address_detail" placeholder="输入详细地址"></textarea>
								<small>100字以内写出你的详细地址...</small>
							</div>
						</div>

						<div class="am-form-group">
							<div class="am-u-sm-9 am-u-sm-push-3">
								<a><button class="am-btn am-btn-danger">保存</button> </a>
								<a href="javascript: void(0)" class="am-close am-btn am-btn-danger" data-am-modal-close="">取消</a>
							</div>
						</div>
					</form>
					<!-- 用户添加地址form表单结束 -->

				</div>

			</div>

		</div>

	</div>

	<script type="text/javascript">
		$(document).ready(function() {							
			$(".new-option-r").click(function() {
				$(this).parent('.user-addresslist').addClass("defaultAddr").siblings().removeClass("defaultAddr");
			});
			
			var $ww = $(window).width();
			if($ww>640) {
				$("#doc-modal-1").removeClass("am-modal am-modal-no-btn")
			}
			
		})
	</script>

	<div class="clear"></div>

<!-- </div> -->
@endsection