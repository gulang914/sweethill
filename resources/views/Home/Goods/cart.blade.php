@extends('home.layout.index')
@section('style')
    <link href="/model/home/css/cartstyle.css" rel="stylesheet" type="text/css" />
    <link href="/model/home/css/optstyle.css" rel="stylesheet" type="text/css" />

@endsection

@section('js')
    <script type="text/javascript" src="/model/home/basic/js/quick_links.js"></script>
    <script type="text/javascript" src="/model/home/AmazeUI-2.4.2/assets/js/amazeui.js"></script>
    <script type="text/javascript" src="/model/home/js/jquery.imagezoom.min.js"></script>
    <script type="text/javascript" src="/model/home/js/jquery.flexslider.js"></script>
    <script type="text/javascript" src="/model/home/js/list.js"></script>
    <script type="text/javascript" src="/layer/layer.js"></script>
@endsection

@section('content')

    <!--购物车 -->
    <div class="concent">
        <div id="cartTable">
            <div class="cart-table-th">
                <div class="wp">
                    <div class="th th-chk">
                        <div id="J_SelectAll1" class="select-all J_SelectAll">

                        </div>
                    </div>
                    <div class="th th-item">
                        <div class="td-inner">商品信息</div>
                    </div>
                    <div class="th th-price">
                        <div class="td-inner">单价</div>
                    </div>
                    <div class="th th-amount">
                        <div class="td-inner">数量</div>
                    </div>
                    <div class="th th-sum">
                        <div class="td-inner">金额</div>
                    </div>
                    <div class="th th-op">
                        <div class="td-inner">操作</div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>

            <tr class="item-list">
                <div class="bundle  bundle-last ">

                    <div class="clear"></div>
                    <div class="bundle-main">
                        @foreach($cart as $v)
                            @foreach($v->goods as $a)
                                <form action="" method="get" >
                                    <ul class="item-content clearfix">
                                        <li class="td td-chk">
                                            <div class="cart-checkbox ">
                                                <input class="check"  name="items[]" value="{{ $v->id }}" type="checkbox">
                                                <label for="J_CheckBox_170037950254"></label>
                                            </div>
                                        </li>
                                        <li class="td td-item">
                                            <div class="item-pic">
                                                <a href="/goods/detal/show/{{ $a->id }}" target="_blank" data-title="{{ $a['goods_name'] }}" class="J_MakePoint" data-point="tbcart.8.12">
                                                    <img src="{{ $a['goods_photo'] }}" style="width: 100px;" class="itempic J_ItemImg"></a>
                                            </div>
                                            <div class="item-info">
                                                <div class="item-basic-info">
                                                    <a href="#" target="_blank" title="{{ $a['goods_name'] }}" class="item-title J_MakePoint" data-point="tbcart.8.11">{{ $a['goods_name'] }}</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="td td-info">
                                            <div class="item-props item-props-can">
                                                <span class="sku-line">{{ $v->type }}</span>
                                            </div>
                                        </li>
                                        <li class="td td-price">
                                            <div class="item-price price-promo-promo">
                                                <div class="price-content">
                                                    <div class="price-line">
                                                        <em class="J_Price price-now" tabindex="0">{{ $a->goodsdetail->goods_price }}</em>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="td td-amount">

                                            <div class="amount-wrapper ">
                                                <div class="item-amount ">
                                                    <div class="sl">

                                                        <input class="min am-btn" name="" type="button" value="-" />
                                                        <input class="text_box" name="" type="text" value="{{ $v->num }}" style="width:30px;" />
                                                        <input class="add am-btn" name="" type="button" value="+" />
                                                    </div>
                                                </div>
                                            </div>

                                        </li>
                                        <li class="td td-sum">
                                            <div class="td-inner">
                                                <em tabindex="0" class="J_ItemSum number">{{ $v->num *$a->goodsdetail->goods_price }}</em>
                                            </div>
                                        </li>
                                        <li class="td td-op">
                                            <div class="td-inner">
                                                <a href="javascript:;"  class="delete">
                                                    删除</a>
                                                <input type="submit" value="购买">
                                                <div class="cid"></div>
                                            </div>
                                        </li>
                                    </ul>
                                </form>
                                @endforeach
                        @endforeach

                    </div>
                </div>
            </tr>
            <div class="clear"></div>


        </div>
        <div class="clear"></div>

        <div class="float-bar-wrapper">
            <div id="J_SelectAll2" class="select-all J_SelectAll">
                <div class="cart-checkbox">
                    <input class="check-all check" id="J_SelectAllCbx2" name="select-all" value="true" type="checkbox">
                    <label for="J_SelectAllCbx2"></label>
                </div>
                <span>全选</span>
            </div>
            <div class="operations">
                <a href="#" hidefocus="true" class="deleteAll">删除</a>
            </div>
            <script>
                $('.add').click(function(){
                    var a = $(this).parent().find('.text_box').val();
                    var b = parseInt(a)+1;
                    $(this).parent().find('.text_box').val(b);
                    var c = $(this).parent().parent().parent().parent().parent().find('.td-price').find('.price-now').text();
                    c = parseFloat(c);
                    $(this).parent().parent().parent().find('.td-sum').find('em').text(c*b);

                });
                $('.min').click(function(){
                    var a = $(this).parent().find('.text_box').val();
                    var b = parseInt(a);
                    if(b != 1){
                        b = b-1;
                    }
                    $(this).parent().find('.text_box').val(b);
                    var c = $(this).parent().parent().parent().parent().parent().find('.td-price').find('.price-now').text();
                    c = parseFloat(c);
                    $(this).parent().parent().parent().parent().parent().find('.td-sum').find('em').text(c*b);
                });
                $('.delete').click(function(){
                    var id = $(this).parent().parent().parent().find('.td-chk').find('input').val();
                    $.ajax({
                        url:"/cart/delete",
                        type:"post",
                        cache: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        async:false,
                        data:{'id':id},
                        success: function(data) {
                            // console.log(data);
                            if(data.status == 1){
                                layer.alert('删除成功', {
                                    icon: 6,
                                    skin: 'layer-ext-moon'
                                })
                                parent.location.reload()
                            }else{
                                layer.alert('删除失败', {
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
            <div class="float-bar-right">
                <div class="amount-sum">
                    <span class="txt">已选商品</span>
                    <em id="J_SelectedItemsCount">0</em><span class="txt">件</span>
                    <div class="arrow-box">
                        <span class="selected-items-arrow"></span>
                        <span class="arrow"></span>
                    </div>
                </div>
                <div class="price-sum">
                    <span class="txt">合计:</span>
                    <strong class="price">¥<em id="J_Total">0.00</em></strong>
                </div>
                <div class="btn-area">
                    <a href="pay.html" id="J_Go" class="submit-btn submit-btn-disabled" aria-label="请注意如果没有选择宝贝，将无法结算">
                        <span>结&nbsp;算</span></a>
                </div>
            </div>

        </div>

        <div class="footer">
            <div class="footer-hd">
                <p>
                    <a href="#">恒望科技</a>
                    <b>|</b>
                    <a href="#">商城首页</a>
                    <b>|</b>
                    <a href="#">支付宝</a>
                    <b>|</b>
                    <a href="#">物流</a>
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

    <!--操作页面-->


    <!--引导 -->

@endsection
