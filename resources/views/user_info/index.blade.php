@extends('layouts.app')
@section('title', '个人中心')

@section('content')
<div class="row">

    <div class="user_main account_info disflex">
        <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2 mobileMenu">
            @include('layouts._menu')
        </div>
        <div class="col-xs-9 col-sm-9 col-md-10 col-lg-10">
            <div class="col-md-12">
		      	<div class="card panel-default">
			        <div class="card-header">
			          	{{ __("shop.info.info") }}
			        </div>
			        <div class="card-body">
			         	<div class="photo_info disflex">
	                        <!--头像 -->
	                        <!-- <form method="POST" action="#" enctype="multipart/form-data">
								<div class="user-infoPic">
									<input type="file" class="inputPic" name="file" allowexts="gif,jpeg,jpg,png,bmp" accept="image/*" onchange="">
									@if(Auth::user()->avatar)
		                            	<img src="{{asset('images/writer_img.png')}}" class="avatar" />
						            @else
		                            	<img src="{{asset('images/writer_img.png')}}" class="avatar" />
						            @endif
	                            	<p>{{ __("shop.info.editavatar") }}</p>
								</div>
							</form> -->
	                        <div class="user-info">
	                            <p><span>{{ __("shop.info.name") }}:</span><span class="info">{{ Auth::user()->name }}</span><a class="dpn" href="{{ url('/user_info/edit') }}">{{ __("shop.info.editinfo") }}</a></p>
	                            <p><span>{{ __("shop.info.email") }}:</span><span class="info">{{ Auth::user()->email }}</span><a class="dpn" href="{{ url('/user_info/change_email') }}">{{ __("shop.info.editemail") }}</a></p>
	                            <p class="dpn"><span>{{ __("shop.info.pass") }}:</span><span class="info">********</span><a href="{{ url('/user_info/pass') }}">{{ __("shop.info.editpass") }}</a></p>
	                            @if(Auth::user()->phone)
	                            	<p class="dpn"><span>绑定手机:</span><span class="info">{{ Auth::user()->phone }}</span><a class="dpn" href="">改绑手机号</a></p>
					            @else
	                            	<p class="dpn"><span>绑定手机:</span><span class="info">您尚未绑定手机号</span><a class="dpn" href="">绑定手机号</a></p>
					            @endif
	                        </div>
	                    </div>
			          
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
	    $('.menu_list li.menu_list_user').addClass('active');
    });
  </script>
@endsection
