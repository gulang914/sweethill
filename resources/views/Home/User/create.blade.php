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
							<form class="am-form am-form-horizontal" action="{{url('/user/userAlter')}}" method="post">
								{{csrf_field()}}
								<div class="am-form-group">
									<label for="user-name2" class="am-form-label">昵称</label>
									<div class="am-form-content">
										<input type="text" name="nickname" id="user-name2" placeholder="请输入昵称">

									</div>
								</div>

								<div class="am-form-group">
									<label for="user-name" class="am-form-label">年龄</label>
									<div class="am-form-content">
										<input type="text" name="age" id="user-name2" placeholder="请输入年龄">

									</div>
								</div>

								<div class="am-form-group">
									<label class="am-form-label">性别</label>
									<div class="am-form-content sex">
										<label class="am-radio-inline">
											<input type="radio" name="sex" value="男" data-am-ucheck> 男
										</label>
										<label class="am-radio-inline">
											<input type="radio" name="sex" value="女" data-am-ucheck> 女
										</label>
										<label class="am-radio-inline">
											<input type="radio" name="sex" value="保密" data-am-ucheck> 保密
										</label>
									</div>
								</div>
								<div class="am-form-group">
									<label for="user-email" class="am-form-label">电子邮箱</label>
									<div class="am-form-content">
										<input id="user-email" name="email" placeholder="请输入电子邮箱" type="email">

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
								<div class="info-btn">
									<div><input type="submit" value="保存修改"></div>
								</div>

							</form>
						</div>

					</div>
@endsection