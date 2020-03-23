<ul class="menu_list">
	<li class="menu_list_user"> <a href="{{ url('/user_info') }}"><span>&nbsp;</span>{{ __('shop.info.account') }}</a></li>
	<li class="menu_list_address"> <a href="{{ route('user_addresses.index') }}"><span>&nbsp;</span>{{ __('shop.info.address') }}</a></li>
	<li class="menu_list_order"> <a href="{{ route('orders.index') }}"><span>&nbsp;</span>{{ __('shop.info.order') }}</a></li>
	<li class="menu_list_favor"> <a href="{{ route('products.favorites') }}"><span>&nbsp;</span>{{ __('shop.info.collect') }}</a></li>
</ul>