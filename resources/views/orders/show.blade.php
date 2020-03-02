@extends('layouts.app')
@section('title', '查看订单')

@section('content')
<div class="row">
	<div class="user_main disflex">
	    <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2 mobileMenu">
	        @include('layouts._menu')
	    </div>
	    <div class="col-xs-9 col-sm-9 col-md-10 col-lg-10">
	      	<div class="col-lg-12"><!-- offset-lg-1 -->
	          	<div class="card">
		            <div class="card-header">
		              	<h4>订单详情</h4>
		            </div>
		            <div class="card-body">
		              	<table class="table">
		                	<thead>
				                <tr>
									<th>商品信息</th>
									<th class="text-center">单价</th>
									<th class="text-center">数量</th>
									<th class="text-right item-amount">小计</th>
				                </tr>
		                	</thead>
			                @foreach($order->items as $index => $item)
			                <tr>
			                    <td class="product-info">
			                      <div class="preview">
			                        <a target="_blank" href="{{ route('products.show', [$item->product_id]) }}">
			                          <img src="{{ $item->shopProduct->image_url }}">
			                        </a>
			                      </div>
			                      <div>
			                        <span class="product-title">
			                           <a target="_blank" href="{{ route('products.show', [$item->product_id]) }}">{{ $item->shopProduct->title }}</a>
			                        </span>
			                        <span class="sku-title">{{ $item->shopProductSku->title }}</span>
			                      </div>
			                    </td>
			                    <td class="sku-price text-center vertical-middle">￥{{ $item->price }}</td>
			                    <td class="sku-amount text-center vertical-middle">{{ $item->amount }}</td>
			                    <td class="item-amount text-right vertical-middle">￥{{ number_format($item->price * $item->amount, 2, '.', '') }}</td>
			                </tr>
			                @endforeach
		                	<tr><td colspan="4"></td></tr>
		              	</table>
		              	<div class="order-bottom">
					      	<div class="order-info">
						        <div class="line"><div class="line-label">收货地址：</div><div class="line-value">{{ join(' ', $order->address) }}</div></div>
						        <div class="line"><div class="line-label">订单备注：</div><div class="line-value">{{ $order->remark ?: '-' }}</div></div>
						        <div class="line"><div class="line-label">订单编号：</div><div class="line-value">{{ $order->no }}</div></div>
					      	</div>
					      	<div class="order-summary text-right">
						        <div class="total-amount">
									<span>订单总价：</span>
									<div class="value">￥{{ $order->total_amount }}</div>
						        </div>
					        	<div>
					          		<span>订单状态：</span>
					          		<div class="value">
							            @if($order->paid_at)
							              @if($order->refund_status === \App\Models\Order::REFUND_STATUS_PENDING)
							                已支付
							              @else
							                {{ \App\Models\Order::$refundStatusMap[$order->refund_status] }}
							              @endif
							            @elseif($order->closed)
							              已关闭
							            @else
							              未支付
							            @endif
					          		</div>
					        	</div>
					      	</div>
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
  	$(document).ready(function() {
      	$('.menu_list li.menu_list_order').addClass('active');
    });
</script>
@endsection
