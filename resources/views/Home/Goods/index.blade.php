@extends('home.layout.index')
@section('style')
    <link href="/model/home/css/seastyle.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="search">
        <div class="search-list">
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


            <div class="am-g am-g-fixed">
                <div class="am-u-sm-12 am-u-md-12">


                    <div class="search-content">
                        <div class="sort">
                            <li class="first"><a title="综合">综合排序</a></li>
                            <li><a title="销量">销量排序</a></li>
                            <li><a title="价格">价格优先</a></li>
                            <li class="big"><a title="评价" href="#">评价为主</a></li>
                        </div>
                        <div class="clear"></div>

                        <ul class="am-avg-sm-2 am-avg-md-3 am-avg-lg-4 boxes">
                            @foreach($goods as $k=>$v)

                            <li class="click">
                                <div class="goodsid" hidden>{{ $v->id }}</div>
                                <div class="i-pic limit">
                                    <a href="/goods/detal/show/{{ $v->id }}">
                                    <img src="{{ $v->goods_photo }}" />
                                    </a>
                                    <p class="title fl">{{ $v->goods_name }}</p>
                                    <p class="price fl">
                                        <b>¥</b>
                                        <strong>{{ $v->goodsdetail->goods_price }}</strong>
                                    </p>
                                    <p class="number fl">
                                        销量<span>{{ $v->goodsdetail->goods_sal }}</span>
                                    </p>
                                </div>
                            </li>

                            @endforeach
                        </ul>
                    </div>
                    <div class="search-side">

                        <div class="side-title">
                            经典搭配
                        </div>

                        <li>
                            <div class="i-pic check">
                                <img src="/model/home/images/cp.jpg" />
                                <p class="check-title">萨拉米 1+1小鸡腿</p>
                                <p class="price fl">
                                    <b>¥</b>
                                    <strong>29.90</strong>
                                </p>
                                <p class="number fl">
                                    销量<span>1110</span>
                                </p>
                            </div>
                        </li>
                        <li>
                            <div class="i-pic check">
                                <img src="/model/home/images/cp2.jpg" />
                                <p class="check-title">ZEK 原味海苔</p>
                                <p class="price fl">
                                    <b>¥</b>
                                    <strong>8.90</strong>
                                </p>
                                <p class="number fl">
                                    销量<span>1110</span>
                                </p>
                            </div>
                        </li>
                        <li>
                            <div class="i-pic check">
                                <img src="/model/home/images/cp.jpg" />
                                <p class="check-title">萨拉米 1+1小鸡腿</p>
                                <p class="price fl">
                                    <b>¥</b>
                                    <strong>29.90</strong>
                                </p>
                                <p class="number fl">
                                    销量<span>1110</span>
                                </p>
                            </div>
                        </li>

                    </div>
                    <div class="clear"></div>

                </div>
            </div>
        </div>
    </div>

@endsection