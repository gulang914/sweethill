@extends('admin/layout/index')
@section('content')
	<div class="am-u-sm-12 am-u-md-12 am-u-lg-12" style="padding:20px;margin-left:10px;">
	    <div class="widget am-cf">
	        <div class="widget-head am-cf">
	            <div class="widget-title am-fl">分类添加</div>
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
		            <form action="{{url('/admin/cate/docreate')}}" class="am-form" id="doc-vld-msg" method="post">
						{{csrf_field()}}
					  <fieldset>
						<div class="am-form-group">
							<label for="doc-vld-name-2-1">分类名称</label>
							<input class="form-control" type="text" id="doc-vld-name-2-1" minlength="1" maxlength="18" placeholder="输入子分类名称" value="{{old('username')}}" name="cate_name" required/>
							<input class="form-control" type="hidden" id="doc-vld-name-2-1" minlength="1" maxlength="18" placeholder="" value="{{$id}}" name="id" required/>
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
@endsection