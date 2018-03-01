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
							    <!-- @if(!empty($search))
                                <input type="hidden" name="search" value="{{$search}}">
                               @endif
                               @if(!empty($perPage))
                                <input type="hidden" name="perPage" value="{{$perPage}}">
                                @endif -->
							    <input class="form-control" type="text" id="doc-vld-name-2-1" minlength="5" maxlength="18" placeholder="输入用户名（5 - 18 个字符）" value="{{$user['username']}}" name="username" required/>
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
@endsection