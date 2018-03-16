@extends('home.layout.user')
@section('css')
<link href="/model/home/css/stepstyle.css" rel="stylesheet" type="text/css">
@endsection
@section('content')
<div class="am-cf am-padding">
						<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">绑定手机</strong> / <small>Bind&nbsp;Phone</small></div>
					</div>
					<hr/>
					<!--进度条-->
					<div class="m-progress">
						<div class="m-progress-list">
							<span class="step-1 step">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">1<em class="bg"></em></i>
                                <p class="stage-name">绑定手机</p>
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
					<form class="am-form am-form-horizontal" action="{{url('/user/setphone')}}" method="post">
						{{csrf_field()}}
						<div class="am-form-group bind">
							<label for="user-phone" class="am-form-label">验证手机</label>
							<div class="am-form-content">
								<span id="user-phone"><input type="hidden"  pattern="^(1[34578][0-9]{9})$" id="phone" value="{{Session::get('users')['phone']}}" required>{{Session::get('users')['phone']}}</span>
							</div>
						</div>
						<div class="am-form-group code">
							<label for="user-code" class="am-form-label">验证码</label>
							<div class="am-form-content">
								<input type="tel" id="user-code"  maxlength="5" minlength="3"  name="phonecode" placeholder="短信验证码" required>
							</div>
							<a class="btn" href="javascript:void(0);" onClick="sendCode();" id="sendMobileCode">
								<div class="am-btn am-btn-danger">验证码</div>
							</a>
						</div>
						<div class="info-btn">
							<input type="submit" value="下一步">
						</div>

					</form>
					<script type="text/javascript">
				        function sendCode(){
				    var phone = $('#phone').val();
				            $.post("{{url('/sendcode')}}",{'_token':"{{csrf_token()}}",'phone':phone},function(data){
				                var data =  JSON.parse(data);
				                if(data.status == 0){
				                    alert('验证码发送成功');
				                }else{
				                    alert('验证码发送失败');
				                }
				            });
				        }
					</script>
@endsection