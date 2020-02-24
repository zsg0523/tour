<style type="text/css">
	.photo_info{height: 64px;}
	.user-infoPic{position: relative;width: 64px;height: 64px;overflow: hidden;}
	.user-infoPic .inputPic {opacity: 0;ilter: alpha(opacity=0);width: 100%;height: 100%;position: absolute;bottom: 0;left: 0;z-index: 9;}
	.user-infoPic img{width: 64px;height: 64px;}
	.user-infoPic p{position: absolute;bottom: 0;display:none;background-color: #000;opacity: 0.7;font-size: 12px;color: #e1d7ca;margin: 0;width: 64px;text-align: center;}
	.user-infoPic:hover p{display: block;cursor: pointer;}

	.user-info{margin-left: 15px;line-height: 21px;font-size: 14px;}
	.user-info p{margin: 0;}
	.user-info p span{width: 70px;display: inline-block;}
	.user-info p span.info{width: 220px;}
	.user-info p a{color: #3490dc;}
</style>
@extends('layouts.app')
@section('title', '个人中心')

@section('content')
<div class="row">

    <div class="user_main disflex">
        <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2">
            @include('layouts._menu')
        </div>
        <div class="col-xs-9 col-sm-9 col-md-10 col-lg-10">
            <div class="col-md-12">
		      	<div class="card panel-default">
			        <div class="card-header">
			          	个人信息
			        </div>
			        <div class="card-body">
			         	<div class="photo_info disflex">
	                        <!--头像 -->
	                        <form method="POST" action="#" enctype="multipart/form-data">
								<div class="user-infoPic">
									<input type="file" class="inputPic" name="file" allowexts="gif,jpeg,jpg,png,bmp" accept="image/*" onchange=""><!-- this.form.submit() -->
									@if(Auth::user()->avatar)
		                            	<img src="{{asset('images/writer_img.png')}}" class="avatar" />
						            @else
		                            	<img src="{{asset('images/writer_img.png')}}" class="avatar" />
						            @endif
	                            	<p>编辑头像</p>
								</div>
							</form>
	                        <div class="user-info">
	                            <p><span>会员名</span>{{ Auth::user()->name }}</p>
	                            <p><span>登录邮箱:</span><span class="info">{{ Auth::user()->email }}</span><a class="" href="">更换邮箱</a></p>
	                            @if(Auth::user()->phone)
	                            	<p><span>绑定手机:</span><span class="info">{{ Auth::user()->phone }}</span><a class="" href="">改绑手机号</a></p>
					            @else
	                            	<p><span>绑定手机:</span><span class="info">您尚未绑定手机号</span><a class="" href="">绑定手机号</a></p>
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
