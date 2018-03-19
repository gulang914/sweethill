<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="keywords" content="{{Session::get('content')['content']}}">
    <title>{{Session::get('content')['title']}}</title>

    <link rel="stylesheet" type="text/css" href="/model/home/mu/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/model/home/mu/css/audio.css">

    <link href="/model/home/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />
    <link href="/model/home/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css" />

    <link href="/model/home/basic/css/demo.css" rel="stylesheet" type="text/css" />

    <link href="/model/home/css/hmstyle.css" rel="stylesheet" type="text/css"/>
    <link href="/model/home/css/skin.css" rel="stylesheet" type="text/css" />
    <script src="/model/home/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
    <script src="/model/home/AmazeUI-2.4.2/assets/js/amazeui.min.js"></script>

</head>

<body>
<div class="hmtop">
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
                <div class="menu-hd"><a id="mc-menu-hd" href="{{ url('/cart') }}" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">0</strong></a></div>
            </div>
            <div class="topMessage favorite">
                <div class="menu-hd"><a href="{{url('/rest')}}" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>放松一下吧</span></a></div>
            </div>
            <div class="topMessage favorite">
                <div class="menu-hd"><a href="{{url('/logout')}}" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>退出登录</span></a></div>
            </div>
        </ul>
    </div>

    <!--悬浮搜索框-->
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
    <div class="nav white">
        <div class="logo"><img src="/model/home/images/logo.png" /></div>
        <div class="logoBig">
            <li><img src="{{url(Session::get('content')['logo'])}}"  /></li>
        </div>

        <div class="search-bar pr">
            <a name="index_none_header_sysc" href="#"></a>
            <form action="/goods/search" method="post">
                {{ csrf_field() }}
                <input id="searchInput" name="index_none_header_sysc" type="text" placeholder="搜索" autocomplete="off">
                <input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit">
            </form>
        </div>
    </div>

    <div class="clear"></div>
</div>

<div class="banner">
    <!--轮播 -->
    <div class="am-slider am-slider-default scoll" data-am-flexslider id="demo-slider-0">
        <ul class="am-slides">
            <li class="banner1"><a href="/model/home/introduction.html"><img src="{{ $onecar['car_img'] }}" /></a></li>
            <li class="banner2"><a><img src="{{ $twocar['car_img'] }}" /></a></li>
            <li class="banner3"><a><img src="{{ $threecar['car_img'] }}" /></a></li>
            <li class="banner4"><a><img src="{{ $forecar['car_img'] }}" /></a></li>

        </ul>
    </div>
    <div class="clear"></div>
</div>
<div class="shopNav">
    <div class="slideall">

        <div class="long-title"><span class="all-goods">全部分类</span></div>
        <div class="nav-cont">
            <ul>
                @foreach(Session::get('gps') as $k => $v)
                <li class="index"><a href="{{$v['routes']}}">{{$v['name']}}</a></li>
                @endforeach
            </ul>
        </div>

        <!--侧边导航 -->
        <div id="nav" class="navfull">
            <div class="area clearfix">
                <div class="category-content" id="guide_2">

                    <div class="category">
                        <ul class="category-list" id="js_climit_li">
                            @foreach($cate as $k => $v)
                                <li class="appliance js_toggle relative first">
                                    <div class="category-info" >
                                        <h3 class="category-name b-category-name" ><i></i><a class="ml-22" href="/goods/{{ $v->id }}}" title="点心">{{ $v->cate_name }}</a></h3>
                                        <em>&gt;</em></div>
                                    <div class="menu-item menu-in top">
                                        <div class="area-in">
                                            <div class="area-bg">
                                                <div class="menu-srot">
                                                    <div class="sort-side">
                                                        <dl class="dl-sort">
                                                            <dt><span title="{{ $v->cate_name }}">{{ $v->cate_name }}</span></dt>
                                                            @foreach($cates[$k] as $a)
                                                                <dd><a title="{{ $a->cate_name }}" href="/goods/{{ $a->id }}"><span>{{ $a->cate_name }}</span></a></dd>
                                                            @endforeach
                                                        </dl>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <b class="arrow"></b>
                                </li>
                            @endforeach



                        </ul>
                    </div>
                </div>

            </div>
        </div>


        <!--轮播-->

        <script type="text/javascript">
            (function() {
                $('.am-slider').flexslider();
            });
            $(document).ready(function() {
                $("li").hover(function() {
                    $(".category-content .category-list li.first .menu-in").css("display", "none");
                    $(".category-content .category-list li.first").removeClass("hover");
                    $(this).addClass("hover");
                    $(this).children("div.menu-in").css("display", "block")
                }, function() {
                    $(this).removeClass("hover")
                    $(this).children("div.menu-in").css("display", "none")
                });
            })
        </script>




        <!--走马灯 -->
        <!-- 广告 -->
        @foreach($adv as $k => $v)
        <div class="marqueen">
            <span class="marqueen-title">商城头条</span>
            <div class="demo">
                <ul>
                    <li><a target="_blank" href="#"><span>[特惠]</span>{{ $v['adv_disc'] }}</a></li>
                    <li><a target="_blank" href="#"><span>[公告]</span>{{ $v['adv_post'] }}</a></li>
                </ul>
                <div class="advTip"><img src="{{ $v['adv_img'] }}"/></div>
            </div>
        </div>
        @endforeach
        <div class="clear"></div>
    </div>
    <script type="text/javascript">
        if ($(window).width() < 640) {
            function autoScroll(obj) {
                $(obj).find("ul").animate({
                    marginTop: "-39px"
                }, 500, function() {
                    $(this).css({
                        marginTop: "0px"
                    }).find("li:first").appendTo(this);
                })
            }
            $(function() {
                setInterval('autoScroll(".demo")', 3000);
            })
        }
    </script>
