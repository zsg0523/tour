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
          <div class="card-header">{{ __('shop.info.collect') }}</div>
          <div class="card-body">
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
	                        <div class="price"><b>HKB</b>{{ $product->price }}</div>
	                        <div class="title">
	                          <a href="{{ route('products.show', ['product' => $product->id]) }}">{{ $product->title }}</a>
	                        </div>
	                      </div>
	                      <div class="bottom">
	                        <div class="sold_count">{{ __('shop.product.sales') }} <span>{{ $product->sold_count }}</span></div>
	                        <div class="review_count">{{ __('shop.product.evaluation') }} <span>{{ $product->review_count }}</span></div>
	                      </div>
	                    </div>
	                  </div>
	                @endforeach
                @else
                	<div class="nodata">
                		<div class="cartBtn">{{ __('shop.cart.nocollect') }}<a href="{{ url('/shop') }}">{{ __('shop.cart.goshopp') }}</a></div>
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
		$('.img').height($('.img').width()*5/6);
    });
</script>
@endsection
