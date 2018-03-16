@extends('home.layout.user')
@section('css')
<link href="/model/home/css/stepstyle.css" rel="stylesheet" type="text/css">
@endsection
@section('content')
<div class="am-cf am-padding">
						<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">修改密码</strong> / <small>Password</small></div>
					</div>
					<hr/>
					<!--进度条-->
					<div class="m-progress">
						<div class="m-progress-list">
							<span class="step-1 step">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">1<em class="bg"></em></i>
                                <p class="stage-name">重置密码</p>
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
					<form class="am-form am-form-horizontal" id="form" action="{{url('/user/changepass')}}" method="post">
						{{csrf_field()}}
						<div class="am-form-group">
							<label for="user-old-password" class="am-form-label">原密码</label>
							<div class="am-form-content">
								<input type="password" class="input"  maxlength="20" minlength="8"  name="oldpass" id="user-old-password" placeholder="请输入原登录密码" required>
							</div>
						</div>
						<div class="am-form-group">
							<label for="user-new-password" class="am-form-label">新密码</label>
							<div class="am-form-content">
								<input type="password" class="input" maxlength="20" minlength="8" name="password" id="user-new-password" placeholder="由数字、字母组合" required>
							</div>
						</div>
						<div class="am-form-group">
							<label for="user-confirm-password" class="am-form-label">确认密码</label>
							<div class="am-form-content">
								<input type="password" class="input" maxlength="20" minlength="8" name="repass" id="user-confirm-password" placeholder="请再次输入上面的密码" required>
							</div>
						</div>
					</form>
					<button type="button" class="am-btn am-btn-primary" data-am-modal="{target: '#my-alert'}" onclick="create()">确认修改</button>
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
			        function create() {
			        	var data = $('#form').serializeArray();
			            $.ajax({
			            //几个参数需要注意一下
			                type: "POST",//方法类型
			                // dataType: "json",//预期服务器返回的数据类型
			                url: "{{url('/user/changepass')}}" ,//url
			                headers: {
							'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
							},
			                data: data,
			                success: function (result) {
			                	$(".button").text(result);
			                	$(".input").val("");
			                    // alert(result);//打印服务端返回的数据(调试用)
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