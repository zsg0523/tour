@extends('layouts.app')
@section('title', $product->title)

@section('content')
<div class="row">
<div class="col-lg-10 offset-lg-1">
<div class="card">
  <div class="card-body product-info">
    <div class="row">
      <div class="col-5">
        <img class="cover" src="{{ $product->image_url }}" alt="">
      </div>
      <div class="col-7">
        <div class="title">{{ $product->title }}</div>
        <div class="price"><label>{{ __('shop.product.price') }}</label><em>HKD </em><span>{{ $product->price }}</span></div>
        <div class="sales_and_reviews">
          <div class="sold_count">{{ __('shop.product.cumulativesale') }} <span class="count">{{ $product->sold_count }}</span></div>
          <div class="review_count">{{ __('shop.product.cumulativeevaluation') }} <span class="count">{{ $product->review_count }}</span></div>
          <div class="rating" title="{{ __('shop.product.score') }} {{ $product->rating }}">{{ __('shop.product.score') }} <span class="count">{{ str_repeat('★', floor($product->rating)) }}{{ str_repeat('☆', 5 - floor($product->rating)) }}</span></div>
        </div>
        <div class="skus">
          <label>{{ __('shop.product.select') }}</label>
          <div class="btn-group btn-group-toggle" data-toggle="buttons">
            @foreach($product->skus as $sku)
              <label 
              class="btn sku-btn"
              data-price="{{ $sku->price }}"
              data-stock="{{ $sku->stock }}"
              data-toggle="tooltip" title="{{ $sku->description }}" data-placement="bottom">
                <input type="radio" name="skus" autocomplete="off" value="{{ $sku->id }}"> {{ $sku->title }}
              </label>
            @endforeach
          </div>
        </div>
        <div class="cart_amount"><label>{{ __('shop.product.select') }}</label><input type="text" class="form-control form-control-sm" value="1"><span>{{ __('shop.product.pieces') }}</span><span class="stock"></span></div>
        <div class="buttons">
          @if($favored)
            <button class="btn btn-danger btn-disfavor">{{ __('shop.product.cancelcollect') }}</button>
          @else
            <button class="btn btn-success btn-favor">{{ __('shop.product.favorite') }}</button>
          @endif
          <button class="btn btn-primary btn-add-to-cart">{{ __('shop.product.addcart') }}</button>
        </div>
      </div>
    </div>
    <div class="product-detail">
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" href="#product-detail-tab" aria-controls="product-detail-tab" role="tab" data-toggle="tab" aria-selected="true">{{ __('shop.product.productdetail') }}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#product-reviews-tab" aria-controls="product-reviews-tab" role="tab" data-toggle="tab" aria-selected="false">{{ __('shop.product.userevaluation') }} ({{$reviews->count()}})</a>
        </li>
      </ul>
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="product-detail-tab">
          {!! $product->description !!}
        </div>
        <div role="tabpanel" class="tab-pane" id="product-reviews-tab">
        	@if($reviews->count()==0)
	           {{ __('shop.product.nocomment') }}
	        @else
	        	<!-- 评论列表开始 -->
	          <table class="table table-bordered table-striped">
	            <thead>
	            <tr>
	              <td>{{ __('shop.product.user') }}</td>
	              <td>{{ __('shop.product.product') }}</td>
	              <td>{{ __('shop.product.score') }}</td>
	              <td>{{ __('shop.product.evaluation') }}</td>
	              <td>{{ __('shop.product.time') }}</td>
	            </tr>
	            </thead>
	            <tbody>
	              @foreach($reviews as $review)
	              <tr>
	                <td>{{ $review->order->user->name }}</td>
	                <td>{{ $review->shopProductSku->title }}</td>
	                <td>{{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}</td>
	                <td>{{ $review->review }}</td>
	                <td>{{ $review->reviewed_at->format('Y-m-d H:i') }}</td>
	              </tr>
	              @endforeach
	            </tbody>
	          </table>
	          <!-- 评论列表结束 -->
	        @endif
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
@endsection
@section('scriptsAfterJs')
<script>
  $(document).ready(function () {
    // 默认选中第一个规格
    setTimeout(function(){
	    $('.btn-group .sku-btn:first').addClass('active');
	    $('.product-info .price span').text($('.sku-btn').data('price'));
	    $('.product-info .stock').text('库存：' + $('.sku-btn').data('stock') + '件');
    },600);

    $('[data-toggle="tooltip"]').tooltip({trigger: 'hover'});
    $('.sku-btn').click(function () {
      $('.product-info .price span').text($(this).data('price'));
      $('.product-info .stock').text('库存：' + $(this).data('stock') + '件');
    });

    $('.btn-favor').click(function () {
      axios.post('{{ route('products.favor', ['product' => $product->id]) }}')
        .then(function () {
          swal("{{ __('shop.product.successOperat') }}", '', 'success')
          .then(function () {  // 这里加了一个 then() 方法
              location.reload();
            });
        }, function(error) {
          if (error.response && error.response.status === 401) {
            swal("{{ __('shop.page.login') }}", '', 'error');
          }  else if (error.response && error.response.data.msg) {
            swal(error.response.data.msg, '', 'error');
          }  else {
            swal("{{ __('shop.cart.systemerror') }}", '', 'error');
          }
        });
    });

    $('.btn-disfavor').click(function () {
      axios.delete("{{ route('products.disfavor', ['product' => $product->id]) }}")
        .then(function () {
          swal("{{ __('shop.product.successOperat') }}", '', 'success')
            .then(function () {
              location.reload();
            });
        });
    });

    // 加入购物车按钮点击事件
    $('.btn-add-to-cart').click(function () {

      // 请求加入购物车接口
      axios.post("{{ route('cart.add') }}", {
        sku_id: $('label.active input[name=skus]').val(),
        amount: $('.cart_amount input').val(),
      })
        .then(function () { // 请求成功执行此回调
          swal('{{ __("shop.product.addsuccess") }}', '', 'success')
            .then(function() {
            location.href = '{{ route('cart.index') }}';
          });
        }, function (error) { // 请求失败执行此回调
          if (error.response.status === 401) {

            // http 状态码为 401 代表用户未登陆
            swal("{{ __('shop.page.login') }}", '', 'error');

          } else if (error.response.status === 422) {

            // http 状态码为 422 代表用户输入校验失败 请选择商品
            var html = '<div>';
            _.each(error.response.data.errors, function (errors) {
              _.each(errors, function (error) {
                // html += error+'<br>';
                html += '{{ __("shop.product.selectproduct") }}<br>';
              })
            });
            html += '</div>';
            swal({content: $(html)[0], icon: 'error'})
          } else {

            // 其他情况应该是系统挂了
            swal("{{ __('shop.cart.systemerror') }}", '', 'error');
          }
        })
    });

    
  });
</script>
@endsection
