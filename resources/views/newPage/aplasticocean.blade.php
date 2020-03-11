<!DOCTYPE html>
<html>
	<head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=no" />
		<meta charset="UTF-8">
		<title></title>
	</head>
    <link rel="stylesheet" href="./animal/css/swiper.min.css" />
    <style type="text/css">
    	a {text-decoration: none;background-color: transparent;}
		a:hover {text-decoration: none;}
		a:not([href]) {color: inherit;text-decoration: none;}
		a:not([href]):hover {color: inherit;text-decoration: none;}
    	.HolyGrail{width: 100%;height: 100%;margin: 0;padding: 0;}
    	.header{max-width:1700px;width: 90%;height: 80px;line-height: 80px;margin: 0 auto;}
    	.header .logol{float: left;width: 100px;height: 67px;}
    	.header .logor{float: left;width: 100px;height: 67px;margin-left: 10px;}
    	.header img{width: 100%;height: 100%;vertical-align: middle;}
        .Lang{float: right;}
        select{border-radius: .3rem;color: #7b5c55;height:35px;line-height:35px;font-size: .67rem;text-align: left;background: #fff;background-size: 8px 5px;}
    	.main{width: 100%;height:100%;background-color: #d3edfb;padding-top: 20px;}
    	.main .video{width: 90%;margin: 0 auto;text-align: center;border-radius:5px;overflow: hidden;}
    	.more{margin: 0;text-align: right;height: 35px;line-height: 35px;background: #fff;padding-right: 15px;color: #333;}
    	.more img{width: 21px;height: 21px;vertical-align: middle;}
	    .videoBox{width:100%;height:100%;margin:0px auto;position:relative;display: -ms-flexbox;display: -webkit-flex;display: flex;-webkit-box-pack: center;-ms-flex-pack: center;-webkit-justify-content: center; justify-content: center;-webkit-box-align: center;-ms-flex-align: center;-webkit-align-items: center;align-items: center;font-size:3rem;color:#fff;}
	   	.videoBox video{width: 100%;}
	   	.play{width:60px;height: 60px;position: absolute;top: 45%;left: 45%;}

    	.main .textinfo{width: 90%;margin: 20px auto;background-color: #697ac3;color: #fff;border-radius: 5px;padding: 10px 0;}
    	.textinfo p{margin: 0;font-size: 0.9rem;line-height: 30px;padding: 0 10px;}
    	.textinfo p:first-child{font-size: 1rem;line-height: 45px;}
    	.animal{width: 90%;margin: 20px auto;position: relative;}
    	.list img{width: 100%;-webkit-transition:.5s ease;-moz-transition:.5s ease;transition:.5s ease;}
    	.list:hover img{-webkit-transform:scale(1.05);-moz-transform:scale(1.05);transform:scale(1.05);}
    	.animallist1{position: absolute;top: 38%;left: 47%;width: 25%;z-index: 10;}
    	.animallist2{position: absolute;top: 23%;left: 3%;width: 14%;}
    	.animallist3{position: absolute;top: 23%;left: 26%;width: 47%;z-index: 8;}
    	.animallist4{position: absolute;top: 3%;left: 15%;width: 15%;z-index: 10;}
    	.animallist5{position: absolute;top: 16%;left: 41%;width: 7%;z-index: 10;}
    	.animallist6{position: absolute;top: 5%;left: 67%;width: 11%;z-index: 10;}
    	.animallist7{position: absolute;top: 24%;left: 85%;width: 10%;}
    	.animallist8{position: absolute;top: 51%;left: 7%;width: 25%;}
    	.animallist9{position: absolute;top: 45%;left: 78%;width: 20%;}
    	.animallist10{position: absolute;top: 80%;left: 76%;width: 14%;}
    	.animallist11{position: absolute;top: 66%;left: 59%;width: 13%;}
    	.animallist12{position: absolute;top: 80%;left: 32%;width: 14%;}
    	.animallist13{position: absolute;bottom: 0%;left: 10%;width: 18%;}

    	.imgBg{ width: 100%;}
    	.images{width: 100%;height: 100%;}
    	.banners{width: 90%;margin: 0 auto;padding-bottom: 20px;}
    	.swiper-slide img{width: 100%;border-radius: 5px;}
    	.swiper-pagination-bullet {width: 8px;height: 8px;display: inline-block;border-radius: 100%;background: #ead3b0;opacity: 1;color: #7b5c55;font-size: 0.9rem;}
    	@media screen and (max-width: 768px) {
       		.header{width: 90%;height: 55px;line-height: 55px;margin: 0 auto;}
    		.header .logol{width: 66.66px;height: 44.66px;}
    		.header .logor{width: 66.66px;height: 44.66px;}
   		}
    </style>
    <body class="HolyGrail">
    	<div class="header">
    		<a href=""><div class="logol"><img src="./images/logo2.png"></div></a>
    		<a href="https://www.wennoanimal.com"><div class="logor"><img src="./images/logo1.png"></div></a>
            <div class="Lang">
                <select class="selectLang">
                    <option lang="zh-CN" value="1">中文简体</option>
                    <option lang="en" value="0">ENGLISH</option>
                    <option lang="zh-TW" value="2">中文繁體</option>
                </select>
            </div>
    	</div>
    	<div class="main">
	        <div class="video">
	        	<a href="http://www.aplasticocean.movie/"><div class="more moreimg">{{ __('aplasticocean.learn') }} <img src="./images/link.png"></div></a>
	            <div class="videoBox">
	            	<video poster="./images/bg2.png" id="myvideo" muted controls="controls" autoplay="autoplay">
	                  	<source  src="https://www.wennoanimal.com/uploads/files/APO_Kids_Version_Cantonese.mp4" type="video/mp4" />
	                        {{ __('aplasticocean.tag') }}
	                </video> 
	                <!-- <img class="play" src="./images/playv.png"> -->
	            	<!-- <video id="myvideo" src="https://outin-1fda0e34335d11e98d8200163e1a625e.oss-cn-shanghai.aliyuncs.com/fc2fa607b2a94a8494637e66ec9aa6bb/f09e4f84f496476d84a14c1c8dda0378-486e6ec1e6947cf9597e4a2d269f9c1f-ld.mp4?Expires=1583738871&OSSAccessKeyId=LTAI8bKSZ6dKjf44&Signature=Wo9x2fHl1zYU290dOu3y8K1FHHg%3D" controls="controls" >
		                your browser does not support the video tag
		            </video> -->
	            </div>
	            <div class="more">{{ __('aplasticocean.notice') }}</div>
	        </div>
    		<div class="textinfo">
    			<p>{{ __('aplasticocean.title') }}</p>
    			<p>{{ __('aplasticocean.info1') }}</p>
    			<p>{{ __('aplasticocean.info2') }}</p>
                <p>{{ __('aplasticocean.info3') }}</p>
    			<p>{{ __('aplasticocean.info4') }}</p>
    		</div>
    		<div class="animal">
    			<div class="imgBg"><img class="images" src="./images/bg.png"></div>
    			<a href="https://www.wennoanimal.com/animals/database?product_name=Great_White_Shark"><div class="list animallist1"><img src="./images/animal1.png"></div>
    			<a href="https://www.wennoanimal.com/animals/database?product_name=Great_White_Shark"><div class="list animallist2"><img src="./images/animal2.png"></div></a>
    			<a href="https://www.wennoanimal.com/animals/database?product_name=Common_Bottlenose_Dolphin"><div class="list animallist3"><img src="./images/animal3.png"></div></a>
    			<a href="https://www.wennoanimal.com/animals/database?product_name=KILLER_WHALE_EM"><div class="list animallist4"><img src="./images/animal4.png"></div></a>
    			<a href="https://www.wennoanimal.com/animals/database?product_name=Copperband_Butterflyfish"><div class="list animallist5"><img src="./images/animal5.png"></div></a>
    			<a href="https://www.wennoanimal.com/animals/database?product_name=Reef_Manta_Ray"><div class="list animallist6"><img src="./images/animal6.png"></div></a>
    			<a href="https://www.wennoanimal.com/animals/database?product_name=POWDER-BLUE_SURGEONFISH"><div class="list animallist7"><img src="./images/animal7.png"></div></a>
    			<a href="https://www.wennoanimal.com/animals/database?product_name=Whale_Shark"><div class="list animallist8"><img src="./images/animal8.png"></div></a>
    			<a href="https://www.wennoanimal.com/animals/database?product_name=Humpback_Whale"><div class="list animallist9"><img src="./images/animal9.png"></div></a>
    			<a href="https://www.wennoanimal.com/animals/database?product_name=Hawksbill_Turtle"><div class="list animallist10"><img src="./images/animal10.png"></div></a>
    			<a href="https://www.wennoanimal.com/animals/database?product_name=Giant_Pacific_Octopus"><div class="list animallist11"><img src="./images/animal11.png"></div></a>
    			<a href="https://www.wennoanimal.com/animals/database?product_name=Green_Sea_Turtle"><div class="list animallist12"><img src="./images/animal12.png"></div></a>
    			<a href="https://www.wennoanimal.com/animals/database?product_name=HARBOR_SEAL"><div class="list animallist13"><img src="./images/animal13.png"></div></a>
    		</div>
			<div class="banners">
                <div class="swiper-slide">
                    <img src="./images/bg2.png">
                </div>
			    <!-- <div class="swiper-container">
			        <div class="swiper-wrapper">
			            <div class="swiper-slide">
			                <img src="./images/bg2.png">
			            </div>
			        </div>
			        <div class="swiper-pagination"></div>
			    </div> -->
			</div>
    	</div>
    </body>
    <script src="../animal/js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="./animal/js/swiper.min.js" ></script>
    <script type="text/javascript">
    	$(function(){ 
    		// var mySwiper = new Swiper('.swiper-container', {
		    //     autoplay: 6000,//可选选项，自动滑动
		    //     loop : true,
		    //     pagination: {
	     //            el: '.swiper-pagination',
	     //            clickable: true,
	     //            dynamicBullets: true,
	     //        },
		    // });
            $(".selectLang").change(function(){
                var language = $(this).find("option:selected").attr("lang");
                sessionStorage.setItem('language',language);
                $.ajax({
                    url:'https://www.wennoanimal.com/api/setLocale?lang='+language,
                    type:'GET',
                    success:function(data) {
                        console.log(JSON.stringify(data));
                        if(data){
                            window.location.reload();
                        }
                    },
                    error:function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log(XMLHttpRequest.status+'  '+XMLHttpRequest.readyState+'  '+textStatus);
                    }
                });
            });
    	})
    </script>
</html>
