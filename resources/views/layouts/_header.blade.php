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
	        	<li class="nav-item"><a class="nav-link" href="{{ url('/user_info') }}">{{ __('shop.info.personal') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('cart.index') }}">购物车</a></li>
		        <li class="nav-item"><a class="nav-link" href="{{ route('user_addresses.index') }}">{{ __('shop.info.address') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('orders.index') }}">{{ __('shop.info.order') }}</a></li>
		        <li class="nav-item"><a class="nav-link" href="{{ route('products.favorites') }}">{{ __('shop.info.collect') }}</a></li>
		        <li class="nav-item">
		        	<a class="nav-link" id="logout" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('shop.info.loginout') }}</a>
		            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
		              {{ csrf_field() }}
		            </form>
		        </li>
            @endguest
            <li class="nav-item">
            	<div class="nav-link">
	                <select class="selectLang">
                      <option lang="en" value="0">ENGLISH</option>
	                    <option lang="zh-CN" value="1">中文简体</option>
	                    <option lang="zh-TW" value="2">中文繁體</option>
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
            <a href="{{ url('/user_info') }}" class="dropdown-item">{{ __('shop.info.personal') }}</a>
            <a href="{{ route('user_addresses.index') }}" class="dropdown-item">{{ __('shop.info.address') }}</a>
            <a href="{{ route('orders.index') }}" class="dropdown-item">{{ __('shop.info.order') }}</a>
            <a href="{{ route('products.favorites') }}" class="dropdown-item">{{ __('shop.info.collect') }}</a>
            <a class="dropdown-item" id="logout" href="#"
               onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('shop.info.loginout') }}</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
            </form>
          </div>
        </li>
        @endguest
        <li class="nav-item">
        	<div class="nav-link">
            <select class="selectLang moblieselect">
              <option lang="en" value="0">ENGLISH</option>
              <option lang="zh-CN" value="1">中文简体</option>
              <option lang="zh-TW" value="2">中文繁體</option>
            </select>
        	</div>
        </li>
        <!-- 登录注册链接结束 -->
      </ul>
    </div>
  </div>
</nav>