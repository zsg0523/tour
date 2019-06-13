<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
	</head>
    <link rel="stylesheet" href="./css/swiper.min.css" />
    <link rel="stylesheet" href="./css/animalIndex.css">
    <body class="HolyGrail">
		<header>
			<div class="title">
			   <span class="item">Wenno</span>
			</div>
		</header>
        <div class="HolyGrail-body" id="HolyGrail-body">
            <nav>
			    <div class="swiper-container">
			    	<div class="swiper-wrapper">
			    	     <div class="swiper-slide"  v-for="arr in swiper">@{{arr.title}}</div>
<!-- 			    		<div class="swiper-slide active">Elephant</div>
			    		<div class="swiper-slide">Monkey</div>
			    		<div class="swiper-slide">Giraffe</div>
			    		<div class="swiper-slide">Rabbit</div>
			    		<div class="swiper-slide">Siberian Tiger</div>
			    		<div class="swiper-slide">Panda</div> -->
			    	</div>
			    </div>
            </nav>
		    <div class="slideUpDown">
		        <div class="container">
		        	<div class="waterfall">
						<div class="pin">
							<img src="./images/elephant_1.png"/>
							<p>1 convallis timestamp</p>
						</div>		        		
						<div class="pin">
							<img src="./images/elephant_1.png"/>
							<p>2 convallis timestamp</p>
						</div>	
						<div class="pin">
							<img src="./images/elephant_1.png"/>
							<p>3 convallis timestamp</p>
						</div>	
						<div class="pin">
							<img src="./images/elephant_1.png"/>
							<p>4 convallis timestamp</p>
						</div>	
						<div class="pin">
							<img src="./images/elephant_1.png"/>
							<p>5 convallis timestamp</p>
						</div>
						<div class="pin">
							<img src="./images/elephant_1.png"/>
							<p>6 convallis timestamp</p>
						</div>		        		
						<div class="pin">
							<img src="./images/elephant_1.png"/>
							<p>7 convallis timestamp</p>
						</div>	
						<div class="pin">
							<img src="./images/elephant_1.png"/>
							<p>8 convallis timestamp</p>
						</div>	
						<div class="pin">
							<img src="./images/elephant_1.png"/>
							<p>9 convallis timestamp</p>
						</div>	
						<div class="pin">
							<img src="./images/elephant_1.png"/>
							<p>10 convallis timestamp</p>
						</div>		
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
				cycle:[],
				swiperIndex:0,
				cycleIndex:0
			},
			watch: {
			    swiper: function() {
			        this.$nextTick(function(){
			          /*现在数据已经渲染完毕*/
					    var swiper = new Swiper('.swiper-container', {
					       slidesPerView: 2,
					       spaceBetween: 2,
					       freeMode: true
					    });
			        })
			    }
			},
			methods:{
                getSwiper(){
                    let self = this;
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
