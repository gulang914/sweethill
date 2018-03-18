@extends('home.layout.index')
@section('style')
    <link type="text/css" href="/model/home/css/optstyle.css" rel="stylesheet" />
    <link type="text/css" href="/model/home/css/style.css" rel="stylesheet" />
@endsection

@section('js')
    <script type="text/javascript" src="/layer/layer.js"></script>
    <script type="text/javascript" src="/model/home/basic/js/quick_links.js"></script>
    <script type="text/javascript" src="/model/home/AmazeUI-2.4.2/assets/js/amazeui.js"></script>
    <script type="text/javascript" src="/model/home/js/jquery.imagezoom.min.js"></script>
    <script type="text/javascript" src="/model/home/js/jquery.flexslider.js"></script>
    <script type="text/javascript" src="/model/home/js/list.js"></script>
@endsection

@section('content')
    <div class="listMain">

        <!--分类-->
        <div class="nav-table">
            <div class="long-title"><span class="all-goods">全部分类</span></div>
            <div class="nav-cont">
                <ul>
                    @foreach(Session::get('gps') as $k => $v)
                        <li class="index"><a href="{{$v['routes']}}">{{$v['name']}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <ol class="am-breadcrumb am-breadcrumb-slash">

        </ol>

        <!--放大镜-->

        <div class="item-inform">
            <div class="clearfixLeft" id="clearcontent">

                <div class="box">
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $(".jqzoom").imagezoom();
                            $("#thumblist li a").click(function() {
                                $(this).parents("li").addClass("tb-selected").siblings().removeClass("tb-selected");
                                $(".jqzoom").attr('src', $(this).find("img").attr("mid"));
                                $(".jqzoom").attr('rel', $(this).find("img").attr("big"));
                            });
                        });
                    </script>

                    <div class="tb-booth tb-pic tb-s310">
                        <a href="#"><img src="{{ $goods->goods_photo }}" alt="细节展示放大镜特效" rel="{{ $goods->goods_photo }}" class="jqzoom" /></a>
                    </div>
                    <ul class="tb-thumb" id="thumblist">
                        <li class="tb-selected">
                            <div class="tb-pic tb-s40">
                                <a href="#"><img src="{{ $goods->goods_photo }}" mid="{{ $goods->goods_photo }}" big="{{ $goods->goods_photo }}"></a>
                            </div>
                        </li>

                    </ul>
                </div>

                <div class="clear"></div>
            </div>

            <div class="clearfixRight">

                <!--规格属性-->
                <!--名称-->
                <div class="tb-detail-hd">
                    <h1>
                        {{ $goods->goods_name }}
                    </h1>
                </div>
                <div class="tb-detail-list">
                    <!--价格-->
                    <div class="gid" hidden><p>{{ $goods->id }}</p></div>
                    <div class="tb-detail-price">
                        <li class="price iteminfo_price">
                            <dt>单价</dt>
                            <dd><em>¥</em><b class="sys_item_price">{{ $detail->goods_price }}</b>  </dd>
                        </li>

                        <div class="clear"></div>
                    </div>

                    <!--地址-->

                    <!--销量-->
                    <ul class="tm-ind-panel">
                        <li class="tm-ind-item tm-ind-sellCount canClick">
                            <div class="tm-indcon"><span class="tm-label">销量</span><span class="tm-count">{{ $detail->goods_sal }}</span></div>
                        </li>
                        <li class="tm-ind-item tm-ind-reviewCount canClick tm-line3">
                            <div class="tm-indcon"><span class="tm-label">累计评价</span><span class="tm-count">640</span></div>
                        </li>
                    </ul>
                    <div class="clear"></div>

                    <!--各种规格-->
                    <dl class="iteminfo_parameter sys_item_specpara">
                        <dt class="theme-login"><div class="cart-title">可选规格<span class="am-icon-angle-right"></span></div></dt>
                        <dd>
                            <!--操作页面-->

                            <div class="theme-popover-mask"></div>

                            <div class="theme-popover">
                                <div class="theme-span"></div>
                                <div class="theme-poptit">
                                    <a href="javascript:;" title="关闭" class="close">×</a>
                                </div>
                                <div class="theme-popbod dform">
                                    <form class="theme-signin" id="form" name="loginform" action="" method="post">

                                        <div class="theme-signin-left">
                                            @foreach($lable_one as $v)
                                            <div class="theme-options label">
                                                <div class="cart-title">{{ $v->label_name }}</div>
                                                <ul>
                                                    @foreach($lable_two[$v->id] as $a)
                                                    <li class="sku-line">{{ $a->label_name }}<i><input type="hidden" name="{{ $v->label_name }}" value="{{ $a->label_name }}"></i></li>
                                                    @endforeach
                                                </ul>
                                                <input type="hidden" class="type" value="{{ $v->label_name }}">
                                            </div>
                                            @endforeach

                                            <div class="theme-options">
                                                <div class="cart-title number">数量</div>
                                                <ul>
                                                    <input id="min" class="am-btn am-btn-default" name="" type="button" value="-" />
                                                    <input id="text_box" name="" type="text" value="1" style="width:30px;" />
                                                    <input id="add" class="am-btn am-btn-default" name="" type="button" value="+" />
                                                    <span id="Stock" class="tb-hidden">库存<span class="stock">{{ $detail->goods_inventory }}</span>件</span>
                                                </ul>
                                            </div>
                                            <div class="clear"></div>

                                        </div>


                                    </form>
                                </div>
                            </div>

                        </dd>
                    </dl>
    <div class="clear"></div>
    <!--活动	-->

    </div>

    <div class="pay">
        @if(empty(Session::get('users')))
            <li>
                <div class="clearfix tb-btn tb-btn-buy theme-login">
                    <a id="LikBuy" title="未登录，请登录以后再购买" href="/login">立即购买</a>
                </div>
            </li>
            <li>
                <div class="clearfix tb-btn tb-btn-basket theme-login">
                    <a id="LikBasket" title="加入购物车" href="/login"><i></i>加入购物车</a>
                </div>
            </li>
        @else
            <li>
                <div class="clearfix tb-btn tb-btn-buy theme-login">
                    <a id="LikBuy" class="shop" title="点此按钮到下一步确认购买信息" href="javascript:;">立即购买</a>
                </div>
            </li>
            <li>
                <div class="clearfix tb-btn tb-btn-basket theme-login">
                    <a id="LikBasket" title="加入购物车" href="javascript:;"><i></i>加入购物车</a>
                </div>
            </li>
        @endif
    </div>
                <script>
                    //立即购买
                    $('.sku-line').click(function () {
                       var one =$(this).parent().parent().find('.cart-title').text();
                       var two =$(this).text();
                       $(this).parent().parent().find('.type').text(one+':'+two+';')
                    });
                    $('.shop').click(function(){

                        var id = $('.gid').text();
                        var num = $('#text_box').val();
                        var price = $('.sys_item_price').text();
                        var type = $('.type').text();
//                        console.log(id);
//                        console.log(num);
//                        console.log(price);
//                        console.log(type);
                        window.location.href = '/index/pay?gid='+id+'&num='+num+'&price='+price+'&type='+type;
                    });

                    $('#LikBasket').click(function () {
                        var gid = $('.gid').find('p').html();
                        var num = $('#text_box').val();
                        var data1 = $('#form').serializeArray();
                        var data2 = $('.selected').text();
//
                        $.ajax({
                            url:"/cart",
                            type:"post",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            cache: false,
                            async:false,
                            data:{'gid':gid,'num':num,'data1':data1,'data2':data2},
                            success: function(data) {
//                                 console.log(data);
                                if(data.status == 1){
                                    layer.msg('添加成功', {
                                        icon: 6,
                                        time: 1000 //1秒关闭（如果不配置，默认是3秒）
                                    }, function(){
                                        parent.location.reload()
                                    });
                                }else{
                                    layer.alert('添加失败', {
                                        icon: 5,
                                        skin: 'layer-ext-moon'
                                    })
                                }
                            },
                            error: function(XMLHttpRequest, textStatus, errorThrown) {
                                alert("上传失败，请检查网络后重试");
                            }
                        })
                    });

                </script>

    </div>

    <div class="clear"></div>

    </div>



    <!-- introduce-->

    <div class="introduce">
        <div class="browse">
            <div class="mc">
                <ul>
                    <div class="mt">
                        <h2>看了又看</h2>
                    </div>

                    <li class="first">
                        <div class="p-img">
                            <a  href="#"> <img class="" src="/model/home/images/browse1.jpg"> </a>
                        </div>
                        <div class="p-name"><a href="#">
                                【三只松鼠_开口松子】零食坚果特产炒货东北红松子原味
                            </a>
                        </div>
                        <div class="p-price"><strong>￥35.90</strong></div>
                    </li>

                </ul>
            </div>
        </div>
        <div class="introduceMain">
            <div class="am-tabs" data-am-tabs>
                <ul class="am-avg-sm-3 am-tabs-nav am-nav am-nav-tabs">
                    <li class="am-active">
                        <a href="#">

                            <span class="index-needs-dt-txt">宝贝详情</span></a>

                    </li>

                    <li>
                        <a href="#">

                            <span class="index-needs-dt-txt">全部评价</span></a>

                    </li>

                    <li>
                        <a href="#">

                            <span class="index-needs-dt-txt">猜你喜欢</span></a>
                    </li>
                </ul>

                <div class="am-tabs-bd">

                    <div class="am-tab-panel am-fade am-in am-active">
                        <div class="J_Brand">

                            <div class="attr-list-hd tm-clear">
                                <h4>产品参数：</h4></div>
                            <div class="clear"></div>
                            <ul id="J_AttrUL">
                                <li title="">产品类型:&nbsp;{{ $detail->goods_type }}</li>
                                <li title="">产地:&nbsp;{{ $detail->goods_origin }}</li>
                                <li title="">配料:&nbsp;{{ $detail->goods_ingre }}</li>
                                <li title="">产品规格:&nbsp;{{ $detail->goods_specif }}</li>
                                <li title="">保质期:&nbsp;{{ $detail->goods_sheif_life }}</li>
                                <li title="">产品标准号:&nbsp;{{ $detail->goods_stand }}</li>
                                <li title="">生产许可证编号：&nbsp;{{ $detail->goods_pridoct }}</li>
                            </ul>
                            <div class="clear"></div>
                        </div>


                        <div class="clear"></div>

                    </div>

                    <div class="am-tab-panel am-fade">

                        <!-- <div class="actor-new">
                            <div class="rate">
                                <strong>100<span>%</span></strong><br> <span>好评度</span>
                            </div>
                            <dl>
                                <dt>买家印象</dt>
                                <dd class="p-bfc">
                                    <q class="comm-tags"><span>味道不错</span><em>(2177)</em></q>
                                    <q class="comm-tags"><span>颗粒饱满</span><em>(1860)</em></q>
                                    <q class="comm-tags"><span>口感好</span><em>(1823)</em></q>
                                    <q class="comm-tags"><span>商品不错</span><em>(1689)</em></q>
                                    <q class="comm-tags"><span>香脆可口</span><em>(1488)</em></q>
                                    <q class="comm-tags"><span>个个开口</span><em>(1392)</em></q>
                                    <q class="comm-tags"><span>价格便宜</span><em>(1119)</em></q>
                                    <q class="comm-tags"><span>特价买的</span><em>(865)</em></q>
                                    <q class="comm-tags"><span>皮很薄</span><em>(831)</em></q>
                                </dd>
                            </dl>
                        </div>
                        <div class="clear"></div>
                        <div class="tb-r-filter-bar">
                            <ul class=" tb-taglist am-avg-sm-4">
                                <li class="tb-taglist-li tb-taglist-li-current">
                                    <div class="comment-info">
                                        <span>全部评价</span>
                                        <span class="tb-tbcr-num">(32)</span>
                                    </div>
                                </li>

                                <li class="tb-taglist-li tb-taglist-li-1">
                                    <div class="comment-info">
                                        <span>好评</span>
                                        <span class="tb-tbcr-num">(32)</span>
                                    </div>
                                </li>

                                <li class="tb-taglist-li tb-taglist-li-0">
                                    <div class="comment-info">
                                        <span>中评</span>
                                        <span class="tb-tbcr-num">(32)</span>
                                    </div>
                                </li>

                                <li class="tb-taglist-li tb-taglist-li--1">
                                    <div class="comment-info">
                                        <span>差评</span>
                                        <span class="tb-tbcr-num">(32)</span>
                                    </div>
                                </li>
                            </ul>
                        </div> -->
                        <div class="clear"></div>

                       <!--PC版-->
                        <div id="SOHUCS" sid="33"></div>
                        <script charset="utf-8" type="text/javascript" src="https://changyan.sohu.com/upload/changyan.js" ></script>
                        <script type="text/javascript">
                        window.changyan.api.config({
                        appid: 'cytvJTGWq',
                        conf: 'prod_4efd6514d309331e3480575261c12f73'
                        });
                        </script>
                        <div class="clear"></div>
                    <!--PC版-->
