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
                                <p class="stage-name">绑定新手机</p>
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
					<form class="am-form am-form-horizontal" id="form" action="{{url('/user/setnewphone')}}" method="post">
						{{csrf_field()}}
						<div class="am-form-group">
							<label for="user-new-phone" class="am-form-label">验证手机</label>
							<div class="am-form-content">
								<input type="tel" class="input" name="newPhone" id="phone" id="user-new-phone" pattern="^(1[34578][0-9]{9})$" placeholder="绑定新手机号" required>
							</div>
						</div>
						<div class="am-form-group code">
							<label for="user-code" class="am-form-label">验证码</label>
							<div class="am-form-content">
								<input type="tel" class="input" id="user-code" maxlength="5" minlength="3" name="newPhonecode" placeholder="短信验证码" required>
							</div>
							<a class="btn" href="javascript:void(0);" onClick="sendCode();" id="sendMobileCode">
								<div class="am-btn am-btn-danger">验证码</div>
							</a>
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

				        function create() {
			        	var data = $('#form').serializeArray();
			            $.ajax({
			            //几个参数需要注意一下
			                type: "POST",//方法类型
			                // dataType: "json",//预期服务器返回的数据类型
			                url: "{{url('/user/setnewphone')}}" ,//url
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