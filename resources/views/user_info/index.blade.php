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
	                            <p><span>登录邮箱:</span><span class="info">{{ Auth::user()->email }}</span><a class="dpn" href="">更换邮箱</a></p>
	                            @if(Auth::user()->phone)
	                            	<p><span>绑定手机:</span><span class="info">{{ Auth::user()->phone }}</span><a class="dpn" href="">改绑手机号</a></p>
					            @else
	                            	<p><span>绑定手机:</span><span class="info">您尚未绑定手机号</span><a class="dpn" href="">绑定手机号</a></p>
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
