@extends('admin/layout/index')

@section('content')
	<div class="am-u-sm-12 am-u-md-12 am-u-lg-12" style="padding:20px;margin-left:10px;">
	    <div class="widget am-cf">
	        <div class="widget-head am-cf">
	            <div class="widget-title am-fl">用户修改</div>
	            <div class="widget-function am-fr">
	                <a href="javascript:;" class="am-icon-cog"></a>
	            </div>
	        </div>
	        <div class="widget-body am-fr">

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
                <div class="center-block">
		            <form action="/admin/user/{{$user['id']}}" class="am-form" id="doc-vld-msg" method="post">
		            	{{csrf_field()}}
		            	{{method_field('PUT')}}
						  <fieldset>
						    <div class="am-form-group">
							    <label for="doc-vld-name-2-1">用户名：</label>
							    <input class="form-control" type="text" id="doc-vld-name-2-1" minlength="5" maxlength="18" placeholder="输入用户名（5 - 18 个字符）" value="{{$user['username']}}" name="username" required/>
						    </div>
						    <div class="am-form-group">
							    <label for="doc-vld-name-2-1">原头像：</label>
							    <img style="width:120px;" src="{{$user['photo']}}">
						    </div>
						    <div class="am-form-group">
						    	<input id="uploads" name="uploads" type="file">
						    	<input type="hidden" name="photo" id="photo" value="">
						    </div>
						    <div class="am-form-group">
							    <label for="doc-vld-name-2-1">预览：</label>
							    <img id="users" style="width:120px;">
						    </div>
							<div class="am-form-group">
							    <label for="doc-vld-name-2-1">原密码</label>
							    <input type="password" id="doc-vld-name-2-1" minlength="5" maxlength="20" placeholder="输入原密码（5 - 20 个字符）" class="form-control" name="oldpass" required/>
						    </div>
		               		<div class="am-form-group">
							    <label for="doc-vld-name-2-1">新密码</label>
							    <input type="password" id="doc-vld-name-2-1" minlength="5" maxlength="20" placeholder="输入新密码（5 - 20 个字符）" class="form-control" name="password" required/>
						    </div>
		               		<div class="am-form-group">
							    <label for="doc-vld-name-2-1">确认密码</label>
							    <input type="password" id="doc-vld-name-2-1" minlength="5" maxlength="20" placeholder="输入确认密码（5 - 20 个字符）" class="form-control" name="repass" required/>
						    </div>
		               		<div class="am-form-group">
							    <label for="doc-vld-name-2-1">手机号</label>
							    <input type="text" id="doc-vld-name-2-1" minlength="3" pattern="^(1[34578][0-9]{9})$" placeholder="输入手机号" class="form-control" name="phone" value="{{$user['phone']}}" required/>
						    </div>
		                	<div class="am-form-group">
							    <label for="doc-vld-name-2-1">邮箱</label>
							    <input type="email" id="doc-vld-name-2-1" minlength="3" placeholder="输入邮箱" class="form-control" name="email" value="{{$user['email']}}" required/>
						    </div>
			                <div class="am-form-group">
			                	<div class="">
									<input type="submit" value="添加" class="btn btn-info form-control">
		                    	</div>
		                    </div>
		               		</fieldset>
	            		</form>
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
      url: "/admin/user/uploads",
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: formData,
      contentType: false,
      processData: false,
      success: function(data) {
          $('#users').attr('src',data);
          $('#photo').val(data);
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
          alert("上传失败，请检查网络后重试");
      }
  });
}
</script>
@endsection