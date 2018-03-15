@extends('admin.layout.index')
@section('content')
<div class="row-content am-cf">
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
                <div class="row">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">推荐位</div>
                                <div class="widget-function am-fr">
                                    <a href="javascript:;" class="am-icon-cog"></a>
                                </div>
                            </div>
                            <div class="widget-body am-fr">

                                <form action="{{url('admin/recommend')}}" id="art_form" class="am-form tpl-form-line-form" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id" value="{{$data['id']}}">
                                    <div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label">推荐文本 <span class="tpl-form-line-small-title">Title</span></label>
                                        
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="user-name" name="re_text" value="{{$data['re_text']}}" placeholder="">
                                            <!-- <small>请填写标题文字4-6字左右。</small> -->
                                        </div>
                                    </div>
                                   
                                    

                                    <div class="am-form-group">
                                        <label for="user-weibo" class="am-u-sm-3 am-form-label">推荐位图 <span class="tpl-form-line-small-title">Img</span></label>
                                        <div class="am-u-sm-9">
                                            <div class="am-form-group am-form-file">
                                                <!-- 展示上传的图片 -->
                                                <div  class="tpl-form-file-img">
                                                    <img src="{{$data['re_img']}}" id="img1" alt="图片加载失败">
                                                </div>
                                                <!-- 这是提交按钮 -->
                                                <!-- <button type="text" class="am-btn am-btn-danger am-btn-sm">
                                                  <i class="am-icon-cloud-upload"></i> 广告图片
                                                </button> -->
                                            </div>
                                            <input type="hidden" name="re_img" id="adv_img" value="">
                                            <!-- 隐藏域 -->
                                            
                                            <div class="am-form-group am-form-file">
                                                <i class="am-icon-cloud-upload">
                                                    <button><input type="file" id="file_upload" name="file_upload" value="">上传文件</button>
                                                </i>
                                            </div>
                                            
                                            <script type="text/javascript">
                                                $(function () {
                                                    $("#file_upload").change(function () {
                                                        // alert(111222333);
                                                        uploadImage();
                                                    })
                                                })
                                                function uploadImage() {
                                                    //判断是否有选择上传文件
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
                                                    var formData = new FormData($('#art_form')[0]);
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "/admin/upload",
                                                        //还得加ajax表单保护，手册里有。
                                                        headers: {
                                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                        },
                                                        data: formData,
                                                        contentType: false,
                                                        processData: false,
                                                        async:true,
                                                        cache:false,
                                                        success: function(data) {
                                                            $('#img1').attr('src',data);
                                                            $('#adv_img').val(data);
                                                        },
                                                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                                                            alert("上传失败，请检查网络后重试");
                                                        }
                                                    });
                                                }
                                            </script>

                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <div class="am-u-sm-9 am-u-sm-push-3">
                                            <button class="am-btn am-btn-primary tpl-btn-bg-color-success ">提交</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

@endsection