@extends('home.layout.user')
@section('css')
<link href="/model/home/css/infstyle.css" rel="stylesheet" type="text/css">
@endsection
@section('content')
<div class="user-info">
						<!--标题 -->
						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">个人资料</strong> / <small>Personal&nbsp;information</small></div>
						</div>
						<hr/>

						<!--头像 -->
						<div class="user-infoPic">

							<div class="filePic">
								<input type="file" class="inputPic" allowexts="gif,jpeg,jpg,png,bmp" accept="image/*">
								<img class="am-circle am-img-thumbnail" src="{{Session::get('users')['photo']}}" alt="" />
							</div>

							<p class="am-form-help">头像</p>

							<div class="info-m">
								<div><b>用户名：<i>{{Session::get('users')['nickname']}}</i></b></div><br>
								<div><b>手机号：<i>{{Session::get('users')['phone']}}</i></b></div>
							</div>
						</div>

						<!--个人信息 -->
						<div class="info-main">
							<form id="form" action="" class="am-form am-form-horizontal"  method="post">
								{{csrf_field()}}
								<div class="am-form-group">
									<label for="user-name2" class="am-form-label">昵称</label>
									<div class="am-form-content">
										<input type="text" class="input" name="nickname" minlength="2" maxlength="18" id="user-name2" placeholder="请输入昵称" required>

									</div>
								</div>

								<div class="am-form-group">
									<label for="user-name" class="am-form-label">年龄</label>
									<div class="am-form-content">
										<input type="number" class="input" name="age" min="0" max="120" id="user-name2" style="height:30px;width:50px;font-size:12px;" required>

									</div>
								</div>

								<div class="am-form-group">
									<label class="am-form-label">性别</label>
									<div class="am-form-content sex">
										<label class="am-radio-inline">
											<input type="radio" class="input" name="sex" value="男" data-am-ucheck> 男
										</label>
										<label class="am-radio-inline">
											<input type="radio" class="input" name="sex" value="女" data-am-ucheck> 女
										</label>
										<label class="am-radio-inline">
											<input type="radio" class="input" name="sex" value="保密" data-am-ucheck> 保密
										</label>
									</div>
								</div>
								<div class="am-form-group">
									<label for="user-email" class="am-form-label">电子邮箱</label>
									<div class="am-form-content">
										<input id="user-email" class="input" name="email" placeholder="请输入电子邮箱" type="email" required>

									</div>
								</div>
<!-- 								<div class="am-form-group address">
									<label for="user-address" class="am-form-label">收货地址</label>
									<div class="am-form-content address">
										<a href="address.html">
											<p class="new-mu_l2cw">
												<span class="province">湖北</span>省
												<span class="city">武汉</span>市
												<span class="dist">洪山</span>区
												<span class="street">雄楚大道666号(中南财经政法大学)</span>
												<span class="am-icon-angle-right"></span>
											</p>
										</a>

									</div>
								</div>
								<div class="am-form-group safety">
									<label for="user-safety" class="am-form-label">账号安全</label>
									<div class="am-form-content safety">
										<a href="safety.html">

											<span class="am-icon-angle-right"></span>

										</a>

									</div>
								</div> -->
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

						</div>
			
					</div>
					<script type="text/javascript">
			        function create() {
			        	var data = $('#form').serializeArray();
			            $.ajax({
			            //几个参数需要注意一下
			                type: "POST",//方法类型
			                // dataType: "json",//预期服务器返回的数据类型
			                url: "{{url('/user/userAlter')}}" ,//url
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