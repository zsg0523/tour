<style type="text/css">
  .navbar-static-top{margin-bottom: 0 !important;}
  .row{margin-top: 20px;}
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

        <!-- 移动端商品布局 -->

      </div>
    </form>
    <!-- 筛选组件结束 -->
    <div class="row products-list">
    @if ($products->count())
      @foreach($products as $product)
        <div class="col-3 product-item">
          <div class="product-content">
            <div class="top">
              <div class="img">
                <a href="{{ route('products.show', ['product' => $product->id]) }}">
                  <img src="{{ $product->image_url }}" alt="">
                </a>
              </div>
              <div class="price"><b>HKD </b>{{ $product->price }}</div>
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
    @else
    	<div class="nodata">
    		<div style="background-color: #fff;margin-bottom:20px;">没有找到相关的宝贝</div>
    	</div>
    @endif
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
        $('.img').height($('.img').width()*5/6);

        $('.search-form input[name=search]').val(filters.search);
        $('.search-form select[name=order]').val(filters.order);
        $('.search-form select[name=order]').on('change', function() {
            $('.search-form').submit();
        });
  });

  </script>
@endsection
