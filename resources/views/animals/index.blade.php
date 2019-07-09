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
				    	    <div class="swiper-slide"  :class="imageIndex === index ? 'active' : '' " v-for="(arr,index) in swiper" :key="'time' + index" :title="arr.title_page"  @click="selectTimer(index,arr.title_page)">
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
					    var swiper = new Swiper('.swiper-container', {
					       slidesPerView: 2,
					       spaceBetween:0,
					       freeMode: true
					    });
			        })
			    }
			},
			methods:{
				database(title){
                    window.location.href = './animals/database?product_name='+title;
				},
                selectTimer(index,title) {
				    this.imageIndex = index;
				    const self=this;
                    $.ajax({
				        url:'/api/animals?theme='+title+'&include=sound,animal',
				        type:'GET',
				        success:function(data) {
							if(data.data.length==0){
                                alert("无数据");
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
                getSwiper(url,status,thisx){
                    let self = this;
                    $.ajax({
				        url:'/api/animals?include=sound,animal',
				        type:'GET',
				        success:function(data) {
				            self.swiper = data.meta;
							if(data.data.length==0){
                                alert("无数据");
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
