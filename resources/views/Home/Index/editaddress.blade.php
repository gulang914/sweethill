@extends('home.layout.user')
@section('header')
<link href="/model/home/css/addstyle.css" rel="stylesheet" type="text/css">
@endsection
@section('content')

<!-- 修改成功后的提示信息 -->
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
<!-- 错误提示消息 -->
<script type="text/javascript">
	// $('.alert-danger').click(function(){
	// 	location.reload(true);
	// });
	setInterval(function(){
		$('.alert-danger').hide();
	},1500);
</script>
<!-- 正确提示消息 -->
<script type="text/javascript">
	setInterval(function(){
		$('.alert-info').hide();
	},1500);
</script>
	
	<div class="" id="doc-modal-1">

			<div class="add-dress">

				<!--标题 -->
				<div class="am-cf am-padding">
					<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">修改地址</strong> / <small>Edit&nbsp;address</small></div>
				</div>
				<hr>

				<div class="am-u-md-12 am-u-lg-8" style="margin-top: 20px;">
					
					<!-- 用户添加地址form表单开始 -->
					<form class="am-form am-form-horizontal" method="post" action="{{ url('index/address'.'/'.$address['id']) }}">
						{{ csrf_field() }}
						{{ method_field('PUT') }}
						<div class="am-form-group">
							<label for="user-name" class="am-form-label">收货人</label>
							<div class="am-form-content has-error">
								<input type="text" id="user-name" name="name" placeholder="收货人" value="{{ $address['name'] }}">
							</div>
						</div>

						<div class="am-form-group">
							<label for="user-phone" class="am-form-label">手机号码</label>
							<div class="am-form-content">
								<input id="user-phone" name="phone" placeholder="手机号必填" type="text" value="{{  $address['phone'] }}">
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
								<a><button class="am-btn am-btn-danger">保存</button></a>
								<a href="javascript: void(0)" class="am-close am-btn am-btn-danger" data-am-modal-close="">取消</a>
							</div>
						</div>
					</form>
					<!-- 用户添加地址form表单结束 -->

				</div>

			</div>

		</div>

@endsection