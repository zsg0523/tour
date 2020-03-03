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
		            <div class="card-header">订单详情</div>
		            <div class="card-body webList">
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
					        	<!-- 支付按钮开始 -->
						        @if(!$order->paid_at && !$order->closed)
						          <div class="payment-buttons">
						            <a class="btn btn-primary btn-sm" href="{{ route('payment.alipay', ['order' => $order->id]) }}">支付宝支付</a>
						            <!-- 把之前的微信支付按钮换成这个 -->
						            <button class="btn btn-sm btn-success" id='btn-wechat'>微信支付</button>
						          </div>
						        @endif
						        <!-- 支付按钮结束 -->
					      	</div>
					    </div>
		            </div>

		            <div class="card-body mobileList">
		                <div class="order-summary">
		                	<div class="total-amount">
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
		                	<div class="total-amount">
								<span>订单号：</span>
								<div class="value">{{ $order->no }}</div>
					        </div>
					        <div class="total-amount">
								<span>订单金额：</span>
								<div class="value">￥{{ $order->total_amount }}</div>
					        </div>
				      	</div>
				      	<div class="order-address">
				      		<span class="line-label">收货人：</span>
				      		<span class="line-value">{{ join(' ', $order->address) }}</span>				      		
				      	</div>
				      	<div class="order-list">
			                @foreach($order->items as $index => $item)
			                	<div class="product-list">
				                    <div class="product-info">
				                      	<div class="preview">
				                        	<a target="_blank" href="{{ route('products.show', [$item->shop_product_id]) }}">
				                          		<img src="{{ $item->shopProduct->image_url }}">
				                        	</a>
				                      	</div>
				                      	<div class="product-name">
				                        	<span class="product-title">
				                           		<a target="_blank" href="{{ route('products.show', [$item->shop_product_id]) }}">{{ $item->shopProduct->title }}</a>
				                        	</span>
				                        	<span class="sku-title">{{ $item->shopProductSku->title }}</span>
				                      	</div>
				                    </div>
				                    <div class="product-price">
					                    <span class="sku-price text-right">￥{{ $item->price }}</span>
					                    <span class="sku-amount text-right">x {{ $item->amount }}</span>
				                    </div>
			                  	</div>
			                @endforeach
				      	</div>	
		              	<div class="order-bottom">
				        	<span class="line-label">订单备注：</span>
				        	<span class="line-value">{{ $order->remark ?: '-' }}</span>
					    </div>
					    <div class="order-amount">
				        	<span class="line-label">共7件商品</span>
				        	<span class="line-value">实际付款:￥{{ $order->total_amount }}</span>
					    </div>
					    <div class="order-time">
				        	<span class="line-label">成交时间：</span>
				        	<span class="line-value">2020-02-03</span>
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
