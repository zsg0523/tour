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
	              收货地址列表
	              <a href="{{ route('user_addresses.create') }}" class="float-right">新增收货地址</a>
	            </div>
	            <div class="card-body webList">
	              	<table class="table table-bordered table-striped">
	                	<thead>
			                <tr>
								<th>收货人</th>
								<th>地址</th>
								<th>邮编</th>
								<th>电话</th>
								<th>操作</th>
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
				                      <a href="{{ route('user_addresses.edit', ['user_address' => $address->id]) }}" class="btn btn-primary" style="margin-bottom: 10px;">编辑</a>
				                      <!-- 把之前删除按钮的表单替换成这个按钮，data-id 属性保存了这个地址的 id，在 js 里会用到 -->
				                      <button class="btn btn-danger btn-del-address" type="button" data-id="{{ $address->id }}" style="margin-bottom: 10px;">删除</button>
				                    </td>
			                  	</tr>
	                		@endforeach
	                		</tbody>
	              		</table>
	            	</div>
	          	</div>
	          	<!-- 移动端列表显示 -->
	          	<div class="card-body mobileList">
            		@foreach($addresses as $address)
	                  	<div class="address_info">
	                  		<p>
	                  			<span>{{ $address->contact_name }}</span>
	                  			<span class="fr">{{ $address->contact_phone }}</span>
	                  		</p>
		                    <p class="full_address">{{ $address->full_address }}</p>
		                    <p class="address_btn text-right">
		                      	<a href="{{ route('user_addresses.edit', ['user_address' => $address->id]) }}" class="" style="margin-bottom: 10px;">编辑</a>
		                      <!-- 把之前删除按钮的表单替换成这个按钮，data-id 属性保存了这个地址的 id，在 js 里会用到 -->
		                      	<a class="btn-del-address" data-id="{{ $address->id }}" style="margin-bottom: 10px;">删除</a>
		                    </p>
	                  	</div>
            		@endforeach
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
          title: "确认要删除该地址？",
          icon: "warning",
          buttons: ['取消', '确定'],
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
