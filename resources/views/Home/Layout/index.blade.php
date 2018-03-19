<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="uyan_auth" content="6a21d65dc3" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="{{Session::get('content')['content']}}">
    <title>{{Session::get('content')['title']}}</title>

    <link rel="stylesheet" type="text/css" href="/model/home/mu/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/model/home/mu/css/audio.css">
    
    <link href="/model/home/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />
    <link href="/model/home/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css" />

    <link href="/model/home/basic/css/demo.css" rel="stylesheet" type="text/css" />

    @section('style')

    @show

    <script type="text/javascript" src="/model/home/basic/js/jquery-1.7.min.js"></script>
    {{--<script type="text/javascript" src="/model/home/js/script.js"></script>--}}
    @section('js')

    @show
</head>

<body>


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
            <div class="menu-hd"><a id="mc-menu-hd" href="{{ url('/cart') }}" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h"></strong></a></div>
        </div>
        <div class="topMessage favorite">
            <div class="menu-hd"><a href="{{url('/logout')}}" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>退出登录</span></a></div>
        </div>
    </ul>
</div>

<!--悬浮搜索框-->

<div class="nav white">
    <div class="logo"><img src="/model/home/images/logo.png" /></div>
    <div class="logoBig">
        <li><img src="{{url(Session::get('content')['logo'])}}" style="height:100px;"  /></li>
    </div>

    <div class="search-bar pr">
        <a name="index_none_header_sysc" href="/model/home/#"></a>
        <form action="/goods/search" method="post">
            {{ csrf_field() }}
            <input id="searchInput" name="index_none_header_sysc" type="text" placeholder="搜索" autocomplete="off">
            <input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit">
        </form>
    </div>
</div>

<div class="clear"></div>
<b class="line"></b>

@section('content')

@show
<!--引导 -->

    <script type='text/javascript'>
        (function(m, ei, q, i, a, j, s) {
            m[i] = m[i] || function() {
                    (m[i].a = m[i].a || []).push(arguments)
                };
            j = ei.createElement(q),
                s = ei.getElementsByTagName(q)[0];
            j.async = true;
            j.charset = 'UTF-8';
            j.src = 'https://static.meiqia.com/dist/meiqia.js?_=t';
            s.parentNode.insertBefore(j, s);
        })(window, document, 'script', '_MEIQIA');
        _MEIQIA('entId', 100382);
    </script>
    <!--菜单 -->
    <div class=tip>
        <div id="sidebar">
            <div id="wrap">
                <div id="prof" class="item">
                    <a href="/model/home/#">
                        <span class="setting"></span>
                    </a>
                    <div class="ibar_login_box status_login">
                        <div class="avatar_box">
                            <p class="avatar_imgbox"><img src="{{Session::get('users')['photo']}} /></p>
                            <ul class="user_info ">
                            <li>用户名:{{Session::get('users')['nickname']}}</li>
                            <li>手机号:{{Session::get('users')['phone']}}</li>
                        </ul>
                        </div>
                        <div class="login_btnbox">
                            <a href="/model/home/#" class="login_order">我的订单</a>
                        </div>
                        <i class="icon_arrow_white"></i>
                    </div>

                </div>
                <div id="shopCart" class="item">
                    <a href="{{ url('/cart') }}">
                        <span class="message"></span>

                    <p>
                        购物车
                    </p>
                    <p class="cart_num">0</p>
                    </a>
                </div>

                <div class="quick_toggle">
                    <li class="qtitem">
                        <a href="/model/home/#"><span class="kfzx"></span></a>
                        <div class="mp_tooltip">客服中心<i class="icon_arrow_right_black"></i></div>
                    </li>
                    <!--二维码 -->
                    <li class="qtitem">
                        <a href="/model/home/#none"><span class="mpbtn_qrcode"></span></a>
                        <div class="mp_qrcode" style="display:none;"><img src="/model/home/images/weixin_code_145.png" /><i class="icon_arrow_white"></i></div>
                    </li>
                    <li class="qtitem">
                        <a href="/model/home/#top" class="return_top"><span class="top"></span></a>
                    </li>
                </div>

                <!--回到顶部 -->
                <div id="quick_links_pop" class="quick_links_pop hide"></div>

            </div>
        </div>
        <div id="prof-content" class="nav-content">
            <div class="nav-con-close">
                <i class="am-icon-angle-right am-icon-fw"></i>
            </div>
            <div>
                我
            </div>
        </div>
        <div id="shopCart-content" class="nav-content">
            <div class="nav-con-close">
                <i class="am-icon-angle-right am-icon-fw"></i>
            </div>
            <div>
                购物车
            </div>
        </div>


        <div class="theme-popover-mask"></div>
    </div>
    <div class="footer" >
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
                <a href="#">关于甜丘</a>
                <a href="#">合作伙伴</a>
                <a href="#">联系我们</a>
                <a href="#">网站地图</a>
                <em>© 2015-2025 Hengwang.com 版权所有</em>
            </p>
        </div>
    </div>

</body>
</html>