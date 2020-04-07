@extends('layouts.app')
@section('title','修改信息')

@section('content')
<div class="row">
	<div class="user_main disflex">
		<div class="col-xs-3 col-sm-3 col-md-2 col-lg-2 mobileMenu">
			@include('layouts._menu')
		</div>
		<div class="col-xs-9 col-sm-9 col-md-10 col-lg-10">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header text-center">{{ __("shop.info.editpass") }}</div>
					<div class="card-body">

						<div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __("shop.info.originalpass") }}</label>
                            <div class="col-md-6">
                                <input id="password" class="form-control" type="password" name="password" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="newpassword" class="col-md-4 col-form-label text-md-right">{{ __("shop.info.newpass") }}</label>
                            <div class="col-md-6">
                                <input id="newpassword" class="form-control" type="password" name="newpassword" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="confirmpassword" class="col-md-4 col-form-label text-md-right">{{ __("shop.info.confirmpass") }}</label>
                            <div class="col-md-6">
                                <input id="confirmpassword" class="form-control" type="password" name="confirmpassword" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row mt-2">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary resetBtn">
                                    {{ __("shop.info.save") }}
                                </button>
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