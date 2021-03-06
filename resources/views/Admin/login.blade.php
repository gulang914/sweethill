<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sweet Hill 甜丘后台</title>
    <meta name="description" content="这是一个 index 页面">
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="icon" type="image/png" href="/Admin/i/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="/Admin/i/app-icon72x72@2x.png">
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <link rel="stylesheet" href="/Admin/css/amazeui.min.css" />
    <link rel="stylesheet" href="/Admin/css/amazeui.datatables.min.css" />
    <link rel="stylesheet" href="/Admin/css/app.css">
    <script src="/Admin/js/jquery.min.js"></script>

</head>

<body data-type="login">
    <script src="/Admin/js/theme.js"></script>
    <script type="text/javascript"> 
    //点击切换验证码的js代码 
    function re_captcha() {  
        $url = "{{ URL('/code/captcha') }}";
        $url = $url + "/" + Math.random();
            document.getElementById('127ddf0de5a04167a9e427d883690ff6').src = $url;
        }
    </script> 
    <div class="am-g tpl-g">
        <!-- 风格切换 -->
        <div class="tpl-skiner">
            <div class="tpl-skiner-toggle am-icon-cog">
            </div>
            <div class="tpl-skiner-content">
                <div class="tpl-skiner-content-title">
                    选择主题
                </div>
                <div class="tpl-skiner-content-bar">
                    <span class="skiner-color skiner-white" data-color="theme-white"></span>
                    <span class="skiner-color skiner-black" data-color="theme-black"></span>
                </div>
            </div>
        </div>
        <div class="tpl-login">

            <div class="tpl-login-content">
                <div class="tpl-login-logo">
                    <img src="/model/admin/assets/img/logo.jpg" width="220px">
                </div>

                <script type="text/javascript">
                    $(".alert").click(function() {
                        $(".alert").hide("slow");
                    });
                </script>
                 @if (count($errors) > 0)
                    <div class="alert alert-danger" style="color:red;">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="am-form tpl-form-line-form" action="/admin/handle" method="post">
                    {{ csrf_field() }}
                    <div class="am-form-group">
                        <input type="text" class="tpl-form-input" name="username" id="user-name" placeholder="请输入账号"  value="{{ old('username') }}" >

                    </div>

                    <div class="am-form-group">
                        <input type="password" class="tpl-form-input" name="password" id="user-pass" placeholder="请输入密码">

                    </div>
                    <div class="am-form-group">
                        <input name="captcha" type="text" placeholder="验证码" style="width:180px;float:left;">  
                        <a style="float:right;" onclick="javascript:re_captcha();">  
                            <img src="{{ URL('/code/captcha/1') }}" id="127ddf0de5a04167a9e427d883690ff6">  
                        </a> 
                    </div>


        



                    <div class="am-form-group">

                        <!-- <button type="button" class="am-btn am-btn-primary  am-btn-block tpl-btn-bg-color-success  tpl-login-btn">提交</button> -->
                        <input type="submit" value="提交" style="margin-left:120px;">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="/Admin/js/amazeui.min.js"></script>
    <script src="/Admin/js/app.js"></script>

</body>

</html>