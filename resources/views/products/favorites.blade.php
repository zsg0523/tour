<style type="text/css">
  .noInfo{line-height: 100px;}
  .noInfo a{color: #f4335e;}
</style>
@extends('layouts.app')
@section('title', '我的收藏')

@section('content')
<div class="row">
    <div class="user_main disflex">
        <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2 mobileMenu">
            @include('layouts._menu')
        </div>
        <div class="col-xs-9 col-sm-9 col-md-10 col-lg-10">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">我的收藏</div>
          <div class="card-body">
            <div class="row products-list">
                @if($products)
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
              @else
                <div class="noInfo">
                  您还没有收藏商品，<a href="{{ url('/') }}">去逛逛></a>
                </div>
                @endif
            </div>
            <div class="float-right">{{ $products->render() }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scriptsAfterJs')
<script>
  $(document).ready(function() {
      $('.menu_list li.menu_list_favor').addClass('active');
    });
</script>
@endsection
