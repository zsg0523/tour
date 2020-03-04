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
				  <div class="card-header">订单列表</div>
				  <div class="card-body">
				    <ul class="list-group">
				      @foreach($orders as $order)
				        <li class="list-group-item">
				          <div class="card">
				            <div class="card-header">
				              订单号：{{ $order->no }}
				              <span class="float-right">{{ $order->created_at->format('Y-m-d H:i:s') }}</span>
				            </div>
				            <div class="card-body webList">
				              <table class="table">
				                <thead>
				                <tr>
				                  <th>商品信息</th>
				                  <th class="text-center">单价</th>
				                  <th class="text-center">数量</th>
				                  <th class="text-center">订单总价</th>
				                  <th class="text-center">状态</th>
				                  <th class="text-center">操作</th>
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
				                    <td class="sku-price text-center">￥{{ $item->price }}</td>
				                    <td class="sku-amount text-center">{{ $item->amount }}</td>
				                    @if($index === 0)
				                      <td rowspan="{{ count($order->items) }}" class="text-center total-amount">￥{{ $order->total_amount }}</td>
				                      <td rowspan="{{ count($order->items) }}" class="text-center">
				                        @if($order->paid_at)
				                          @if($order->refund_status === \App\Models\Order::REFUND_STATUS_PENDING)
				                            已支付
				                          @else
				                            {{ \App\Models\Order::$refundStatusMap[$order->refund_status] }}
				                          @endif
				                        @elseif($order->closed)
				                          已关闭
				                        @else
				                          未支付<br>
				                          请于 {{ $order->created_at->addSeconds(config('app.order_ttl'))->format('H:i') }} 前完成支付<br>
				                          否则订单将自动关闭
				                        @endif
				                      </td>
				                      <td rowspan="{{ count($order->items) }}" class="text-center"><a class="btn btn-primary btn-sm" href="{{ route('orders.show', ['order' => $order->id]) }}">查看订单</a></td>
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
						                    <span class="sku-price text-right">￥{{ $item->price }}</span>
						                    <span class="sku-amount text-right">x {{ $item->amount }}</span>
					                    </div>
				                  	</div>
				                @endforeach
				                <div class="product-total">
				                    <span rowspan="{{ count($order->items) }}" class="text-center total-amount">总价: ￥{{ $order->total_amount }}</span>
				                    <span rowspan="{{ count($order->items) }}" class="text-center fr"><a class="btn btn-primary btn-sm" href="{{ route('orders.show', ['order' => $order->id]) }}">查看订单</a></span>
				                    <span rowspan="{{ count($order->items) }}" class="text-center fr">
				                        @if($order->paid_at)
				                          @if($order->refund_status === \App\Models\Order::REFUND_STATUS_PENDING)
				                            已支付
				                          @else
				                            {{ \App\Models\Order::$refundStatusMap[$order->refund_status] }}
				                          @endif
				                        @elseif($order->closed)
				                          已关闭
				                        @else
				                          未支付<br>
				                          请于 {{ $order->created_at->addSeconds(config('app.order_ttl'))->format('H:i') }} 前完成支付<br>
				                          否则订单将自动关闭
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