<!DOCTYPE html>
<html>

	<head lang="en">
		<meta charset="UTF-8">
		<title>登录</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="format-detection" content="telephone=no">
		<meta name="renderer" content="webkit">
		<meta http-equiv="Cache-Control" content="no-siteapp" />

		<link rel="stylesheet" href="/model/home/AmazeUI-2.4.2/assets/css/amazeui.css" />
		<link href="/model/home/css/dlstyle.css" rel="stylesheet" type="text/css">
		<script src="/model/home/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
		<script src="/model/home/AmazeUI-2.4.2/assets/js/amazeui.min.js"></script>
	</head>

	<body>

		<div class="login-boxtitle">
			<a href="home.html"><img alt="logo" src="/model/home/images/logobig.png" /></a>
		</div>

		<div class="login-banner">
			<div class="login-main">
				<div class="login-banner-bg"><span></span><img src="/model/home/images/big.jpg" /></div>
				<div class="login-box">

							<h3 class="title">登录商城</h3>

							<div class="clear"></div>
						@if (count($errors) > 0)
                    <div class="alert alert-danger" style="color:red;">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
				<script type="text/javascript">
			        $(function() {
			          $('#doc-vld-msg').validator({
			            onValid: function(validity) {
			              $(validity.field).closest('.am-form-group').find('.am-alert').hide();
			            },

			            onInValid: function(validity) {
			              var $field = $(validity.field);
			              var $group = $field.closest('.am-form-group');
			              var $alert = $group.find('.am-alert');
			              // 使用自定义的提示信息 或 插件内置的提示信息
			              var msg = $field.data('validationMessage') || this.getValidationMessage(validity);

			              if (!$alert.length) {
			                $alert = $('<div class="am-alert am-alert-danger"></div>').hide().
			                  appendTo($group);
			              }

			              $alert.html(msg).show();
			            }
			          });
			        });
				</script>
						<div class="login-form">
						  <form action="{{url('doPass')}}" method="post">
							{{csrf_field()}}
							  <div class="user-phone">
							    <label for="phone"><i class="am-icon-mobile-phone am-icon-md"></i></label>
							    <input type="tel" name="phone" id="phone" value="{{old('phone')}}" placeholder="请输入要找回密码的手机号">
						        </div>
    			             	<div class="verification">
							<label for="code"><i class="am-icon-code-fork"></i></label>
							<input type="tel" name="code" id="code" placeholder="请输入验证码">
							<a class="btn" href="javascript:void(0);" onClick="sendCode();" id="sendMobileCode">
								<span id="dyMobileButton">获取</span></a>
						</div>
						 <div class="user-pass">
						    <label for="password"><i class="am-icon-lock"></i></label>
						    <input type="password" name="password" id="password" placeholder="设置密码">
					     </div>										
						 <div class="user-pass">
						    <label for="passwordRepeat"><i class="am-icon-lock"></i></label>
						    <input type="password" name="repass" id="passwordRepeat" placeholder="确认密码">
							 </div>	
			           </div>
			            
       					    <div class="login-links">
								<a href="{{url('login')}}" class="zcnext am-fr am-btn-default">登录</a>
								<br />
    				        </div>
								<div class="am-cf">
									<input type="submit" name="" value="找回密码" class="am-btn am-btn-primary am-btn-sm">
								</div>
            		</form>	

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
					</script>
					

					<div class="footer ">
						<div class="footer-hd ">
							<p>
								<a href="# ">恒望科技</a>
								<b>|</b>
								<a href="# ">商城首页</a>
								<b>|</b>
								<a href="# ">支付宝</a>
								<b>|</b>
								<a href="# ">物流</a>
							</p>
						</div>
						<div class="footer-bd ">
							<p>
								<a href="# ">关于恒望</a>
								<a href="# ">合作伙伴</a>
								<a href="# ">联系我们</a>
								<a href="# ">网站地图</a>
								<em>© 2015-2025 Hengwang.com 版权所有</em>
							</p>
						</div>
					</div>
	</body>

</html>