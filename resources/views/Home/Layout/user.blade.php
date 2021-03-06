<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="{{Session::get('content')['content']}}">
    <title>{{Session::get('content')['title']}}</title>

    <link rel="stylesheet" type="text/css" href="/model/home/mu/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/model/home/mu/css/audio.css">

    <link href="/model/home/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
    <link href="/model/home/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">

    <link href="/model/home/css/personal.css" rel="stylesheet" type="text/css">

    @section('css')
    @show

    <link href="/model/home/css/orstyle.css" rel="stylesheet" type="text/css">
    <!-- 这是任高磊引入的Bootstrap -->
    <link rel="stylesheet" type="text/css" href="/bootstrap-3.3.7-dist/css/bootstrap.min.css">

    <script src="/model/home/AmazeUI-2.4.2/assets/js/jquery.min.js" type="text/javascript"></script>
    <script src="/model/home/AmazeUI-2.4.2/assets/js/amazeui.js" type="text/javascript"></script>
    <!-- 这是任高磊引入的layer弹层 -->
    <script type="text/javascript" src="/layer/layer.js"></script>
    <!-- 这是任高磊写的占位符 -->
    @section('header')

    @show

</head>




<body>
<!--头 -->
<header>
    <article>
        <div class="mt-logo">
            <!--顶部导航条 -->
            <div class="am-container header">
        @if(empty(Session::get('users')))
        <ul class="message-l">
            <div class="topMessage">
                <div class="menu-hd">
                    <a href="{{url('/login')}}" target="_top" class="h">亲，请登录</a>
                    <a href="{{url('/register')}}" target="_top">免费注册</a>
                </div>
            </div>
        </ul>
        @else
        <ul class="message-l">
            <div class="topMessage">
                <div class="menu-hd">
                    <a href="#" target="_top" class="h">尊敬的用户，{{Session::get('users')['nickname']}} 您好</a>
                    <!-- <a href="#" target="_top">免费注册</a> -->
                </div>
            </div>
        </ul>
        @endif
                <ul class="message-r">
                    <div class="topMessage home">
                        <div class="menu-hd"><a href="{{url('/index')}}" target="_top" class="h">商城首页</a></div>
                    </div>
                    <div class="topMessage my-shangcheng">
                        <div class="menu-hd MyShangcheng"><a href="{{url('/user/index')}}" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
                    </div>
                    <div class="topMessage mini-cart">
                        <div class="menu-hd"><a id="mc-menu-hd" href="#" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">0</strong></a></div>
                    </div>
                    <div class="topMessage favorite">
                        <div class="menu-hd"><a href="#" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
                    </div>
                    <div class="topMessage favorite">
                        <div class="menu-hd"><a href="{{url('logout')}}" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>退出登录</span></a></div>
                    </div>
                </ul>
                    </div>

            <!--悬浮搜索框-->

            <div class="nav white">
                <div class="logoBig">
                    <li><img src="{{url(Session::get('content')['logo'])}}" style="height:100px;" /></li>
                </div>

                <div class="search-bar pr">
                    <a name="index_none_header_sysc" href="#"></a>
                    <form>
                        <input id="searchInput" name="index_none_header_sysc" type="text" placeholder="搜索" autocomplete="off">
                        <input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit">
                    </form>
                </div>
            </div>

            <div class="clear"></div>
        </div>
        </div>
    </article>
</header>
<div class="center">
    <div class="col-main">
        <div class="main-wrap">
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

                          alert.html(msg).show();
                        }
                      });
                    });
                </script>
        @section('content')
        @show
        </div>
        <!--底部-->
        <div class="footer">
            <div class="footer-hd">
                <p>
                <b style="color:#000;">友情链接：</b>
                        @foreach(Session::get('link') as $k => $v)
                        <a href="{{$v['url']}}">{{$v['name']}}</a>
                        <b>|</b>
                        @endforeach
            </p>
            </div>
            <div class="footer-bd">
                <p>
                    <a href="#">关于恒望</a>
                    <a href="#">合作伙伴</a>
                    <a href="#">联系我们</a>
                    <a href="#">网站地图</a>
                    <em>© 2015-2025 Hengwang.com 版权所有</em>
                </p>
            </div>
        </div>
    </div>

    <aside class="menu">
        <ul>
            <li class="person">
                <a href="/user/index">个人中心</a>
            </li>
            <li class="person">
                <a href="/user/index">个人资料</a>
                <ul>
                    <li> <a href="/user/create">个人信息</a></li>
                    <li> <a href="/user/secure">安全设置</a></li>
                    <li> <a href="{{ url('index/address') }}">收货地址</a></li>
                </ul>
            </li>
            <li class="person">
                <a href="#">我的交易</a>
                <ul>
                    <li><a href="{{url('index/order')}}">订单管理</a></li>
                    <li> <a href="/model/home/change.html">退款售后</a></li>
                </ul>
            </li>

        </ul>

    </aside>
</div>
</html>