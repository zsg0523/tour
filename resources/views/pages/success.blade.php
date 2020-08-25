<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- <title>@yield('title', 'Wenno Shop')</title> -->
    <title>{{ __('shop.info.title') }}</title>
    <!-- 样式 -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('animal/css/swiper.min.css') }}" rel="stylesheet">
</head>
<body> 
    <div id="app" class="{{ route_class() }}-page">
        <div class="container">
            <div class="card">
			    <div class="card-header">{{ __('shop.page.success') }}</div>
			    <div class="card-body text-center">
			      <h1>{{ $msg }}</h1>
			    </div>
			  </div>
        </div>
    </div>
</body>
</html>