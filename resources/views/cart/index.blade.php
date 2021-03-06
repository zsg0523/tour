@extends('layouts.app')
@section('title', '购物车')

@section('content')
<div class="row">
	<div class="col-lg-10 offset-lg-1">
		<div class="card">
		  	<div class="card-header">{{ __('shop.cart.shoppingcart') }}</div>
			<div class="card-body">
				@if ($cartItems->count())
			    <table class="table table-striped">
			      	<thead>
				      	<tr>
					        <th><input type="checkbox" checked id="select-all"></th>
					        <th class="webth">{{ __('shop.order.productinfo') }}</th>
					        <th class="webth">{{ __('shop.order.unitprice') }}</th>
					        <th class="webth">{{ __('shop.order.quantity') }}</th>
					        <th class="webth">{{ __('shop.order.operat') }}</th>
					        <th class="mobileth">{{ __('shop.cart.selectall') }}</th>
					        <th class="mobileth" style="text-align: right;" onclick="editShow(this)">{{ __('shop.cart.edit') }}</th>
				      	</tr>
			      	</thead>
			      	<tbody class="product_list">
			     	@foreach($cartItems as $item)
				        <tr data-id="{{ $item->shopProductSku->id }}" data-price="{{ $item->shopProductSku->price }}">
				          	<td>
				            	<input type="checkbox" name="select" value="{{ $item->shopProductSku->id }}" {{ $item->shopProductSku->shopProduct->on_sale ? 'checked' : 'disabled' }}>
				          	</td>
				          	<td class="product_info">
					            <div class="preview">
					              	<a target="_blank" href="{{ route('products.show', [$item->shopProductSku->product_id]) }}">
					                	<img src="{{ $item->shopProductSku->shopProduct->image_url }}">
					              	</a>
					            </div>
					            <div class="product_name" @if(!$item->shopProductSku->shopProduct->on_sale) class="not_on_sale" @endif>
					              <span class="product_title">
					                <a target="_blank" href="{{ route('products.show', [$item->shopProductSku->shop_product_id]) }}">{{ $item->shopProductSku->shopProduct->title }}</a>
					              </span>
					              <span class="sku_title">{{ $item->shopProductSku->title }}</span>
					              @if(!$item->shopProductSku->shopProduct->on_sale)
					                <span class="warning">{{ __('shop.cart.productremove') }}</span>
					              @endif
					            </div>
					            <input type="text" class="form-control form-control-sm amount mobileInput" onblur="amount_input(this,0);" @if(!$item->shopProductSku->shopProduct->on_sale) disabled @endif name="mobileInput" value="{{ $item->amount }}">
				          	</td>
				          	<td class="price_info">
					            <span class="price">HKD {{ $item->shopProductSku->price }}</span>
					            <div class="price mobileth">x <span class="editAmount">{{ $item->amount }}</span></div>
				          	</td>
				          	<td class="webth">
				            	<input type="text" class="form-control form-control-sm amount webInput" onblur="amount_input(this,1);" @if(!$item->shopProductSku->shopProduct->on_sale) disabled @endif name="webInput" value="{{ $item->amount }}">
				          	</td>
				          	<td class="webth removeBtn">
				            	<button class="btn btn-sm btn-danger btn-remove">{{ __('shop.cart.remove') }}</button>
				          	</td>
				        </tr>
			      	@endforeach
			      	</tbody>
			    </table>
			    <!-- 开始 -->
			    <div>
			      	<form class="form-horizontal" role="form" id="order-form">
				        <div class="form-group row">
				          	<label class="col-form-label col-sm-3 text-md-right">{{ __('shop.cart.selectaddress') }}</label>
				          	<div class="col-sm-9 col-md-7">
				            	<select class="form-control" name="address">
				              	@foreach($addresses as $address)
				                	<option value="{{ $address->id }}">{{ $address->full_address }} {{ $address->contact_name }} {{ $address->contact_phone }}</option>
				              	@endforeach
				            	</select>
				          	</div>
				        </div>
				        <div class="form-group row">
				          	<label class="col-form-label col-sm-3 text-md-right">{{ __('shop.cart.note') }}</label>
				          	<div class="col-sm-9 col-md-7">
				            	<textarea name="remark" class="form-control" rows="3"></textarea>
				          	</div>
				        </div>
				        <div class="form-group submitBtn">
				          	<div class="offset-sm-3 col-sm-9 col-md-7">
				          		<p>{{ __('shop.cart.total') }}：HKD <span id="orderSum"></span></p>
				            	<button type="button" class="btn btn-primary btn-create-order">{{ __('shop.cart.submitorder') }}</button>
				            	<a class="btn btn-primary" href="{{ url('/shop') }}">{{ __('shop.cart.goshopp') }}</a>
				          	</div>
				        </div>
			     	</form>
			    </div>
			    <!-- 结束 -->
			    @else
                	<div class="nodata">
                		<div class="cartBtn"><p class="tip">{{ __('shop.cart.carthungry') }}</p><p>{{ __('shop.cart.tip') }}</p><a class="btn btn-primary" href="{{ url('/shop') }}">{{ __('shop.cart.goshopp') }}</a></div>
                	</div>
	            @endif
			</div>
		</div>
	</div>
