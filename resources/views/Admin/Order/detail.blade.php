@extends('admin.layout.index')
@section('content')
	<div class="row-content am-cf">
                <div class="row">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">订单详情</div>
                                <div class="widget-function am-fr">
                                    <a href="javascript:;" class="am-icon-cog"></a>
                                </div>
                            </div>
                            <div class="widget-body am-fr">

                                <form class="am-form tpl-form-border-form">
                                    <div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-12 am-form-label am-text-left">收货人姓名 <span class="tpl-form-line-small-title">name</span></label>
                                        <div class="am-u-sm-12">
                                            <input type="text" class="tpl-form-input am-margin-top-xs" id="user-name" placeholder="{{$address->name}}">
                                            <!-- <small>请填写标题文字10-20字左右。</small> -->
                                        </div>
                                    </div>
									<div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-12 am-form-label am-text-left">收货人电话 <span class="tpl-form-line-small-title">phone</span></label>
                                        <div class="am-u-sm-12">
                                            <input type="text" class="tpl-form-input am-margin-top-xs" id="user-name" placeholder="{{$address->phone}}">
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-12 am-form-label am-text-left">收货人地址 <span class="tpl-form-line-small-title">address</span></label>
                                        <div class="am-u-sm-12">
                                            <input type="text" class="tpl-form-input am-margin-top-xs" id="user-name" placeholder="{{$address->address}}">
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-12 am-form-label am-text-left">收货人详细地址 <span class="tpl-form-line-small-title">add_detail</span></label>
                                        <div class="am-u-sm-12">
                                            <input type="text" class="tpl-form-input am-margin-top-xs" id="user-name" placeholder="{{$address->address_detail}}">
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-12 am-form-label am-text-left">商品名称 <span class="tpl-form-line-small-title">product name</span></label>
                                        <div class="am-u-sm-12">
                                            <input type="text" class="tpl-form-input am-margin-top-xs" id="user-name" placeholder="{{ $goods }}">
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <div class="am-u-sm-12 am-u-sm-push-12">
                                        	<!-- 根据传来的订单状态判断删除订单是否可点击 -->

                                        	
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

@endsection