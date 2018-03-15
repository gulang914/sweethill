<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>Sweet Hill  甜丘</title>

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
        <ul class="message-l">
            <div class="topMessage">
                <div class="menu-hd">
                    <a href="#" target="_top" class="h">亲，请登录</a>
                    <a href="#" target="_top">免费注册</a>
                </div>
            </div>
        </ul>
        <ul class="message-r">
            <div class="topMessage home">
                <div class="menu-hd"><a href="/#" target="_top" class="h">商城首页</a></div>
            </div>
            <div class="topMessage my-shangcheng">
                <div class="menu-hd MyShangcheng"><a href="#" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
            </div>
            <div class="topMessage mini-cart">
                <div class="menu-hd"><a id="mc-menu-hd" href="#" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">0</strong></a></div>
            </div>
            <div class="topMessage favorite">
                <div class="menu-hd"><a href="#" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
        </ul>
    </div>

    <!--悬浮搜索框-->

    <div class="nav white">
        <div class="logo"><img src="/model/home/images/logo.png" /></div>
        <div class="logoBig">
            <li><img src="/model/home/images/logobig.png" /></li>
        </div>

        <div class="search-bar pr">
            <a name="index_none_header_sysc" href="#"></a>
            <form>
                <input id="searchInput" name="index_none_header_sysc" type="text" placeholder="请输入您想要的甜~" autocomplete="off">
                <input id="ai-topsearch" class="submit am-btn" value="搜一下" index="1" type="submit">
            </form>
        </div>
    </div>

    <div class="clear"></div>
</div>
@section('lunbo')
@show
<div class="shopNav">
    {{--导航--}}
    <div class="slideall">
        <div class="nav-cont">
            <ul>
                <li class="index"><a href="#">甜丘首页</a></li>
                <li class="qc"><a href="#">小购物车</a></li>
                <li class="qc"><a href="#">心仪收藏</a></li>
                <li class="qc"><a href="#">个人中心</a></li>
            </ul>
        </div>

        <div class="long-title"><span class="all-goods">商品分类</span></div>
        {{--导航--}}

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



        <!--小导航 -->
        <div class="am-g am-g-fixed smallnav">
            <div class="am-u-sm-3">
                <a href="/model/home/sort.html"><img src="/model/home/images/navsmall.jpg" />
                    <div class="title">商品分类</div>
                </a>
            </div>
            <div class="am-u-sm-3">
                <a href="#"><img src="/model/home/images/huismall.jpg" />
                    <div class="title">大聚惠</div>
                </a>
            </div>
            <div class="am-u-sm-3">
                <a href="#"><img src="/model/home/images/mansmall.jpg" />
                    <div class="title">个人中心</div>
                </a>
            </div>
            <div class="am-u-sm-3">
                <a href="#"><img src="/model/home/images/moneysmall.jpg" />
                    <div class="title">投资理财</div>
                </a>
            </div>
        </div>

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
    <div class="shopMain" id="shopmain">
        @section('content')
        @show

    </div>
</div>
<div class="footer ">
    <div class="footer-hd ">
        <p>
            <a href="/model/home/# ">恒望科技</a>
            <b>|</b>
            <a href="/model/home/# ">商城首页</a>
            <b>|</b>
            <a href="/model/home/# ">支付宝</a>
            <b>|</b>
            <a href="/model/home/# ">物流</a>
        </p>
    </div>
    <div class="footer-bd ">
        <p>
            <a href="/model/home/# ">关于恒望</a>
            <a href="/model/home/# ">合作伙伴</a>
            <a href="/model/home/# ">联系我们</a>
            <a href="/model/home/# ">网站地图</a>
            <em>© 2015-2025 Hengwang.com 版权所有</em>
        </p>
    </div>
</div>

<script>
    window.jQuery || document.write('<script src="/model/home/basic/js/jquery.min.js "><\/script>');
</script>
<script type="text/javascript " src="/model/home/basic/js/quick_links.js "></script>
</body>

</html>