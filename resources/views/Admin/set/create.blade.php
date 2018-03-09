@extends('admin/layout/index')
@section('content')
	<div class="am-u-sm-12 am-u-md-12 am-u-lg-12" style="padding:20px;margin-left:10px;">
	    <div class="widget am-cf">
	        <div class="widget-head am-cf">
	            <div class="widget-title am-fl">站点添加</div>
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
		            <form id="avatar" action="{{url('/admin/set')}}" class="am-form" id="doc-vld-msg" method="post" enctype=multipart/form-data>
		            	{{csrf_field()}}
						  <fieldset>
						    <div class="am-form-group">
							    <label for="doc-vld-name-2-1">网站标题：</label>
							    <input class="form-control" type="text" id="doc-vld-name-2-1" placeholder="输入网站标题" value="{{old('title')}}" name="title" required/>
						    </div>
						    <div class="am-form-group">
							    <label for="doc-vld-name-2-1">网站类型：</label>
							    <input type="radio" name="type" value="0" id="text">文本框
							    <input type="radio" name="type" value="1" id="file">文件
							    <input type="radio" name="type" value="2" id="checkbox">单选按钮
						    </div>
						    <div class="am-form-group">
							    <label for="doc-vld-name-2-1">网站内容：</label>
							    <input class="form-control" type="hidden" id="content"  name="content" required/>
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
   	<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
   		var text =  document.getElementById('text');
   		var file =  document.getElementById('file');
   		var checkbox =  document.getElementById('checkbox');
   		var content = document.getElementById('content');
   		text.onclick = function() {

   			content.type = 'text';
   		}
   		file.onclick = function() {
   			content.type = 'file';
   		}
   		checkbox.onclick = function() {
   			content.type = 'checkbox';
   			// content.name = 'content[]';
   		}
	// $("#thumb").on('change', function (){
	// 		var input=document.getElementById("thumb");
 //            var formData = new FormData();
 //            formData.append('file',input.files[0]);
 //            $.ajax({
 //                headers: {
 //                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
 //                },
 //                type: 'POST',
 //                url: '/admin/user/uploads' ,
 //                data: formData ,
 //                processData:false,
 //                contentType: false,
 //                cache: false,
 //                success:function(data){
 //                  if(data.status){
 //                      layer.msg('发布成功！', {icon: 6});
 //                  }else{
 //                      layer.msg('发布失败！', {icon: 5});
 //                  }
 //                },
 //                error:function(err){
 //                  console.log(err);
 //                }
 //            });
 //        });

 	function uploadInfo() { 
	  var formData = new FormData($("#avatar")); 
	  $.ajax({ 
	  	headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
	    url: "/admin/user/uploads",
 	    type: 'POST', 
	    data: formData, 
	    contentType: false, 
	    processData: false, 
	    success: function (returndata) { 
	     console.log(returndata); 
	    }, 
	    error: function (returndata) { 
	     console.log(returndata); 
	    } 
	   }); 
	} 

</script>
<!-- function uploadInfo() { 
  var formData = new FormData($("#avatar")); 
  $.ajax({ 
   url: "{{url('photo')}}",
   type: 'POST', 
   data: formData, 
   contentType: false, 
   processData: false, 
   success: function (returndata) { 
    console.log(returndata); 
   }, 
   error: function (returndata) { 
    console.log(returndata); 
   } 
  }); 
}  -->
@endsection