<!--PC和WAP自适应版-->
<!-- <div id="SOHUCS" ></div> 
<script type="text/javascript"> 
(function(){ 
var appid = 'cytvJTGWq'; 
var conf = 'prod_4efd6514d309331e3480575261c12f73'; 
var width = window.innerWidth || document.documentElement.clientWidth; 
if (width < 960) { 
window.document.write('<script id="changyan_mobile_js" charset="utf-8" type="text/javascript" src="https://changyan.sohu.com/upload/mobile/wap-js/changyan_mobile.js?client_id=' + appid + '&conf=' + conf + '"><\/script>'); } else { var loadJs=function(d,a){var c=document.getElementsByTagName("head")[0]||document.head||document.documentElement;var b=document.createElement("script");b.setAttribute("type","text/javascript");b.setAttribute("charset","UTF-8");b.setAttribute("src",d);if(typeof a==="function"){if(window.attachEvent){b.onreadystatechange=function(){var e=b.readyState;if(e==="loaded"||e==="complete"){b.onreadystatechange=null;a()}}}else{b.onload=a}}c.appendChild(b)};loadJs("https://changyan.sohu.com/upload/changyan.js",function(){window.changyan.api.config({appid:appid,conf:conf})}); } })(); </script> -->
                        <!--分页 -->
                        <!-- <ul class="am-pagination am-pagination-right">
                            <li class="am-disabled"><a href="#">&laquo;</a></li>
                            <li class="am-active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#">&raquo;</a></li>
                        </ul> -->
                        <div class="clear"></div>

                        <div class="tb-reviewsft">
                            <div class="tb-rate-alert type-attention">购买前请查看该商品的 <a href="#" target="_blank">购物保障</a>，明确您的售后保障权益。</div>
                        </div>

                    </div>

                    <div class="am-tab-panel am-fade">
                        <div class="like">
                            <ul class="am-avg-sm-2 am-avg-md-3 am-avg-lg-4 boxes">
                                @foreach($related as $v)
                                <li>
                                    <div class="i-pic limit">
                                        <a href="/goods/detal/show/{{ $v->id }}"><img src="{{ $v->goods_photo }}" /></a>
                                        <p>{{ $v->goods_name }}</p>
                                        <p class="price fl">
                                            <b>¥</b>
                                            <strong>{{ $v->goodsdetail->goods_price }}</strong>
                                        </p>
                                    </div>
                                </li>
                                    @endforeach
                            </ul>
                        </div>
                        <div class="clear"></div>

                        <!--分页 -->


                    </div>

                </div>

            </div>

            <div class="clear"></div>

@endsection
