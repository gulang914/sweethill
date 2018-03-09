@extends('admin/layout/index')

@section('content')
	<div class="am-u-sm-12 am-u-md-12 am-u-lg-12" style="padding:20px;margin-left:10px;">
	    <div class="widget am-cf">
	        <div class="widget-head am-cf">
	            <div class="widget-title am-fl">站点删除</div>
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
		            <form action="/admin/set/remove" class="am-form"  id="doc-vld-msg" method="post">
		            	{{csrf_field()}}
						 	<fieldset>
						    	<div class="am-form-group">
							      <label for="doc-select-1" style="margin-left:80px">网站标题</label>
							      <select name="title" id="doc-select-1" style="width:200px;height:40px;margin-left:300px;">
							        <option value="0" >|--请选择网站标题--|</option>
							        @foreach($title as $k=>$v)
							        <option  value="{{$v['title']}}">{{$v['title']}}</option>
							      	@endforeach
							      </select>
							      <span class="am-form-caret"></span>
							    </div>
							    
								<div class="am-form-group">
			                	<div class="">
									<input type="submit" value="删除" class="btn btn-info " style="margin-left:340px;width:100px;">
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