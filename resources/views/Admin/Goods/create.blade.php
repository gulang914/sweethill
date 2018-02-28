@extends('admin.layout.index')

@section('content')
    <div class="row">

        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title am-fl">边框表单</div>
                    <div class="widget-function am-fr">
                        <a href="javascript:;" class="am-icon-cog"></a>
                    </div>
                </div>
                <div class="widget-body am-fr">

                    <form class="am-form tpl-form-border-form tpl-form-border-br">

                        <div class="am-form-group">
                            <label for="user-phone" class="am-u-sm-3 am-form-label">主分类名称 <span class="tpl-form-line-small-title">Author</span></label>
                            <div class="am-u-sm-9">
                                <select data-am-selected="{searchBox: 1}" style="display: none;">
                                    <option value="a">蛋糕</option>
                                    <option value="b">甜品</option>
                                    <option value="o">零食</option>
                                </select>

                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-weibo" class="am-u-sm-3 am-form-label">分类名称 <span class="tpl-form-line-small-title">Type</span></label>
                            <div class="am-u-sm-9">
                                <input type="text" id="user-weibo" placeholder="请添加分类用点号隔开">
                                <div>

                                </div>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-weibo" class="am-u-sm-3 am-form-label">分类图片 <span class="tpl-form-line-small-title">Images</span></label>
                            <div class="am-u-sm-9">
                                <div class="am-form-group am-form-file">
                                    <div class="tpl-form-file-img">
                                        <img src="/model/admin/assets/img/a5.png" alt="">
                                    </div>
                                    <button type="button" class="am-btn am-btn-danger am-btn-sm">
                                        <i class="am-icon-cloud-upload"></i> 添加分类图片</button>
                                    <input id="doc-form-file" type="file" multiple="">
                                </div>

                            </div>
                        </div>

                        <div class="am-form-group">
                            <div class="am-u-sm-9 am-u-sm-push-3">
                                <button type="button" class="am-btn am-btn-primary tpl-btn-bg-color-success ">提交</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