</div>
<div class="shopMainbg">

    <div id="f1">
        <!--甜点-->

        <div class="am-container ">
            <div class="shopTitle ">
                <h4>甜品</h4>
                <h3>每一道甜品都有一个故事</h3>
                <div class="today-brands ">
                    <a href="# ">桂花糕</a>
                    <a href="# ">奶皮酥</a>
                    <a href="# ">栗子糕 </a>
                    <a href="# ">马卡龙</a>
                    <a href="# ">铜锣烧</a>
                    <a href="# ">豌豆黄</a>
                </div>
                <span class="more ">
                    <a href="# ">更多美味<i class="am-icon-angle-right" style="padding-left:10px ;" ></i></a>
                        </span>
            </div>
        </div>

        <div class="am-g am-g-fixed floodFour">
            <div class="am-u-sm-5 am-u-md-4 text-one list ">
                <div class="word">
                    <a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>
                    <a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>
                    <a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>
                    <a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>
                    <a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>
                    <a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>
                </div>
                <a href="# ">
                    <div class="outer-con ">
                        <div class="title ">
                            开抢啦！
                        </div>
                        <div class="sub-title ">
                            零食大礼包
                        </div>
                    </div>
                    <img src="/model/home/images/act1.png " />
                </a>
                <div class="triangle-topright"></div>
            </div>

            <div class="am-u-sm-7 am-u-md-4 text-two sug">
                <div class="outer-con ">
                    <div class="title ">
                        雪之恋和风大福
                    </div>
                    <div class="sub-title ">
                        ¥13.8
                    </div>
                    <i class="am-icon-shopping-basket am-icon-md  seprate"></i>
                </div>
                <a href="# "><img src="/model/home/images/2.jpg" /></a>
            </div>

            <div class="am-u-sm-7 am-u-md-4 text-two">
                <div class="outer-con ">
                    <div class="title ">
                        雪之恋和风大福
                    </div>
                    <div class="sub-title ">
                        ¥13.8
                    </div>
                    <i class="am-icon-shopping-basket am-icon-md  seprate"></i>
                </div>
                <a href="# "><img src="/model/home/images/1.jpg" /></a>
            </div>


            <div class="am-u-sm-3 am-u-md-2 text-three big">
                <div class="outer-con ">
                    <div class="title ">
                        小优布丁
                    </div>
                    <div class="sub-title ">
                        ¥4.8
                    </div>
                    <i class="am-icon-shopping-basket am-icon-md  seprate"></i>
                </div>
                <a href="# "><img src="/model/home/images/5.jpg" /></a>
            </div>

            <div class="am-u-sm-3 am-u-md-2 text-three sug">
                <div class="outer-con ">
                    <div class="title ">
                        小优布丁
                    </div>
                    <div class="sub-title ">
                        ¥4.8
                    </div>
                    <i class="am-icon-shopping-basket am-icon-md  seprate"></i>
                </div>
                <a href="# "><img src="/model/home/images/3.jpg" /></a>
            </div>

            <div class="am-u-sm-3 am-u-md-2 text-three ">
                <div class="outer-con ">
                    <div class="title ">
                        小优布丁
                    </div>
                    <div class="sub-title ">
                        ¥4.8
                    </div>
                    <i class="am-icon-shopping-basket am-icon-md  seprate"></i>
                </div>
                <a href="# "><img src="/model/home/images/4.jpg" /></a>
            </div>

            <div class="am-u-sm-3 am-u-md-2 text-three last big ">
                <div class="outer-con ">
                    <div class="title ">
                        小优布丁
                    </div>
                    <div class="sub-title ">
                        ¥4.8
                    </div>
                    <i class="am-icon-shopping-basket am-icon-md  seprate"></i>
                </div>
                <a href="# "><img src="/model/home/images/5.jpg" /></a>
            </div>

        </div>
        <div class="clear "></div>
    </div>


    <div class="footer ">
        <div class="footer-hd ">
            <p>
        <b style="color:#000;">友情链接：</b>
                @foreach(Session::get('link') as $k => $v)
                <a href="{{$v['url']}}">{{$v['name']}}</a>
                <b>|</b>
                @endforeach
            </p>
        </div>
        <div class="footer-bd ">
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
</div>
<!--引导 -->
<div class="navCir">
    <li class="active"><a href="/model/home/home.html"><i class="am-icon-home "></i>首页</a></li>
    <li><a href="/model/home/sort.html"><i class="am-icon-list"></i>分类</a></li>
    <li><a href="/model/home/shopcart.html"><i class="am-icon-shopping-basket"></i>购物车</a></li>
    <li><a href="/model/home/person/index.html"><i class="am-icon-user"></i>我的</a></li>
