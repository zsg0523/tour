@extends('layouts.app')
@section('title', '订单列表')

@section('content')
<div class="row">
  	<div class="user_main disflex">
        <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2 mobileMenu">
            @include('layouts._menu')
        </div>
        <div class="col-xs-9 col-sm-9 col-md-10 col-lg-10">
	      	<div class="col-lg-12">
	      		<div class="card">
				  	<div class="card-header">{{ __('shop.order.orderList') }}</div>
				  	@if ($orders->count())
				  	<div class="card-body">
					    <ul class="list-group">
					      @foreach($orders as $order)
					        <li class="list-group-item">
					          <div class="card">
					            <div class="card-header">
					              {{ __('shop.order.ordernumber') }}：{{ $order->no }}
					              <span class="float-right">{{ $order->created_at->format('Y-m-d H:i:s') }}</span>
					            </div>
					            <div class="card-body webList">
					              <table class="table">
					                <thead>
					                <tr>
					                  <th>{{ __('shop.order.productinfo') }}</th>
					                  <th class="text-center">{{ __('shop.order.unitprice') }}</th>
					                  <th class="text-center">{{ __('shop.order.quantity') }}</th>
					                  <th class="text-center">{{ __('shop.order.totalprice') }}</th>
					                  <th class="text-center">{{ __('shop.order.status') }}</th>
					                  <th class="text-center">{{ __('shop.order.operat') }}</th>
					                </tr>
					                </thead>
					                @foreach($order->items as $index => $item)
					                  <tr>
					                    <td class="product-info">
					                      <div class="preview">
					                        <a target="_blank" href="{{ route('products.show', [$item->shop_product_id]) }}">
					                          <img src="{{ $item->shopProduct->image_url }}">
					                        </a>
					                      </div>
					                      <div>
					                        <span class="product-title">
					                           <a target="_blank" href="{{ route('products.show', [$item->shop_product_id]) }}">{{ $item->shopProduct->title }}</a>
					                        </span>
					                        <span class="sku-title">{{ $item->shopProductSku->title }}</span>
					                      </div>
					                    </td>
					                    <td class="sku-price text-center">HKD {{ $item->price }}</td>
					                    <td class="sku-amount text-center">{{ $item->amount }}</td>
					                    @if($index === 0)
					                      <td rowspan="{{ count($order->items) }}" class="text-center total-amount">HKD {{ $order->total_amount }}</td>
					                      <td rowspan="{{ count($order->items) }}" class="text-center">
					                        @if($order->paid_at)
					                          @if($order->refund_status === \App\Models\Order::REFUND_STATUS_PENDING)
					                            {{ __('shop.order.paid') }}
					                          @else
					                            {{ \App\Models\Order::$refundStatusMap[$order->refund_status] }}
					                          @endif
					                        @elseif($order->closed)
					                          {{ __('shop.order.close') }}
					                        @else
					                          {{ __('shop.order.unpaid') }}<br>
					                          {{ __('shop.order.please') }} {{ $order->created_at->addSeconds(config('app.order_ttl'))->format('H:i') }} {{ __('shop.order.paybefore') }}<br>
					                          {{ __('shop.order.otherwise') }}
					                        @endif
					                      </td>
					                      <td rowspan="{{ count($order->items) }}" class="text-center">
					                      	<a class="btn btn-primary btn-sm" style="margin-bottom: 8px;" href="{{ route('orders.show', ['order' => $order->id]) }}">{{ __('shop.order.checkorder') }}</a>
					                      	<!-- 评价入口开始 -->
											@if($order->paid_at)
											<a class="btn btn-success btn-sm" style="margin-bottom: 8px;" href="{{ route('orders.review.show', ['order' => $order->id]) }}">
											@if($order->reviewed)
								              	{{ __("shop.order.viewevaluation") }}
								            @else
								                {{ __("shop.order.evaluation") }}
								            @endif

											</a>
											@endif
											<!-- 评价入口结束 -->
					                      </td>
					                    @endif
					                  </tr>
					                @endforeach
					              </table>
					            </div>

					            <div class="card-body mobileList">
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
					                <div class="product-total">
					                    <span rowspan="{{ count($order->items) }}" class="text-center total-amount">{{ __('shop.order.total') }}: HKD {{ $order->total_amount }}</span>
					                    <span rowspan="{{ count($order->items) }}" class="text-center fr"><a class="btn btn-primary btn-sm" href="{{ route('orders.show', ['order' => $order->id]) }}">{{ __('shop.order.checkorder') }}</a></span>
					                    <span rowspan="{{ count($order->items) }}" class="text-center fr">
					                        @if($order->paid_at)
					                          @if($order->refund_status === \App\Models\Order::REFUND_STATUS_PENDING)
					                            {{ __('shop.order.paid') }}
					                          @else
					                            {{ \App\Models\Order::$refundStatusMap[$order->refund_status] }}
					                          @endif
					                        @elseif($order->closed)
					                          {{ __('shop.order.close') }}
					                        @else
					                          {{ __('shop.order.unpaid') }}<br>
					                          {{ __('shop.order.please') }} {{ $order->created_at->addSeconds(config('app.order_ttl'))->format('H:i') }} {{ __('shop.order.paybefore') }}<br>
					                          {{ __('shop.order.otherwise') }}
					                        @endif
					                    </span>
				                    </div>
					            </div>
					          </div>
					        </li>
					      @endforeach
					    </ul>
				    	<div class="float-right">{{ $orders->render() }}</div>
				  	</div>
				  	@else
                    	<div class="nodata">
                    		<div class="cartBtn"><p>{{ __('shop.order.noorder') }}</p><a class="btn btn-primary" href="{{ url('/shop') }}">{{ __('shop.order.goshopp') }}</a></div>
                    	</div>
		            @endif
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