<ul class="menu_list">
	<li class="menu_list_user"> <a href="{{ url('/user_info') }}"><span>&nbsp;</span>账号管理</a></li>
	<li class="menu_list_address"> <a href="{{ route('user_addresses.index') }}"><span>&nbsp;</span>收货地址</a></li>
	<li class="menu_list_order"> <a href=""><span>&nbsp;</span>我的订单</a></li>
	<li class="menu_list_favor"> <a href="{{ route('products.favorites') }}"><span>&nbsp;</span>我的收藏</a></li>
</ul>