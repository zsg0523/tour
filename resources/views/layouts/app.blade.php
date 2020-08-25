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
        <!-- @include('layouts._header') -->
        @yield('banner')
        <div class="container">
            @yield('content')
        </div>
        <!-- @include('layouts._footer') -->
        <span class="icon-top"></span>
    </div>
    <!-- JS 脚本 -->
    <script src="{{ mix('js/app.js') }}"></script>
    <script type="text/javascript" src="{{asset('animal/js/swiper.min.js')}}"></script>
    @yield('scriptsAfterJs')
    <script type="text/javascript">
        $(function(){
            $(window).scroll(function(){
                if($(document).scrollTop() > 200){
                    $('.icon-top').fadeIn();
                }else{
                    $('.icon-top').fadeOut();
                }
            });
            $('.icon-top').click(function(){
                $('html,body').animate({'scrollTop':0});
            })
            console.log("{{ route_class() }}");
            if("{{ route_class() }}"==='products-index'||"{{ route_class() }}"==='login'||"{{ route_class() }}"==='register'||"{{ route_class() }}"==='password-request'||"{{ route_class() }}"==='password-reset'){
            	$(".selectLang").prop("disabled",false);
                $(".moblieselect").prop("disabled",false);
            }else{
            	$(".selectLang").prop("disabled",true);
                $(".moblieselect").prop("disabled",true);
            }
            var lang = sessionStorage.getItem('language');
            if(lang == 'zh-CN'){
                $(".selectLang").find("option[lang='zh-CN']").prop("selected",true);
                $(".moblieselect").find("option[lang='zh-CN']").prop("selected",true);
            }else if(lang == 'zh-TW'){
                $(".selectLang").find("option[lang='zh-TW']").prop("selected",true);
                $(".moblieselect").find("option[lang='zh-TW']").prop("selected",true);
            }else if(lang == 'en'){
                $(".selectLang").find("option[lang='en']").prop("selected",true);
                $(".moblieselect").find("option[lang='en']").prop("selected",true);
            }else{
                $(".selectLang").find("option[lang='en']").prop("selected",true);
                $(".moblieselect").find("option[lang='en']").prop("selected",true);
                $.ajax({
                    url:'https://www.wennoanimal.com/api/setLocale?lang=en',
                    type:'GET',
                    success:function(data) {
                        if(data){
                            sessionStorage.setItem('language','en');
                            window.location.reload();
                        }
                    },
                    error:function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log(XMLHttpRequest.status+'  '+XMLHttpRequest.readyState+'  '+textStatus);
                    }
                });
            };
        })
        $(".selectLang").change(function(){
            var language = $(this).find("option:selected").attr("lang");
            sessionStorage.setItem('language',language);
            $.ajax({
                url:'https://www.wennoanimal.com/api/setLocale?lang='+language,
                type:'GET',
                success:function(data) {
                    if(data){
                        window.location.reload();
                    }
                },
                error:function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log(XMLHttpRequest.status+'  '+XMLHttpRequest.readyState+'  '+textStatus);
                }
            });
        });
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