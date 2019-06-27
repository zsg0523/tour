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
         	 	<a class="sure" @click="backHistory"></a>
         	</div>
         	<p class="choose">Choose Your Language</p>
			<div class="swiper-container">
			    <div class="swiper-wrapper">
				    <div class="swiper-slide"  v-for="item in language" :key="item">@{{item.language}}</div>
			    </div>
			    <div class="swiper-button-next"></div>
			    <div class="swiper-button-prev"></div>
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
					    alert($(".swiper-slide-active").text());
			        })
			    }			
			},
			methods:{
                backHistory(){

                },
                getSwiper(){
                    let self = this;
                    self.language = [{'language':'English'},{'language':'中文简体'},{'language':'中文繁體'}];
                }
			},
			created:function(){
	        	var that=this;
	        	that.getSwiper();
	        }
		});
    </script>
</html>
