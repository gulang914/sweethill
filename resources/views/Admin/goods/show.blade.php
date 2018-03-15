@extends('admin/layout/index')
@section('content')
	<link href="/upload/css/iconfont.css" rel="stylesheet" type="text/css"/>
	<link href="/upload/css/fileUpload.css" rel="stylesheet" type="text/css">
<div class="am-u-sm-12 am-u-md-12 am-u-lg-12" style="padding:20px;margin-left:10px;">
	<div class="widget am-cf">
		<div class="widget-head am-cf">
			<div class="widget-title am-fl">商品详情添加</div>
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

			<div class="center-block">
				<form action="{{url('/admin/goods')}}" name="myForm" class="am-form" id="art_form" method="post" enctype="multipart/form-data">
					{{csrf_field()}}
				  <fieldset>
					<div class="am-form-group">
						<label for="doc-vld-name-2-1">商品名称</label>
						<input class="form-control" type="text" id="doc-vld-name-2-1" minlength="3" maxlength="18" value="{{ $goods_name }}" name="goods_name" required/>
					</div>
					  <div class="am-form-group">
						  <label for="doc-vld-name-2-1">商品销量</label>
						  <input class="form-control" type="text" id="doc-vld-name-2-1" minlength="3" maxlength="18" placeholder="请输入商品销量" value="" name="goods_name" required/>
					  </div>
					  <div class="am-form-group">
						  <label for="doc-vld-name-2-1">商品单价</label>
						  <input class="form-control" type="text" id="doc-vld-name-2-1" minlength="3" maxlength="18" placeholder="请输入商品单价" value="" name="goods_name" required/>
					  </div>
					  <div class="am-form-group">
						  <label for="doc-vld-name-2-1">商品库存</label>
						  <input class="form-control" type="text" id="doc-vld-name-2-1" minlength="3" maxlength="18" placeholder="请输入商品库存" value="" name="goods_name" required/>
					  </div>
					  <div class="am-form-group">
						  <label for="doc-vld-name-2-1">商品类型</label>
						  <input class="form-control" type="text" id="doc-vld-name-2-1" minlength="3" maxlength="18" placeholder="请输入商品类型" value="" name="goods_name" required/>
					  </div>
					  <div class="am-form-group">
						  <label for="doc-vld-name-2-1">商品配料</label>
						  <input class="form-control" type="text" id="doc-vld-name-2-1" minlength="3" maxlength="18" placeholder="请输入商品配料" value="" name="goods_name" required/>
					  </div>
					  <div class="am-form-group">
						  <label for="doc-vld-name-2-1">商品保质期</label>
						  <input class="form-control" type="text" id="doc-vld-name-2-1" minlength="3" maxlength="18" placeholder="请输入商品保质期" value="" name="goods_name" required/>
					  </div>
					  <div class="am-form-group">
						  <label for="doc-vld-name-2-1">生产许可证编号</label>
						  <input class="form-control" type="text" id="doc-vld-name-2-1" minlength="3" maxlength="18" placeholder="请输入生产许可证编号" value="" name="goods_name" required/>
					  </div>
					  <div class="am-form-group">
						  <label for="doc-vld-name-2-1">生产标准号</label>
						  <input class="form-control" type="text" id="doc-vld-name-2-1" minlength="3" maxlength="18" placeholder="请输入生产标准号" value="" name="goods_name" required/>
					  </div>
					  <div class="am-form-group">
						  <label for="doc-vld-name-2-1">产品规格</label>
						  <input class="form-control" type="text" id="doc-vld-name-2-1" minlength="3" maxlength="18" placeholder="请输入产品规格" value="" name="goods_name" required/>
					  </div>
					  <div class="am-form-group">
						  <label for="doc-vld-name-2-1">产地</label>
						  <input class="form-control" type="text" id="doc-vld-name-2-1" minlength="3" maxlength="18" placeholder="请输入产地" value="" name="goods_name" required/>
					  </div>
					  <input type="hidden" name="cid" value="{{ $goodsd->gid }}">






					  <div class="am-form-group">
						  <label for="user-weibo" class="am-u-sm-12 am-form-label  am-text-left">商品图片 </label>
						  <div class="am-u-sm-12 am-margin-top-xs">
							  <div class="am-form-group am-form-file">


								  <div class="layui-form-item">
									  <label for="L_art_editor" class="layui-form-label">
										  <span class="x-red">*</span>缩略图
									  </label>
									  <div class="layui-input-inline">
										  <input type="file" id="file_upload" name="file_upload" value="">
									  </div>
								  <script type="text/javascript">
                                      $(function () {
                                          $("#file_upload").change(function () {
                                              uploadImage();
                                          })
                                      })
                                      function uploadImage() {
//  判断是否有选择上传文件
                                          var imgPath = $("#file_upload").val();
                                          if (imgPath == "") {
                                              alert("请选择上传图片！");
                                              return;
                                          }
                                          //判断上传文件的后缀名
                                          var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
                                          if (strExtension != 'jpg' && strExtension != 'gif'
                                              && strExtension != 'png' && strExtension != 'bmp') {
                                              alert("请选择图片文件");
                                              return;
                                          }
                                          //将整个表单打包进formData
                                          var formData = new FormData($('#art_form')[0]);

                                          //只将上传文件打包进formData
                                          // var formData = new FormData();
                                          // formData.append('fileupload',$('#file_upload')[0].files[0]);
                                          {{--formData.append('_token','{{ csrf_token() }}');--}}
                                          $.ajax({
                                              type: "POST",
                                              url: "/admin/goods/upload",
                                              headers: {
                                                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                              },
                                              data: formData,
                                              contentType: false,
                                              processData: false,
                                              async:true,
                                              cache:false,
                                              success: function(data) {

                                                  $('#goods').attr('src',data);
                                                  //显示上传到OSS上的图片
                                                  // $('#thumb').attr('src','oss的域名'+data);
                                                  {{--$('#thumb').attr('src','{{ env('ALIOSS_DOMAIN') }}'+data);--}}
                                                  $('#goods_photo').val(data);
                                              },
                                              error: function(XMLHttpRequest, textStatus, errorThrown) {
                                                  alert("上传失败，请检查网络后重试");
                                              }
                                          });
                                      }


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
								  </div>
								  <div class="layui-form-item">

									  <div class="layui-input-block">
										  <input type="hidden" name="goods_photo" id="goods_photo" value="">
										  {{--上传成功后显示上传图片--}}
										  <img src="" id="goods" alt="" style="width:100px;">
									  </div>
								  </div>
							  </div>
						  </div>
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