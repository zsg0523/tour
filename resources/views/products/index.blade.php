<style type="text/css">
    .navbar-static-top{margin-bottom: 0 !important;}
    .banners{width: 100%;}
    .swiper-container, .newsSwiper-container{width: 100%;position: relative;}
    .swiper-wrapper{height: auto !important;}
    .swiper-slide img{width: 100%;}
    
  .swiper-button-prev:after, .swiper-container-rtl .swiper-button-next:after ,.swiper-button-next:after, .swiper-container-rtl .swiper-button-prev:after{content: none !important;}

    .swiper-button-prev {position: absolute;top: 50%;left: 0;z-index: 9;background: url("{{asset('images/home_up.png')}}")0% 50% no-repeat !important;background-size:46px 46px !important;width:46px !important;height: 46px !important;left:0px;}
  .swiper-button-next {position: absolute;top: 50%;right: 0;z-index: 9;background: url("{{asset('images/home_down.png')}}")0% 50% no-repeat !important;background-size:46px 46px !important;width:46px !important;height: 46px !important;right:0px;}
  .row{margin-top: 20px;}

@media screen and (max-width: 768px) {
  .swiper-button-prev {background: url("{{asset('images/home_up.png')}}")0% 50% no-repeat !important;background-size:20px 20px !important;width:20px !important;height:20px !important;left:0px;}
  .swiper-button-next {background: url("{{asset('images/home_down.png')}}")0% 50% no-repeat !important;background-size:20px 20px !important;width:20px !important;height: 20px !important;right:0px;}  
  .productCategory{width:100%;height:150px;}
  .productCategory>p.categoryName{height:32px;line-height:32px;font-size:0.75rem;}
  .swiper-container{width:86%;height:120px;}
  .productBox{width:90%;height:80px;/*margin:10px auto;*/overflow:hidden;}
  .productBox img{height:54px;display:block;margin:10px auto 0px auto;}
  .swiper-pagination-bullet{width:6px;height:6px;}
  .productBox span{height:20px;line-height:20px;font-size:0.4rem;}
}
</style>
@extends('layouts.app')
@section('title', '商品列表')

@section('banner')
<!-- banners -->
<div class="banners">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="{{asset('images/banner1.png')}}">
            </div>
            <div class="swiper-slide">
                <img src="{{asset('images/banner2.png')}}">
            </div>
            <div class="swiper-slide">
                <img src="{{asset('images/banner1.png')}}">
            </div>
            <div class="swiper-slide">
                <img src="{{asset('images/banner2.png')}}">
            </div>
        </div>
        <div class="swiper-button-next swiper-button-next1"></div>
        <div class="swiper-button-prev swiper-button-prev1"></div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
<div class="col-lg-10 offset-lg-1">
<div class="card">
  <div class="card-body">
    <!-- 筛选组件开始 -->
    <form action="{{ route('products.index') }}" class="search-form">
      <div class="form-row">
        <div class="col-md-9">
          <div class="form-row">
            <div class="col-auto"><input type="text" class="form-control form-control-sm" name="search" placeholder="搜索"></div>
            <div class="col-auto"><button class="btn btn-primary btn-sm">搜索</button></div>
          </div>
        </div>
        <div class="col-md-3">
          <select name="order" class="form-control form-control-sm float-right">
            <option value="">排序方式</option>
            <option value="price_asc">价格从低到高</option>
            <option value="price_desc">价格从高到低</option>
            <option value="sold_count_desc">销量从高到低</option>
            <option value="sold_count_asc">销量从低到高</option>
            <option value="rating_desc">评价从高到低</option>
            <option value="rating_asc">评价从低到高</option>
          </select>
        </div>
      </div>
    </form>
    <!-- 筛选组件结束 -->
    <div class="row products-list">
      @foreach($products as $product)
        <div class="col-3 product-item">
          <div class="product-content">
            <div class="top">
              <div class="img">
                <a href="{{ route('products.show', ['product' => $product->id]) }}">
                  <img src="{{ $product->image_url }}" alt="">
                </a>
              </div>
              <div class="price"><b>￥</b>{{ $product->price }}</div>
              <div class="title">
                <a href="{{ route('products.show', ['product' => $product->id]) }}">{{ $product->title }}</a>
              </div>
            </div>
            <div class="bottom">
              <div class="sold_count">销量 <span>{{ $product->sold_count }}笔</span></div>
              <div class="review_count">评价 <span>{{ $product->review_count }}</span></div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
    <div class="float-right">{{ $products->appends($filters)->render() }}</div>
  </div>
</div>
</div>
</div>
@endsection

@section('scriptsAfterJs')
  <script>
    var filters = {!! json_encode($filters) !!};
    $(document).ready(function () {
    var mySwiper = new Swiper('.swiper-container', {
        autoplay: 6000,//可选选项，自动滑动
        loop : true,
        navigation: {
            nextEl: '.swiper-button-next1',
            prevEl: '.swiper-button-prev1',
        },
    });

      $('.search-form input[name=search]').val(filters.search);
      $('.search-form select[name=order]').val(filters.order);
      $('.search-form select[name=order]').on('change', function() {
        $('.search-form').submit();
      });
  });

  </script>
@endsection
