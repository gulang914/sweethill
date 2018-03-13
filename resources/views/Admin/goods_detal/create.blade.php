@extends('admin/layout/index')
@section('content')
	<link href="/upload/css/iconfont.css" rel="stylesheet" type="text/css"/>
	<link href="/upload/css/fileUpload.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="/model/admin/assets/js/jquery.min.js">
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
					<form action="{{url('/admin/goodsdetal')}}" name="myForm" class="am-form" id="art_form" method="post" enctype="multipart/form-data">
						{{csrf_field()}}
						<fieldset>

								
								<input class="form-control" type="hidden" name="gid" value="{{ $id }}">

							<div class="am-form-group">
								<label for="doc-vld-name-2-1">商品销量</label>
								<input class="form-control" type="text" id="doc-vld-name-2-1" minlength="1" maxlength="18" placeholder="请输入商品销量" value="" name="goods_sal" required/>
							</div>
							<div class="am-form-group">
								<label for="doc-vld-name-2-1">商品单价</label>
								<input class="form-control" type="text" id="doc-vld-name-2-1" minlength="1" maxlength="18" placeholder="请输入商品单价" value="" name="goods_price" required/>
							</div>
							<div class="am-form-group">
								<label for="doc-vld-name-2-1">商品库存</label>
								<input class="form-control" type="text" id="doc-vld-name-2-1" minlength="1" maxlength="18" placeholder="请输入商品库存" value="" name="goods_inventory" required/>
							</div>
							<div class="am-form-group">
								<label for="doc-vld-name-2-1">商品类型</label>
								<input class="form-control" type="text" id="doc-vld-name-2-1" minlength="1" maxlength="18" placeholder="请输入商品类型" value="" name="goods_type" required/>
							</div>
							<div class="am-form-group">
								<label for="doc-vld-name-2-1">商品配料</label>
								<input class="form-control" type="text" id="doc-vld-name-2-1" minlength="1" maxlength="18" placeholder="请输入商品配料" value="" name="goods_ingre" required/>
							</div>
							<div class="am-form-group">
								<label for="doc-vld-name-2-1">商品保质期</label>
								<input class="form-control" type="text" id="doc-vld-name-2-1" minlength="1" maxlength="18" placeholder="请输入商品保质期" value="" name="goods_sheif_life" required/>
							</div>
							<div class="am-form-group">
								<label for="doc-vld-name-2-1">生产许可证编号</label>
								<input class="form-control" type="text" id="doc-vld-name-2-1" minlength="1" maxlength="18" placeholder="请输入生产许可证编号" value="" name="goods_pridoct" required/>
							</div>
							<div class="am-form-group">
								<label for="doc-vld-name-2-1">生产标准号</label>
								<input class="form-control" type="text" id="doc-vld-name-2-1" minlength="1" maxlength="18" placeholder="请输入生产标准号" value="" name="goods_stand" required/>
							</div>
							<div class="am-form-group">
								<label for="doc-vld-name-2-1">产品规格</label>
								<input class="form-control" type="text" id="doc-vld-name-2-1" minlength="1" maxlength="18" placeholder="请输入产品规格" value="" name="goods_specif" required/>
							</div>
							<div class="am-form-group">
								<label for="doc-vld-name-2-1">产地</label>
								<input class="form-control" type="text" id="doc-vld-name-2-1" minlength="1" maxlength="18" placeholder="请输入产地" value="" name="goods_origin" required/>
							</div>


							<div class="am-form-group" >
								<label class="am-checkbox-inline" onclick="asb()">
									<div id="abs">
										@foreach($label as $v)
										<input type="checkbox" id="fenlei[{{ $v->id }}]" name="fenlei[{{ $v->id }}]"  value="{{ $v->id }}">{{ $v->label_name }}
										<div id="asd" >
											<div style="clear: both;"></div>
											@foreach($labels[$v->id] as $a)
											<div style="float: left; width: 100px;">
												<input type="checkbox" name="fenlei[{{ $a->id }}]" value="{{ $a->id }}">{{ $a->label_name }}&nbsp;
											</div>
											@endforeach
											<div style="clear: both;"></div>
										</div>
										<br>
										@endforeach
									</div>
								</label>
							</div>

							<script type="text/javascript">

								   function asb(obj){
								       console.log(1);
								   }
//
//								$(function() {
//									$('#doc-vld-msg').validator({
//										onValid: function(validity) {
//											$(validity.field).closest('.am-form-group').find('.am-alert').hide();
//										},
//
//										onInValid: function(validity) {
//											var $field = $(validity.field);
//											var $group = $field.closest('.am-form-group');
//											var $alert = $group.find('.am-alert');
//											// 使用自定义的提示信息 或 插件内置的提示信息
//											var msg = $field.data('validationMessage') || this.getValidationMessage(validity);
//
//											if (!$alert.length) {
//												$alert = $('<div class="am-alert am-alert-danger"></div>').hide().
//												appendTo($group);
//											}
//
//											$alert.html(msg).show();
//										}
//									});
//								});
							</script>

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