</div>


<!--菜单 -->
<div class=tip>
    <div id="sidebar">
        <div id="wrap">
            <div id="prof" class="item ">
                <a href="# ">
                    <span class="setting "></span>
                </a>
                <div class="ibar_login_box status_login ">
                    <div class="avatar_box ">
                        <p class="avatar_imgbox "><img src="{{Session::get('users')['photo']}}" /></p>
                        <ul class="user_info ">
                            <li>用户名:{{Session::get('users')['nickname']}}</li>
                            <li>手机号:{{Session::get('users')['phone']}}</li>
                        </ul>
                    </div>
                    <div class="login_btnbox ">
                        <a href="# " class="login_order ">我的订单</a>
                        <a href="# " class="login_favorite ">我的收藏</a>
                    </div>
                    <i class="icon_arrow_white "></i>
                </div>

            </div>
            <div id="shopCart " class="item ">
                <a href="{{ url('/cart') }} ">
                    <span class="message "></span>
                </a>
                <p>
                    购物车
                </p>
                <p class="cart_num ">0</p>
            </div>


            <div class="quick_toggle ">
                <li class="qtitem ">
                    <a href="{{url('/user/')}}"><span class="kfzx "></span></a>
                    <div class="mp_tooltip ">意见反馈<i class="icon_arrow_right_black "></i></div>
                </li>
                <!--二维码 -->
                <li class="qtitem ">
                    <a href="#none "><span class="mpbtn_qrcode "></span></a>
                    <div class="mp_qrcode " style="display:none; "><img src="/model/home/images/weixin_code_145.png " /><i class="icon_arrow_white "></i></div>
                </li>
                <li class="qtitem ">
                    <a href="#top " class="return_top "><span class="top "></span></a>
                </li>
            </div>

            <!--回到顶部 -->
            <div id="quick_links_pop " class="quick_links_pop hide "></div>

        </div>

    </div>
    <div id="prof-content " class="nav-content ">
        <div class="nav-con-close ">
            <i class="am-icon-angle-right am-icon-fw "></i>
        </div>
        <div>
            我
        </div>
    </div>
    <div id="shopCart-content " class="nav-content ">
        <div class="nav-con-close ">
            <i class="am-icon-angle-right am-icon-fw "></i>
        </div>
        <div>
            购物车
        </div>
    </div>
    <div id="asset-content " class="nav-content ">
        <div class="nav-con-close ">
            <i class="am-icon-angle-right am-icon-fw "></i>
        </div>
        <div>
            资产
        </div>

        <div class="ia-head-list ">
            <a href="# " target="_blank " class="pl ">
                <div class="num ">0</div>
                <div class="text ">优惠券</div>
            </a>
            <a href="# " target="_blank " class="pl ">
                <div class="num ">0</div>
                <div class="text ">红包</div>
            </a>
            <a href="# " target="_blank " class="pl money ">
                <div class="num ">￥0</div>
                <div class="text ">余额</div>
            </a>
        </div>

    </div>
    <div id="foot-content " class="nav-content ">
        <div class="nav-con-close ">
            <i class="am-icon-angle-right am-icon-fw "></i>
        </div>
        <div>
            足迹
        </div>
    </div>
    <div id="brand-content " class="nav-content ">
        <div class="nav-con-close ">
            <i class="am-icon-angle-right am-icon-fw "></i>
        </div>
        <div>
            收藏
        </div>
    </div>
    <div id="broadcast-content " class="nav-content ">
        <div class="nav-con-close ">
            <i class="am-icon-angle-right am-icon-fw "></i>
        </div>
        <div>
            充值
        </div>
    </div>
</div>

<script>
    window.jQuery || document.write('<script src="/model/home/basic/js/jquery.min.js "><\/script>');
</script>
<script type="text/javascript " src="/model/home/basic/js/quick_links.js "></script>

</html>