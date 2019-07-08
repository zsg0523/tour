<!DOCTYPE html>
<html>
	<head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=no" />
		<meta charset="UTF-8">
		<title></title>
	</head>
    <link rel="stylesheet" href="../css/swiper.min.css" />
    <link rel="stylesheet" href="../css/chooseLanguage.css">
    <script type="text/javascript" src="../js/orientationchange.js" ></script>
    <body class="language">
         <div class="chooseLanguage" id="chooseLanguage">
         	<div class="icon">
         	 	<a class="back" href="{{url('animals')}}"></a>
         	 	<img src="../images/logo_set.png">
         	</div>
         	<p class="choose">{{ __('animals.choose-your-language') }}</p>
			<div class="swiper-container">
			    <div class="swiper-wrapper">
				    <div class="swiper-slide"  v-for="item in language" :key="item" :title="item.title">@{{item.language}}</div>
			    </div>
			    <div class="swiper-button-next"></div>
			    <div class="swiper-button-prev"></div>
			</div>
			<div class="sure" @click="chooseLanguage">
				<p>{{ __('animals.determine') }}</p>
			</div>
         </div>
    </body>
    <script type="text/javascript" src="../js/swiper.js" ></script>
	<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/vue/2.2.3/vue.min.js"></script>
    <script>
		var vm = new Vue({
			el: "#chooseLanguage",
			data:{
			   language:[]
			},
			watch: {
			    language: function() {
			        this.$nextTick(function(){
			          /*现在数据已经渲染完毕*/
					    var swiper = new Swiper('.swiper-container', {
					       navigation: {
					         nextEl: '.swiper-button-next',
					         prevEl: '.swiper-button-prev',
					       },
					    });
			        })
			    }			
			},
			methods:{
                chooseLanguage(){
                      // alert($(".swiper-slide-active").attr('title'));
                    let language = $(".swiper-slide-active").attr('title');
                    console.log(language);
                    $.ajax({
				        url:'/api/setLocale?lang='+language,
				        type:'GET',
				        success:function(data) {
							console.log(JSON.stringify(data));
							if(data){
								// window.history.go(-1);
								window.location.href = document.referrer;
							}
				        },
				        error:function(XMLHttpRequest, textStatus, errorThrown) {
				            console.log(XMLHttpRequest.status);
				            console.log(XMLHttpRequest.readyState);
				            console.log(textStatus);
				        }
				    });
                },
                getSwiper(){
                    let self = this;
                    $.ajax({
                        url:'/api/lang',
                        type:'GET',
                        success:function(data) {
                            console.log(JSON.stringify(data));
                        },
                        error:function(XMLHttpRequest, textStatus, errorThrown) {
                            console.log(XMLHttpRequest.status);
                            console.log(XMLHttpRequest.readyState);
                            console.log(textStatus);
                        }
                    }); 
                    self.language = [
                        {'language':'English','title':'en'},
                        {'language':'Deutsch','title':'de'},
                        {'language':'Français','title':'fr'},
	                    {'language':'Italiano','title':'it'},
	                    {'language':'Türkçe','title':'tr'},
	                    {'language':'Nederlands','title':'nl'},
	                    {'language':'Dansk','title':'da'},
	                    {'language':'Português','title':'pt'},
	                    {'language':'Svenska','title':'sv'},
	                    {'language':'ภาษาไทย','title':'th'},
	                    {'language':'한국어','title':'ko'},
	                    {'language':'Norsk','title':'no'},
	                    {'language':'بهاس ملايو','title':'ms'},
	                    {'language':'中文简体','title':'zh-CN'},
	                    {'language':'中文繁體','title':'zh-TW'},
	                    {'language':'العَرَبِية','title':'ar'},
	                    {'language':'Español','title':'es'},
	                    {'language':'русский язык','title':'ru'},
	                    {'language':'हिन्दी','title':'hi'},
	                    {'language':'Finnish','title':'fi'},
	                    {'language':'日本語','title':'ja'},
	                    {'language':'українська мова','title':'uk'}];
                }
			},
			created:function(){
	        	var that=this;
	        	that.getSwiper();
	        }
		});
    </script>
</html>
