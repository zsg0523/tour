<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Wenno Shop')</title>
    <!-- 样式 -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('animal/css/swiper.min.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" class="{{ route_class() }}-page">
        @include('layouts._header')
        @yield('banner')
        <div class="container">
            @yield('content')
        </div>
        @include('layouts._footer')
    </div>
    <!-- JS 脚本 -->
    <script src="{{ mix('js/app.js') }}"></script>
    <script type="text/javascript" src="{{asset('animal/js/swiper.min.js')}}"></script>
    @yield('scriptsAfterJs')
    <script type="text/javascript">
        function mobileEnd(){
            var $navButton = $('.nav-button');
            var $navBox = $('.nav-box');
            $navButton.hide();
            $navBox.slideDown();
        }
        function closeMobileEnd () {
            var $navButton = $('.nav-button');
            var $navBox = $('.nav-box');
            $navBox.slideUp(function() {
                $navButton.show()
            });
        }
    </script>
</body>
</html>