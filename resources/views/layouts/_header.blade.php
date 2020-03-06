<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-static-top">
  <div class="container">
    <!-- Branding Image -->
    <a class="navbar-brand" href="{{ url('/shop') }}">
      <img src="{{asset('images/logo.png')}}">
    </a>
    <!-- <button class="navbar-toggler nav-button" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" onclick="mobileEnd()"> -->
    <div class="nav-button" onclick="mobileEnd()">
      <span class="navbar-toggler-icon"></span>
    </div>
    <!-- 移动端适配——头部导航 -->
    <div class="nav-box pull-right J-indexNav">
      	<div class="close" onclick="closeMobileEnd()"><img src="{{asset('images/close.png')}}"></div>
        <ul class="navMoblie">
        	@guest
		        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">{{ __('shop.Login.login') }}</a></li>
		        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">{{ __('shop.Login.register') }}</a></li>
	        @else
	        	<li class="nav-item"><a class="nav-link" href="{{ url('/user_info') }}">个人中心</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('cart.index') }}">购物车</a></li>
		        <li class="nav-item"><a class="nav-link" href="{{ route('user_addresses.index') }}">收货地址</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('orders.index') }}">我的订单</a></li>
		        <li class="nav-item"><a class="nav-link" href="{{ route('products.favorites') }}">我的收藏</a></li>
		        <li class="nav-item">
		        	<a class="nav-link" id="logout" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">退出登录</a>
		            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
		              {{ csrf_field() }}
		            </form>
		        </li>
            @endguest
            <li class="nav-item">
            	<div class="nav-link">
	                <select>
	                    <option>中文简体</option>
	                    <option>ENGLISH</option>
	                    <option>中文繁體</option>
	                </select>
            	</div>
            </li>
        </ul>
    </div>

    <div class="collapse navbar-collapse"><!--  id="navbarSupportedContent" -->
      <!-- Left Side Of Navbar -->
      <ul class="navbar-nav mr-auto">
         
      </ul>
      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav navbar-right">
        <!-- 登录注册链接开始 -->
        @guest
        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">{{ __('shop.Login.login') }}</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">{{ __('shop.Login.register') }}</a></li>
        @else
        <li class="nav-item">
          <a class="nav-link mt-2" href="{{ route('cart.index') }}"><i class="fa fa-shopping-cart"></i></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="https://cdn.learnku.com/uploads/images/201709/20/1/PtDKbASVcz.png?imageView2/1/w/60/h/60" class="img-responsive img-circle" width="35px" height="35px">
            {{ Auth::user()->name }}
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a href="{{ url('/user_info') }}" class="dropdown-item">个人中心</a>
            <a href="{{ route('user_addresses.index') }}" class="dropdown-item">收货地址</a>
            <a href="{{ route('orders.index') }}" class="dropdown-item">我的订单</a>
            <a href="{{ route('products.favorites') }}" class="dropdown-item">我的收藏</a>
            <a class="dropdown-item" id="logout" href="#"
               onclick="event.preventDefault();document.getElementById('logout-form').submit();">退出登录</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
            </form>
          </div>
        </li>
        @endguest
        <li class="nav-item">
        	<div class="nav-link">
                <select>
                    <option>中文简体</option>
                    <option>ENGLISH</option>
                    <option>中文繁體</option>
                </select>
        	</div>
        </li>
        <!-- 登录注册链接结束 -->
      </ul>
    </div>
  </div>
</nav>