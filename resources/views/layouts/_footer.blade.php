<footer class="footer">
  	<div>
  		<div class="listBottom">
          	<div class="lister col-lg-10 offset-lg-1 col-sm-12">
              	<ul class="about list">
					<a href="{{ url('/aboutUs') }}" class="titleIcon"><img src="{{asset('images/about.png')}}"></a>
					<a href="{{ url('/aboutUs') }}"><p class="text-uppercase">{{ __('shop.contact.about') }}</p></a>
					<a href="{{ url('/aboutUs') }}"><li class="text-capitalize">{{ __('shop.contact.aboutWenno') }}</li></a>
					<a href="{{ url('/aboutUs') }}"><li class="text-capitalize">{{ __('shop.contact.aboutNew') }}</li></a>
					<a href="{{ url('/aboutUs') }}"><li class="text-capitalize">{{ __('shop.contact.figurines') }}</li></a>
              	</ul>
              	<ul class="contact list">
               		<a href="{{ url('/contact') }}" class="titleIcon"><img src="{{asset('images/contact.png')}}"></a>
                  	<a  href="{{ url('/contact') }}"><p class="text-uppercase">{{ __('shop.contact.contactUs') }}</p></a>
                   	<a href="{{ url('/contact') }}"><li class="text-capitalize">{{ __('shop.contact.telephone') }}</li></a>
                   	<a href="{{ url('/contact') }}"><li class="text-capitalize">{{ __('shop.contact.address') }}</li></a>
                   	<a href="{{ url('/contact') }}"><li class="text-capitalize">{{ __('shop.contact.emailx') }}</li></a>
              	</ul>
              	<ul class="retail list">
                   <a href="{{ url('/retail') }}" class="titleIcon"><img src="{{asset('images/retail.png')}}"></a>
                   <a href="{{ url('/retail') }}"><p class="text-uppercase">{{ __('shop.contact.retails') }}</p></a>
                   <a href="{{ url('/retail') }}"><li class="text-capitalize"><img src="{{asset('images/address.png')}}">{{ __('shop.contact.hongkong') }}</li></a>
              	</ul>
          	</div>
   	  	</div>
   	  	<div class="bottomAdress">
   	  	  	<div class="copyright">
   	  	  	 	<div class="copyrightContent">
   	  	  	 	 	<span><a>{{ __('shop.contact.privacy') }}</a></span>
   	  	  	 	 	<a>{{ __('shop.contact.copyright') }}</a>
   	  	  	 	</div>
   	  	  	 	<div class="newsletter">
                	<a href="https://www.facebook.com/WennoWorld/" target="_blank">
                		<img src="{{asset('images/facebook.png')}}">
                	</a>
                	<a>
                		<img src="{{asset('images/wei.png')}}">
                	</a>
   	  	  	 	</div>
   	  	  	</div>
   	  	</div>
  	</div>
</footer>