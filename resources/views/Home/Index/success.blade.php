
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>{{Session::get('content')['title']}}</title>
<link rel="/model/home/stylesheet"  type="text/css" href="AmazeUI-2.4.2/assets/css/amazeui.css"/>
<link href="/model/home/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
<link href="/model/home/basic/css/demo.css" rel="stylesheet" type="text/css" />

<link href="/model/home/css/sustyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/model/home/basic/js/jquery-1.7.min.js"></script>

</head>

<body>


<!--顶部导航条 -->
<div class="am-container header">
    <ul class="message-l">
        <div class="topMessage">
            <div class="menu-hd">
                <a href="#" target="_top" class="h">尊敬的用户，{{Session::get('users')['nickname']}} 您好</a>
                <!-- <a href="#" target="_top">免费注册</a> -->
            </div>
        </div>
    </ul>
  <ul class="message-r">
    <div class="topMessage home"><div class="menu-hd"><a href="/index" target="_top" class="h">商城首页</a></div></div>
    <div class="topMessage my-shangcheng"><div class="menu-hd MyShangcheng"><a href="{{url('/user/index')}}" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div></div>
    <div class="topMessage mini-cart"><div class="menu-hd"><a id="mc-menu-hd" href="{{ url('/cart') }}" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">0</strong></a></div></div>
  </ul>
</div>

<!--悬浮搜索框-->

<div class="nav white">
	<div class="logo"><img src="/model/home/images/logo.png" /></div>
    <div class="logoBig">
        <li><img src="{{url(Session::get('content')['logo'])}}" style="width:150px;"/></li>
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



<div class="take-delivery">
 <div class="status">
   <h2>您已成功付款</h2>
   <div class="successInfo">
     <ul>
       <li>付款金额<em>￥{{ $res->totalmoney }}</em></li>
       <div class="user-info">
         <p>收货人：{{ $addr->name }}</p>
         <p>联系电话：{{ $addr->phone }}</p>
         <p>收货地址：{{ $addr->address }} {{ $addr->address_detail }}</p>
       </div>
             请认真核对您的收货信息，如有错误请联系客服
                               
     </ul>

    </div>
  </div>
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
