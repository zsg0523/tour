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
		            <div class="card-header">{{ __('shop.order.orderdetail') }}</div>
		            <div class="card-body webList">
		              	<table class="table">
		                	<thead>
				                <tr>
									<th>{{ __('shop.order.productinfo') }}</th>
									<th class="text-center">{{ __('shop.order.unitprice') }}</th>
									<th class="text-center">{{ __('shop.order.quantity') }}</th>
									<th class="text-right item-amount">{{ __('shop.order.subtotal') }}</th>
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
			                    <td class="sku-price text-center vertical-middle">HKD {{ $item->price }}</td>
			                    <td class="sku-amount text-center vertical-middle">{{ $item->amount }}</td>
			                    <td class="item-amount text-right vertical-middle">HKD {{ number_format($item->price * $item->amount, 2, '.', '') }}</td>
			                </tr>
			                @endforeach
		                	<tr><td colspan="4"></td></tr>
		              	</table>
		              	<div class="order-bottom">
					      	<div class="order-info">
						        <div class="line"><div class="line-label">{{ __('shop.order.shippaddress') }}：</div><div class="line-value">{{ join(' ', $order->address) }}</div></div>
						        <div class="line"><div class="line-label">{{ __('shop.order.ordernote') }}：</div><div class="line-value">{{ $order->remark ?: '-' }}</div></div>
						        <div class="line"><div class="line-label">{{ __('shop.order.orderno') }}：</div><div class="line-value">{{ $order->no }}</div></div>
						         <!-- 输出物流状态 -->
						        <div class="line">
						          <div class="line-label">{{ __('shop.order.logstatus') }}：</div>
						          <div class="line-value">{{ \App\Models\Order::$shipStatusMap[$order->ship_status] }}</div>
						        </div>
						        <!-- 如果有物流信息则展示 -->
						        @if($order->ship_data)
						        <div class="line">
						          <div class="line-label">{{ __('shop.order.information') }}：</div>
						          <div class="line-value">{{ $order->ship_data['express_company'] }} {{ $order->ship_data['express_no'] }}</div>
						        </div>
						        <div class="line">
						          	<div class="line-label">{{ __('shop.order.details') }}：</div>
							        <div class="line-value">{{ $order->ship_data['express_info'] }}</div>
							    </div>
						        @endif
					      	</div>
					      	<div class="order-summary text-right">
						        <div class="total-amount">
									<span>{{ __('shop.order.totalprice') }}：</span>
									<div class="value">HKD {{ $order->total_amount }}</div>
						        </div>
					        	<div>
					          		<span>{{ __('shop.order.orderstatus') }}：</span>
					          		<div class="value">
							            @if($order->paid_at)
							              @if($order->refund_status === \App\Models\Order::REFUND_STATUS_PENDING)
							                {{ __('shop.order.paid') }}
							              @else
							                {{ \App\Models\Order::$refundStatusMap[$order->refund_status] }}
							              @endif
							            @elseif($order->closed)
							              {{ __('shop.order.close') }}
							            @else
							              {{ __('shop.order.unpaid') }}
							            @endif
					          		</div>
					        	</div>
					        	<!-- 支付按钮开始 -->
						        @if(!$order->paid_at && !$order->closed)
						          <div class="payment-buttons">
						            <a class="btn btn-primary btn-sm" href="{{ route('payment.alipay', ['order' => $order->id]) }}">{{ __('shop.order.aliPay') }}</a>
						            <!-- 把之前的微信支付按钮换成这个 -->
						            <a class="btn btn-sm btn-success" href="{{ route('payment.paypal', ['order' => $order->id]) }}">{{ __('shop.order.payPal') }}</a>
						          </div>
						        @endif
						        <!-- 支付按钮结束 -->
						        <!-- 如果订单的发货状态为已发货则展示确认收货按钮 -->
						        @if($order->ship_status === \App\Models\Order::SHIP_STATUS_DELIVERED)
						        <div class="receive-button">
						          <!-- 将原本的表单替换成下面这个按钮 -->
  								  <button type="button" id="btn-receive" class="btn btn-sm btn-success">{{ __('shop.order.conformreceipt') }}</button>
						        </div>
						        @endif
					      	</div>
					    </div>
		            </div>

		            <div class="card-body mobileList">
		                <div class="order-summary">
		                	<div class="total-amount">
				          		<span>{{ __('shop.order.orderstatus') }}：</span>
				          		<div class="value">
						            @if($order->paid_at)
						              @if($order->refund_status === \App\Models\Order::REFUND_STATUS_PENDING)
						                {{ __('shop.order.paid') }}
						              @else
						                {{ \App\Models\Order::$refundStatusMap[$order->refund_status] }}
						              @endif
						            @elseif($order->closed)
						              {{ __('shop.order.close') }}
						            @else
						              {{ __('shop.order.unpaid') }}
						            @endif
				          		</div>
				        	</div>
		                	<div class="total-amount">
								<span>{{ __('shop.order.ordernumber') }}：</span>
								<div class="value">{{ $order->no }}</div>
					        </div>
					        <div class="total-amount">
								<span>{{ __('shop.order.orderamount') }}：</span>
								<div class="value">HKD {{ $order->total_amount }}</div>
					        </div>
				      	</div>
				      	<div class="order-address">
				      		<span class="line-label">{{ __('shop.order.receiver') }}：</span>
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
					                    <span class="sku-price text-right">HKD {{ $item->price }}</span>
					                    <span class="sku-amount text-right">x {{ $item->amount }}</span>
				                    </div>
			                  	</div>
			                @endforeach
				      	</div>	
		              	<div class="order-bottom">
				        	<span class="line-label">{{ __('shop.order.ordernote') }}：</span>
				        	<span class="line-value">{{ $order->remark ?: '-' }}</span>
					    </div>
					    <div class="order-amount">
				        	<span class="line-label dpn">共1件商品</span>
				        	<span class="line-value">{{ __('shop.order.actualpay') }}:HKD {{ $order->total_amount }}</span>
					    </div>
					    <div class="order-time">
				        	<span class="line-label">{{ __('shop.order.time') }}：</span>
				        	<span class="line-value">{{ $order->created_at->format('Y-m-d H:i:s') }}</span>
					    </div>
					    <!-- 支付按钮开始 -->
				        @if(!$order->paid_at && !$order->closed)
				          <div class="payment-buttons">
				            <a class="btn btn-primary btn-sm" href="{{ route('payment.alipay', ['order' => $order->id]) }}">{{ __('shop.order.aliPay') }}</a>
				            <!-- 把之前的微信支付按钮换成这个 -->
				            <a class="btn btn-sm btn-success" href="{{ route('payment.paypal', ['order' => $order->id]) }}">{{ __('shop.order.payPal') }}</a>
				          </div>
				        @endif
				        <!-- 支付按钮结束 -->
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
    // 确认收货按钮点击事件
    $('#btn-receive').click(function() {
      // 弹出确认框
      swal({
        title: "{{ __('shop.order.tip') }}",
        icon: "warning",
        dangerMode: true,
        buttons: ["{{ __('shop.order.cancel') }}", "{{ __('shop.order.conform') }}"],
      })
      .then(function(ret) {
        // 如果点击取消按钮则不做任何操作
        if (!ret) {
          return;
        }
        // ajax 提交确认操作
        axios.post("{{ route('orders.received', [$order->id]) }}")
          .then(function () {
            // 刷新页面
            location.reload();
          })
      });
    });
</script>
@endsection
