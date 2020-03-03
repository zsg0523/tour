@extends('layouts.app')
@section('title', '购物车')

@section('content')
<div class="row">
	<div class="col-lg-10 offset-lg-1">
		<div class="card">
		  	<div class="card-header">我的购物车</div>
			<div class="card-body">
			    <table class="table table-striped">
			      	<thead>
				      	<tr>
					        <th><input type="checkbox" checked id="select-all"></th>
					        <th class="webth">商品信息</th>
					        <th class="webth">单价</th>
					        <th class="webth">数量</th>
					        <th class="webth">操作</th>
					        <th class="mobileth">全选</th>
					        <th class="mobileth" style="text-align: right;" onclick="editShow()">编辑</th>
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
					                <span class="warning">该商品已下架</span>
					              @endif
					            </div>
					            <input type="text" class="form-control form-control-sm amount mobileInput" @if(!$item->shopProductSku->shopProduct->on_sale) disabled @endif name="amount" value="{{ $item->amount }}">
				          	</td>
				          	<td class="price_info">
					            <span class="price">￥{{ $item->shopProductSku->price }}</span>
					            <div class="price mobileth">x {{ $item->amount }}</div>
				          	</td>
				          	<td class="webth">
				            	<input type="text" class="form-control form-control-sm amount" @if(!$item->shopProductSku->shopProduct->on_sale) disabled @endif name="amount" value="{{ $item->amount }}">
				          	</td>
				          	<td class="webth removeBtn">
				            	<button class="btn btn-sm btn-danger btn-remove">移除</button>
				          	</td>
				        </tr>
			      	@endforeach
			      	</tbody>
			    </table>
			    <!-- 开始 -->
			    <div>
			      	<form class="form-horizontal" role="form" id="order-form">
				        <div class="form-group row">
				          	<label class="col-form-label col-sm-3 text-md-right">选择收货地址</label>
				          	<div class="col-sm-9 col-md-7">
				            	<select class="form-control" name="address">
				              	@foreach($addresses as $address)
				                	<option value="{{ $address->id }}">{{ $address->full_address }} {{ $address->contact_name }} {{ $address->contact_phone }}</option>
				              	@endforeach
				            	</select>
				          	</div>
				        </div>
				        <div class="form-group row">
				          	<label class="col-form-label col-sm-3 text-md-right">备注</label>
				          	<div class="col-sm-9 col-md-7">
				            	<textarea name="remark" class="form-control" rows="3"></textarea>
				          	</div>
				        </div>
				        <div class="form-group submitBtn">
				          	<div class="offset-sm-3 col-sm-9 col-md-7">
				          		<p>合计：￥<span id="orderSum">300</span></p>
				            	<button type="button" class="btn btn-primary btn-create-order">提交订单</button>
				          	</div>
				        </div>
			     	</form>
			    </div>
			    <!-- 结束 -->
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
				title: "确认要将该商品移除？",
				icon: "warning",
				buttons: ['取消', '确定'],
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
		        // 获取当前行中数量输入框
		        var $input = $(this).find('input[name=amount]');
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
          		swal('订单提交成功', '', 'success')
          		.then(() => {
            		location.href = '/orders/' + response.data.id;
          		});
        	}, function (error) {
          		if (error.response.status === 422) {
            		// http 状态码为 422 代表用户输入校验失败
            		var html = '<div>';
            		_.each(error.response.data.errors, function (errors) {
	              		_.each(errors, function (error) {
	                		html += error+'<br>';
	              		})
	            	});
		            html += '</div>';
		            swal({content: $(html)[0], icon: 'error'})
          		} else {
            		// 其他情况应该是系统挂了
            		swal('系统错误', '', 'error');
          		}
        	});
    	});
  	});
  	function editShow(){
	  	if($('.product_name').hasClass('dpn')){
		  	$('.removeBtn').css('display','none');
		  	$('.price_info').css('display','table-cell');
		  	$('.mobileInput').css('display','none');
		  	$('.product_name').removeClass('dpn');
	  	}else{
	  		$('.removeBtn').css('display','table-cell');
		  	$('.price_info').css('display','none');
		  	$('.mobileInput').css('display','block');
		  	$('.product_name').addClass('dpn');
	  	}
 	}
 	function setOrderNum(){
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
	        var $input = $(this).find('input[name=amount]');
	        // 如果用户将数量设为 0 或者不是一个数字，则也跳过
	        if ($input.val() == 0 || isNaN($input.val())) {
	          	return;
	        }
	        // 把 SKU id 和数量存入请求参数数组中
	        orderSum.push({
	          	price: $(this).data('price'),
	          	amount: $input.val(),
	        })
	        num+=$(this).data('price')*$input.val();
  		});
  		num = Number(num).toFixed(2);
  		console.log(orderSum);
  		console.log(num);
  		$('#orderSum').text(num);
 	}
</script>
@endsection