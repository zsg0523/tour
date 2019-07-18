<!DOCTYPE html>
<html>
	<head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=no" />
		<meta charset="UTF-8">
		<title></title>
	</head>
    <link rel="stylesheet" href="./css/swiper.min.css" />
    <link rel="stylesheet" href="./css/animalIndex.css">
    <script type="text/javascript" src="./js/orientationchange.js" ></script>
    <body class="HolyGrail">
        <div  id="HolyGrail-body">
			<header>
				<div class="title">
				   <a class="setting" href="{{url('animals/chooseLanguage')}}"></a>
				   <span><img src="./images/tipLeft.png"></span>
				   <span class="item">{{ __('animals.page-title') }}</span>
				   <span><img src="./images/tipRight.png"></span>
				</div>
			</header>
	        <div class="HolyGrail-body">
	            <nav>
				    <div class="swiper-container">
				    	<div class="swiper-wrapper">
				    	    <div class="swiper-slide"  v-for="(arr,index) in swiper" :key="'time' + index" :title="arr.title_page"  @click="selectTimer(index,arr.title_page)">
				    	        <a>@{{arr.title_page}}</a>
				    	    </div>
				    	</div>
				    </div>
	            </nav>
			    <div class="slideUpDown">
			        <div class="container">
			             <ul>
			             	<li v-for ="(item,index) in imageArray" :key="item" :databaseId="item.id"  @click="database(item.animal.product_name)">
			             	    <div>
				             		<img class="data-image"  v-bind:src="item.animal.image_original"  v-on:error.once="moveErrorImg($event)"/>
				             		<p>@{{item.title}}</p>	
			             	    </div>
			             	</li>
			             </ul>
			        </div>
			    </div>
	        </div>
        </div>
    </body>
    <script type="text/javascript" src="./js/swiper.js" ></script>
	<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/vue/2.2.3/vue.min.js"></script>
    <script>
		var vm = new Vue({
			el: "#HolyGrail-body",
			data:{
				swiper:[],
				imageArray:[],
				swiperIndex:0,
				imageIndex:0
			},
			watch: {
			    swiper: function() {
			        this.$nextTick(function(){
			          /*现在数据已经渲染完毕*/
			            var initialSlide;
	                    function GetQueryString(name){
	                        var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
	                        var r = window.location.search.substr(1).match(reg);
	                        if(r!=null)return unescape(r[2]); return null;
	                    }
	                    var theme = GetQueryString("theme");
	                    if(theme==null||theme==undefined){
	                    	initialSlide=0
	                    }else{
	                        var goodslength = $(".swiper-slide").length;
	                        for(var i=0;i<goodslength;i++){
	                        	var html = $(".swiper-slide").eq(i).text();
	                        	if(html==theme){
	                        	    initialSlide=i;
	                        	}
	                        }
	                    }
					    var swiper = new Swiper('.swiper-container', {
					       slidesPerView: 2.5,
					       spaceBetween:0,
					       initialSlide:initialSlide,
					       slideToClickedSlide:true,
					       centeredSlides:true,
					       freeMode: true
					    });
					    var goodslength = $(".swiper-slide").length;
					    $(".swiper-slide").eq(initialSlide).addClass("active");
			        })
			    }
			},
			methods:{
				database(title){

                    window.location.href = './animals/database?product_name='+title;
				},
                selectTimer(index,title) {
				    this.imageIndex = index;
				    $(".swiper-slide").removeClass("active");
				    $(".swiper-slide").eq(index).addClass("active");
				    const self=this;
                    $.ajax({
				        url:'/api/animals?theme='+title+'&include=sound,animal',
				        type:'GET',
				        success:function(data) {
							if(data.data.length==0){
								var noData = "{{ __('animals.noData') }}";
                                alert(noData);
                                self.imageArray = [];
				            }else{
				            	self.imageArray = data.data;								        	
				            }
				        },
				        error:function(XMLHttpRequest, textStatus, errorThrown) {
				            console.log(XMLHttpRequest.status);
				            console.log(XMLHttpRequest.readyState);
				            console.log(textStatus);
				        }
				    });
				},
	            moveErrorImg:function (event) {
	                event.currentTarget.src = "./images/loadingLogo.png";//默认图片
	            },
                getSwiper(){
                    let self = this;
                    function GetQueryString(name){
                        var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
                        var r = window.location.search.substr(1).match(reg);
                        if(r!=null)return unescape(r[2]); return null;
                    }
                    var theme = GetQueryString('theme');
                    var lang = GetQueryString('lang');
                    var language = sessionStorage.getItem('language');
                    console.log(language);
                    if(theme==null&lang==null){
                       	if(language!=null){
                            var url = '/api/animals?lang='+language+'&include=animal';
                       	}else{
                       	    var url = '/api/animals?include=animal';
                       	}
                    }else{
                        var url = '/api/animals?theme='+theme+'&lang='+lang+'&include=animal';
                    }
                    $.ajax({
				        url:url,
				        type:'GET',
				        success:function(data) {
				            self.swiper = data.meta;
							if(data.data.length==0){
								var noData = "{{ __('animals.noData') }}";
                                alert(noData);
                                self.imageArray = [];
				            }else{
				            	self.imageArray = data.data;							        	
				            }
				        },
				        error:function(XMLHttpRequest, textStatus, errorThrown) {
				            console.log(XMLHttpRequest.status);
				            console.log(XMLHttpRequest.readyState);
				            console.log(textStatus);
				        }
				    });
                }
			},
			created:function(){
	        	var that=this;
	        	that.getSwiper();
	        }
		});
    </script>
</html>
