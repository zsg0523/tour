@extends('layouts.app')
@section('title', '收货地址列表')

@section('content')
<div class="row">
    <div class="user_main disflex">
      	<div class="col-xs-3 col-sm-3 col-md-2 col-lg-2 mobileMenu">
          	@include('layouts._menu')
      	</div>
      	<div class="col-xs-9 col-sm-9 col-md-10 col-lg-10">
	        <div class="col-md-12">
	          	<div class="card panel-default">
		            <div class="card-header">
		              {{ __("shop.address.addresslist") }}
		              <a href="{{ route('user_addresses.create') }}" class="float-right">{{ __("shop.address.newaddress") }}</a>
		            </div>
		            <div class="card-body webList">
		            	@if ($addresses->count())
                        <table class="table table-bordered table-striped">
		                	<thead>
				                <tr>
									<th>{{ __("shop.address.receiver") }}</th>
									<th>{{ __("shop.address.address") }}</th>
									<th>{{ __("shop.address.postcode") }}</th>
									<th>{{ __("shop.address.phone") }}</th>
									<th>{{ __("shop.address.operating") }}</th>
				                </tr>
		                	</thead>
	                		<tbody>
	                		@foreach($addresses as $address)
			                  	<tr>
				                    <td>{{ $address->contact_name }}</td>
				                    <td>{{ $address->full_address }}</td>
				                    <td>{{ $address->zip }}</td>
				                    <td>{{ $address->contact_phone }}</td>
				                    <td>
				                      <a href="{{ route('user_addresses.edit', ['user_address' => $address->id]) }}" class="btn btn-primary" style="margin-bottom: 10px;">{{ __("shop.address.edit") }}</a>
				                      <!-- 把之前删除按钮的表单替换成这个按钮，data-id 属性保存了这个地址的 id，在 js 里会用到 -->
				                      <button class="btn btn-danger btn-del-address" type="button" data-id="{{ $address->id }}" style="margin-bottom: 10px;">{{ __("shop.address.delete") }}</button>
				                    </td>
			                  	</tr>
	                		@endforeach
	                		</tbody>
		              	</table>
			            @else
                        	<div class="nodata">{{ __("shop.address.none") }}</div>
			            @endif
	            	</div>
	          	</div>
	          	<!-- 移动端列表显示 -->
	          	<div class="card-body mobileList">
	          		@if ($addresses->count())
	            		@foreach($addresses as $address)
		                  	<div class="address_info">
		                  		<p>
		                  			<span>{{ $address->contact_name }}</span>
		                  			<span class="fr">{{ $address->contact_phone }}</span>
		                  		</p>
			                    <p class="full_address">{{ $address->full_address }}</p>
			                    <p class="address_btn text-right">
			                      	<a href="{{ route('user_addresses.edit', ['user_address' => $address->id]) }}" class="" style="margin-bottom: 10px;">{{ __("shop.address.edit") }}</a>
			                      <!-- 把之前删除按钮的表单替换成这个按钮，data-id 属性保存了这个地址的 id，在 js 里会用到 -->
			                      	<a class="btn-del-address" data-id="{{ $address->id }}" style="margin-bottom: 10px;">{{ __("shop.address.delete") }}</a>
			                    </p>
		                  	</div>
	            		@endforeach
		            @else
                    	<div class="nodata">{{ __("shop.address.none") }}</div>
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
     $('.menu_list li.menu_list_address').addClass('active');
      // 删除按钮点击事件
      $('.btn-del-address').click(function() {
        // 获取按钮上 data-id 属性的值，也就是地址 ID
        var id = $(this).data('id');
        // 调用 sweetalert
        swal({
          title: '{{ __("shop.address.deleteaddress") }}',
          icon: "warning",
          buttons: ['{{ __("shop.address.cancel") }}', '{{ __("shop.address.sure") }}'],
          dangerMode: true,
        })
          .then(function(willDelete) { // 用户点击按钮后会触发这个回调函数
            // 用户点击确定 willDelete 值为 true， 否则为 false
            // 用户点了取消，啥也不做
            if (!willDelete) {
              return;
            }
            // 调用删除接口，用 id 来拼接出请求的 url
            axios.delete('/user_addresses/' + id)
              .then(function () {
                // 请求成功之后重新加载页面
                location.reload();
              })
          });
      });
    });
  </script>
@endsection
