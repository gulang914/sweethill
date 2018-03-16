@extends('home.layout.user')
@section('css')
<link href="/model/home/css/stepstyle.css" rel="stylesheet" type="text/css">
@endsection
@section('content')
<div class="am-cf am-padding">
						<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">实名认证</strong> / <small>Real&nbsp;authentication</small></div>
					</div>
					<hr/>
					<!--进度条-->
					<div class="m-progress">
						<div class="m-progress-list">
							<span class="step-1 step">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">1<em class="bg"></em></i>
                                <p class="stage-name">实名认证</p>
                            </span>
							<span class="step-2 step">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">2<em class="bg"></em></i>
                                <p class="stage-name">完成</p>
                            </span>
							<span class="u-progress-placeholder"></span>
						</div>
						<div class="u-progress-bar total-steps-2">
							<div class="u-progress-bar-inner"></div>
						</div>
					</div>
					<form class="am-form am-form-horizontal" id="form" method="post" action="{{url('/user/setautonym')}}">
						{{csrf_field()}}
						<div class="am-form-group bind">
							<label for="user-info" class="am-form-label">账户名</label>
							<div class="am-form-content">
								<span id="user-info">{{Session::get('users')['phone']}}</span>
							</div>
						</div>
						<div class="am-form-group">
							<label for="user-name" class="am-form-label">真实姓名</label>
							<div class="am-form-content">
								<input type="text" class="input" id="user-name" name="name" minlength="2" placeholder="请输入您的真实姓名" required>
							</div>
						</div>
						<div class="am-form-group">
							<label for="user-IDcard" class="am-form-label">身份证号</label>
							<div class="am-form-content">
								<input type="text" class="input" id="user-IDcard" maxlength="18" minlength="18"  name="id_card" placeholder="请输入您的身份证信息" required>
							</div>
						</div>
					</form>
					<div class="am-form-group">
					<button type="button" class="am-btn am-btn-primary" data-am-modal="{target: '#my-alert'}" onclick="create()">确认修改</button></div>
					<div class="am-modal am-modal-alert" tabindex="-1" id="my-alert">
					  <div class="am-modal-dialog">
					    <div class="am-modal-hd">您好</div>
					    <div class="am-modal-bd button">
					    </div>
					    <div class="am-modal-footer">
					      <span class="am-modal-btn">确定</span>
					    </div>
					  </div>
					</div>
					<script type="text/javascript">
						// var input = document.getElementsByTagName('input');
			        function create() {
			        	var data = $('#form').serializeArray();
			            $.ajax({
			            //几个参数需要注意一下
			                type: "POST",//方法类型
			                // dataType: "json",//预期服务器返回的数据类型
			                url: "{{url('/user/setautonym')}}" ,//url
			                headers: {
							'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
							},
			                data: data,
			                success: function (result) {
			                	$(".button").text(result);//打印服务端返回的数据(调试用)
			                    if (result.resultCode == 200) {
			                        alert("SUCCESS");
			                    }
			                    ;
			                },
			                error : function() {
			                    alert("异常！");
			                }
			            });
			        }
   					</script>
@endsection