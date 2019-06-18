<!DOCTYPE html>
<html>
	<head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=no" />
		<meta charset="UTF-8">
		<title></title>
	</head>
    <link rel="stylesheet" href="./css/swiper.min.css" />
    <link rel="stylesheet" href="./css/animalIndex.css">
    <style>
    </style>
    <body class="HolyGrail">
        <div  id="HolyGrail-body">
			<header>
				<div class="title">
				   <span><img src="./images/tipLeft.png"></span>
				   <span class="item">@{{animalName}}</span>
				   <span><img src="./images/tipRight.png"></span>
				</div>
			</header>
	        <div class="HolyGrail-body">
	            <nav>
				    <div class="swiper-container">
				    	<div class="swiper-wrapper">
				    	    <div class="swiper-slide"  :class="imageIndex === index ? 'active' : '' " v-for="(arr,index) in swiper" :key="'time' + index" @click="selectTimer(index)">
				    	        <a>@{{arr.title}}</a>
				    	    </div>
				    	</div>
				    </div>
	            </nav>
			    <div class="slideUpDown">
			        <div class="container">
			             <ul>
			             	<li v-for ="(item,index) in imageArray" :key="item">
			             	    <a href="{{url('animals/database')}}">
				             		<img class="data-image"  v-bind:src="item.img"  v-on:error.once="moveErrorImg($event)"/>
				             		<p>@{{item.description}}</p>	
			             	    </a>

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
				imageIndex:0,
				animalName:''
			},
			watch: {
			    swiper: function() {
			        this.$nextTick(function(){
			          /*现在数据已经渲染完毕*/
					    var swiper = new Swiper('.swiper-container', {
					       slidesPerView: 2.5,
					       spaceBetween:0,
					       freeMode: true
					    });
			        })
			    }
			},
			methods:{
                selectTimer(index) {
				   this.imageIndex = index;
				},
	            moveErrorImg:function (event) {
	                event.currentTarget.src = "./images/loadingLogo.png";//默认图片
	            },
                getSwiper(){
                    let self = this;
                    self.animalName = 'Animal Database';
                    self.imageArray = [{'img':'','description':'elephant_1'},{'img':'./images/zebra.png','description':'elephant_2'},{'img':'./images/zebra.png','description':'elephant_3'},{'img':'./images/zebra.png','description':'elephant_4'},{'img':'','description':'elephant_5'}];

                    self.swiper = [{'title':'Elephant'},{'title':'Monkey'},{'title':'Giraffe'},{'title':'Rabbit'},{'title':'Siberian Tiger'},{'title':'Panda'}];
                }
			},
			created:function(){
	        	var that=this;
	        	that.getSwiper();
	        }
		});
    </script>
</html>