</div>
@endsection

@section('scriptsAfterJs')
<script>
  	$(document).ready(function () {
  		setOrderNum();
    	// 监听 移除 按钮的点击事件
    	$('.btn-remove').click(function () {
			// $(this) 可以获取到当前点击的 移除 按钮的 jQuery 对象
			// closest() 方法可以获取到匹配选择器的第一个祖先元素，在这里就是当前点击的 移除 按钮之上的 <tr> 标签
			// data('id') 方法可以获取到我们之前设置的 data-id 属性的值，也就是对应的 SKU id
			var id = $(this).closest('tr').data('id');
			swal({
				title: "{{ __('shop.cart.sureremove') }}",
				icon: "warning",
				buttons: ['{{ __("shop.cart.cancel") }}', '{{ __("shop.cart.determine") }}'],
				dangerMode: true,
			})
      		.then(function(willDelete) {
        		// 用户点击 确定 按钮，willDelete 的值就会是 true，否则为 false
        		if (!willDelete) {
          			return;
        		}
        		axios.delete('/cart/' + id)
	          	.then(function () {
	            	location.reload();
	            	setOrderNum();
	          	})
	      	});
	    });

    	// 监听 全选/取消全选 单选框的变更事件
    	$('#select-all').change(function() {
			// 获取单选框的选中状态
			// prop() 方法可以知道标签中是否包含某个属性，当单选框被勾选时，对应的标签就会新增一个 checked 的属性
			var checked = $(this).prop('checked');
			// 获取所有 name=select 并且不带有 disabled 属性的勾选框
			// 对于已经下架的商品我们不希望对应的勾选框会被选中，因此我们需要加上 :not([disabled]) 这个条件
			$('input[name=select][type=checkbox]:not([disabled])').each(function() {
        	// 将其勾选状态设为与目标单选框一致
        		$(this).prop('checked', checked);
      		});
      		setOrderNum();
    	});

    	// 监听 单选框的变更事件
		$('input[name=select][type=checkbox]:not([disabled])').click(function() {
    		setOrderNum();
  		});

    	// 监听创建订单按钮的点击事件
    	$('.btn-create-order').click(function () {
      		// 构建请求参数，将用户选择的地址的 id 和备注内容写入请求参数
      		var req = {
		        address_id: $('#order-form').find('select[name=address]').val(),
		        items: [],
		        remark: $('#order-form').find('textarea[name=remark]').val(),
      		};
      		// 遍历 <table> 标签内所有带有 data-id 属性的 <tr> 标签，也就是每一个购物车中的商品 SKU
      		$('table tr[data-id]').each(function () {
		        // 获取当前行的单选框
		        var $checkbox = $(this).find('input[name=select][type=checkbox]');
		        // 如果单选框被禁用或者没有被选中则跳过
		        if ($checkbox.prop('disabled') || !$checkbox.prop('checked')) {
		          	return;
		        }
		        if($('.mobileth').css('display') == 'none') {
		        	// 获取当前行中数量输入框
		        	var $input = $(this).find('input[name=webInput]');
		        }else{
		        	// 获取当前行中数量输入框
		        	var $input = $(this).find('input[name=mobileInput]');
		        }
		        // 如果用户将数量设为 0 或者不是一个数字，则也跳过
		        if ($input.val() == 0 || isNaN($input.val())) {
		          	return;
		        }
		        // 把 SKU id 和数量存入请求参数数组中
		        req.items.push({
		          	sku_id: $(this).data('id'),
		          	amount: $input.val(),
		        })
      		});
      		axios.post('{{ route('orders.store') }}', req)
        	.then(function (response) {
          		swal('{{ __("shop.cart.submitsuccess") }}', '', 'success')
          		.then(() => {
            		location.href = '/orders/' + response.data.id;
          		});
        	}, function (error) {
          		if (error.response.status === 422) {
            		// http 状态码为 422 代表用户输入校验失败
            		var html = '<div>';
            		_.each(error.response.data.errors, function (errors) {
	              		_.each(errors, function (error) {
	              			// 收货地址不能为空
	                		html += '{{ __("shop.cart.noaddress") }}<br>';
	                		// html += error+'<br>';
	              		})
	            	});
		            html += '</div>';
		            swal({content: $(html)[0], icon: 'error'})
		            .then(() => {
	            		location.href = '/user_addresses/';
	          		});
          		} else {
            		// 其他情况应该是系统挂了
            		swal('{{ __("shop.cart.systemerror") }}', '', 'error');
          		}
        	});
    	});
  	});
  	function editShow(obj){
	  	if($('.product_name').hasClass('dpn')){
	  		$(obj).text('{{ __("shop.cart.edit") }}');
		  	$('.removeBtn').css('display','none');
		  	$('.price_info').css('display','table-cell');
		  	$('.mobileInput').css('display','none');
		  	$('.product_name').removeClass('dpn');
	  		$('table tr[data-id]').each(function () {
		        // 获取当前行中数量输入框
		        var $input = $(this).find('input[name=mobileInput]');
		        console.log($input.val());
		        // 如果用户将数量设为 0 或者不是一个数字，则也跳过
		        if ($input.val() == 0 || isNaN($input.val())) {
		          	return;
		        }else{
		        	$(this).find('.editAmount').text($input.val());
		        }
	  		});

	  	}else{
	  		$(obj).text('{{ __("shop.cart.complete") }}');
	  		$('.removeBtn').css('display','table-cell');
		  	$('.price_info').css('display','none');
		  	$('.mobileInput').css('display','block');
		  	$('.product_name').addClass('dpn');
	  	}
 	}
	//手动修改文本框商品数量与库存的限制
	function amount_input(tag,status){
		var amount=parseInt($(tag).val());
		if(isNaN(amount)){
			// layer.msg('最少购买量为1');
			$(tag).val(1);
		}else{
			if(amount<1){
				// layer.msg('最少购买量为1');
				$(tag).val(1);
			}
		}
		// var val=parseFloat(sellprice)*parseInt($(tag).val());
		setOrderNum(status);
	}
 	function setOrderNum(status){
 		//获取订单总价
  		var orderSum=[],num = 0;
  		// 遍历 <table> 标签内所有带有 data-id 属性的 <tr> 标签，也就是每一个购物车中的商品 SKU
  		$('table tr[data-id]').each(function () {
	        // 获取当前行的单选框
	        var $checkbox = $(this).find('input[name=select][type=checkbox]');
	        // 如果单选框被禁用或者没有被选中则跳过
	        if ($checkbox.prop('disabled') || !$checkbox.prop('checked')) {
	          	return;
	        }
	        // 获取当前行中数量输入框
	        if(status==0){
	        	var $input = $(this).find('input[name=mobileInput]');
	        }else {
	        	var $input = $(this).find('input[name=webInput]');
	        }
	        console.log($input.val());
	        // 如果用户将数量设为 0 或者不是一个数字，则也跳过
	        if ($input.val() == 0 || isNaN($input.val())) {
	          	return;
	        }
	        // 把单价和数量存入请求参数数组中
	        orderSum.push({
	          	price: $(this).data('price'),
	          	amount: $input.val(),
	        })
	        num+=$(this).data('price')*$input.val();
  		});
  		num = Number(num).toFixed(2);
  		console.log(orderSum);
  		$('#orderSum').text(num);
 	}
</script>
@endsection