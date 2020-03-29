<!DOCTYPE html>
<html>
	<head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=no" />
		<meta charset="UTF-8">
		<title>Wenno X A Plastic Ocean</title>
	</head>
    <link rel="stylesheet" href="./animal/css/swiper.min.css" />
    <style type="text/css">
    	a {text-decoration: none;background-color: transparent;}
		a:hover {text-decoration: none;}
		a:not([href]) {color: inherit;text-decoration: none;}
		a:not([href]):hover {color: inherit;text-decoration: none;}
    	.HolyGrail{width: 100%;height: 100%;margin: 0;padding: 0;font-family:"Arial";} /*Arial, Helvetica, sans-serif*/
    	.header{max-width:1700px;width: 90%;max-width:1000px;height: 80px;line-height: 80px;margin: 0 auto;}
    	.header .logol{float: left;width: 100px;height: 67px;}
    	.header .logor{float: left;width: 100px;height: 67px;margin-left: 10px;}
    	.header img{width: 100%;height: 100%;vertical-align: middle;}
        .Lang{float: right;}
        select{border-radius: .3rem;color: #7b5c55;height:35px;line-height:35px;font-size: .67rem;text-align: left;background: #fff;background-size: 8px 5px;}
    	.main{width: 100%;height:100%;background-color: #d3edfb;padding-top: 20px;}
    	.main .video{width: 90%;max-width:1000px;margin: 0 auto;text-align: center;border-radius:5px;overflow: hidden;}
    	.more{margin: 0;text-align: right;height: 35px;line-height: 35px;background: #fff;padding-right: 15px;color: #333;}
    	.more img{width: 21px;height: 21px;vertical-align: middle;}
	    .videoBox{width:100%;height:100%;margin:0px auto;position:relative;display: -ms-flexbox;display: -webkit-flex;display: flex;-webkit-box-pack: center;-ms-flex-pack: center;-webkit-justify-content: center; justify-content: center;-webkit-box-align: center;-ms-flex-align: center;-webkit-align-items: center;align-items: center;font-size:3rem;color:#fff;}
	   	.videoBox video{width: 100%;}
	   	.play{width:60px;height: 60px;position: absolute;top: 45%;left: 45%;}

    	.main .textinfo{width: 90%;max-width:1000px;margin: 20px auto;background-color: #697ac3;color: #fff;border-radius: 5px;padding: 10px 0;}
    	.textinfo p{margin: 0;font-size: 0.9rem;line-height: 30px;padding: 0 10px;}
    	.textinfo p.title{font-size: 1rem;line-height: 45px;text-decoration: underline;}

        .animal_info{width: 90%;max-width:1000px;margin: 20px auto;}
        .tip{width: 100%;}
        .textTitle{text-align: center;}
        .textTitle p{font-size: 1.4rem;line-height: 40px}
        .textTitle p:last-child{font-size: 1.15rem;line-height: 35px;}

        .tip p{line-height: 35px;margin: 0;padding: 0 10px;background-color: #fff;}
        .tip p:first-child{font-size: 1rem;background-color: #3596F8;line-height: 50px;color: #fff;border-radius: 5px 5px 0 0;}
    	.animal{width: 100%;position: relative;}
    	.list img{width: 100%;-webkit-transition:.5s ease;-moz-transition:.5s ease;transition:.5s ease;}
    	.list:hover img{-webkit-transform:scale(1.2);-moz-transform:scale(1.2);transform:scale(1.2);}
    	.animallist1{position: absolute;top: 38%;left: 47%;width: 25%;z-index: 10;}
    	.animallist2{position: absolute;top: 23%;left: 3%;width: 14%;}
    	.animallist3{position: absolute;top: 33%;left: 26%;width: 20%;z-index: 8;}
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

        .list .bg{position: absolute;top:0;left:5%;width: 90%;display: none;}
        .list .bg1{top: -22%;}
        .list .bg2{top: -30%;}
        .list .bg3{top: -26%;}
        .list .bg4{width: 120%;}
        .list .bg5{width: 200%;left: -50%;top: -35%;}
        .list .bg6{width: 150%;left: -25%;top: -10%;}
        .list .bg7{width: 130%;left: -15%;top: -50%;}
        .list .bg8{width: 80%;left: 10%;top: -30%;}
        .list .bg9{top: -20%;}
        .list .bg10{width: 110%;left: -5%;top: -60%;}
        .list .bg11{width: 120%;left: -10%;}
        .list .bg12{width: 100%;left: 0%;top: -40%;}
        .list .bg13{top: -10%;}
        .list:hover .bg{display: inline-block;}
        .list .bg img{width: 100%;}
        .list .bg span{position: absolute;bottom: 5%;width: 95%;color:#fff;font-size: 0.75rem;text-align: center;z-index: 20;}
        .list .bg10 span{top: 5%;}
        .list .bg12 span{top: 5%;}
        .list .bg13 span{top: 5%;}

    	.imgBg{ width: 100%;}
    	.images{width: 100%;height: 100%;}
    	.banners{width: 90%;max-width:1000px;margin: 0 auto;padding-bottom: 20px;}
        .swiper-slide{position: relative;}
    	.swiper-slide img{width: 100%;border-radius: 5px;}
        .goBuy{position: absolute;right: 5.7%;bottom: 5.3%;width: 16%;height: 9%;}
    	.swiper-pagination-bullet {width: 8px;height: 8px;display: inline-block;border-radius: 100%;background: #ead3b0;opacity: 1;color: #7b5c55;font-size: 0.9rem;}
    	@media screen and (max-width: 768px) {
       		.header{width: 90%;height: 55px;line-height: 55px;margin: 0 auto;}
    		.header .logol{width: 66.66px;height: 44.66px;}
    		.header .logor{width: 66.66px;height: 44.66px;}
   		}
    </style>
    <body class="HolyGrail">
    	<div class="header">
    		<a href="http://www.aplasticocean.foundation/"><div class="logol"><img src="./images/logo2.png"></div></a>
    		<a href="https://www.wennoanimal.com"><div class="logor"><img src="./images/logo1.png"></div></a>
            <div class="Lang">
                <select class="selectLang" onchange="setLocale()">
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
	            	<video id="myvideo" muted controls="controls" autoplay="autoplay">
	                  	<source  src="https://www.wennoanimal.com/uploads/files/APO_Kids_Version_Cantonese.mp4" type="video/mp4" />
	                        {{ __('aplasticocean.tag') }}
	                </video>
	            </div>
	            <div class="more">{{ __('aplasticocean.notice') }}</div>
	        </div>
    		<div class="textinfo">
                <div class="textTitle">
                    <p>{{ __('aplasticocean.toptitle1') }}</p>
                    <p>{{ __('aplasticocean.toptitle2') }}</p>
                </div>
                <br>
                <div>
        			<p>{{ __('aplasticocean.top1') }}</p>
                </div>
                <br>
                <div>
                    <p class="title">{{ __('aplasticocean.title1') }}</p>
                    <p>{{ __('aplasticocean.titleinfo1') }}</p>
                </div>
                <br>
                <div>
                    <p class="title">{{ __('aplasticocean.title2') }}</p>
                    <p>{{ __('aplasticocean.titleinfo1') }}</p>
                </div>
                <br>
                <div>
                    <p class="title">{{ __('aplasticocean.title') }}</p>
                    <p>{{ __('aplasticocean.info1') }}</p>
                    <p>{{ __('aplasticocean.info2') }}</p>
                    <p>{{ __('aplasticocean.info3') }}</p>
                </div>
    		</div>
            <div class="animal_info">
                <div class="tip">
                    <p>{{ __('aplasticocean.tip') }}</p>
                    <p>{{ __('aplasticocean.tip1') }}</p>
                </div>
        		<div class="animal">
        			<div class="imgBg"><img class="images" src="./images/bg.png"></div>
                    <div class="list animallist1">
                        <div class="bg bg1">
                            <a href="https://www.wennoanimal.com/animals/database?product_name=Great_White_Shark">
                                <span>{{__('aplasticocean.animal1')}}</span>
                            </a>
                                <img src="./images/circle.png">
                            </div>
                        <img src="./images/animal1.png">
                    </div>
                    <div class="list animallist2">
                        <div class="bg bg2">
                            <a href="https://www.wennoanimal.com/animals/database?product_name=Great_White_Shark">
                                <span>{{__('aplasticocean.animal2')}}</span>
                            </a>
                            <img src="./images/circle.png">
                        </div>
                        <img src="./images/animal2.png">
                    </div>
                    <div class="list animallist3">
                        <div class="bg bg3">
                            <a href="https://www.wennoanimal.com/animals/database?product_name=Common_Bottlenose_Dolphin">
                                <span>{{__('aplasticocean.animal3')}}</span>
                            </a>
                            <img src="./images/circle.png">
                        </div>
                        <img src="./images/animal3.png">
                    </div>
                    <div class="list animallist4">
                        <div class="bg bg4">
                            <a href="https://www.wennoanimal.com/animals/database?product_name=KILLER_WHALE_EM">
                                <span>{{__('aplasticocean.animal4')}}</span>
                            </a>
                            <img src="./images/circle.png">
                        </div>
                        <img src="./images/animal4.png">
                    </div>
                    <div class="list animallist5">
                        <div class="bg bg5">
                            <a href="https://www.wennoanimal.com/animals/database?product_name=Copperband_Butterflyfish">
                                <span>{{__('aplasticocean.animal5')}}</span>
                            </a>
                            <img src="./images/circle.png">
                        </div>
                        <img src="./images/animal5.png">
                    </div>
                    <div class="list animallist6">
                        <div class="bg bg6">
                            <a href="https://www.wennoanimal.com/animals/database?product_name=Reef_Manta_Ray">
                                <span>{{__('aplasticocean.animal6')}}</span>
                            </a>
                            <img src="./images/circle.png">
                        </div>
                        <img src="./images/animal6.png">
                    </div>
                    <div class="list animallist7">
                        <div class="bg bg7">
                            <a href="https://www.wennoanimal.com/animals/database?product_name=POWDER-BLUE_SURGEONFISH">
                                <span>{{__('aplasticocean.animal7')}}</span>
                            </a>
                            <img src="./images/circle.png">
                        </div>
                        <img src="./images/animal7.png">
                    </div>
                    <div class="list animallist8">
                        <div class="bg bg8">
                            <a href="https://www.wennoanimal.com/animals/database?product_name=Whale_Shark">
                                <span>{{__('aplasticocean.animal8')}}</span>
                            </a>
                            <img src="./images/circle.png">
                        </div>
                        <img src="./images/animal8.png">
                    </div>
                    <div class="list animallist9">
                        <div class="bg bg9">
                            <a href="https://www.wennoanimal.com/animals/database?product_name=Humpback_Whale">
                                <span>{{__('aplasticocean.animal9')}}</span>
                            </a>
                            <img src="./images/circle.png">
                        </div>
                        <img src="./images/animal9.png">
                    </div>
                    <div class="list animallist10">
                        <div class="bg bg10">
                            <a href="https://www.wennoanimal.com/animals/database?product_name=Hawksbill_Turtle">
                                <span>{{__('aplasticocean.animal10')}}</span>
                            </a>
                            <img src="./images/circle.png">
                        </div>
                        <img src="./images/animal10.png">
                    </div>
                    <div class="list animallist11">
                        <div class="bg bg11">
                            <a href="https://www.wennoanimal.com/animals/database?product_name=Giant_Pacific_Octopus">
                                <span>{{__('aplasticocean.animal11')}}</span>
                            </a>
                            <img src="./images/circle.png">
                        </div>
                        <img src="./images/animal11.png">
                    </div>
                    <div class="list animallist12">
                        <div class="bg bg12">
                            <a href="https://www.wennoanimal.com/animals/database?product_name=Green_Sea_Turtle">
                                <span>{{__('aplasticocean.animal12')}}</span>
                            </a>
                            <img src="./images/circle.png">
                        </div>
                        <img src="./images/animal12.png">
                    </div>
                    <div class="list animallist13">
                        <div class="bg bg13">
                            <a href="https://www.wennoanimal.com/animals/database?product_name=HARBOR_SEAL">
                                <span>{{__('aplasticocean.animal13')}}</span>
                            </a>
                            <img src="./images/circle.png">
                        </div>
                        <img src="./images/animal13.png">
                    </div>
        		</div>
            </div>
			<div class="banners">
                <div class="swiper-slide">
                    <img src="" id="banner">
                    <a href="https://www.wennoanimal.com/products/75" class="goBuy"></a>
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
        function getQueryString(name){
            var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
            var r = window.location.search.substr(1).match(reg);
            if (r!=null) return r[2]; return '';
        }
    	$(function(){ 
    		var mySwiper = new Swiper('.swiper-container', {
                autoplay: 6000,//可选选项，自动滑动
                loop : true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                    dynamicBullets: true,
                },
            });
            var lang = getQueryString("language");
            var language = sessionStorage.getItem('language');
            console.log('lang: '+lang+ ' language: '+language);
            if(lang!=''){
                $(".selectLang").find("option[lang='"+lang+"']").attr("selected",true);
                setLocale();
            }else if(language!=null){
                $(".selectLang").find("option[lang='"+language+"']").attr("selected",true);
                if(language=='zh-CN'){
                    $("#banner").attr('src','./images/bannerC.png');
                }else if(language=='zh-TW'){
                    $("#banner").attr('src','./images/bannerW.png');
                }else if(language=='en'){
                    $("#banner").attr('src','./images/bannerE.png');
                }
            }else{
                $(".selectLang").find("option[lang='en']").attr("selected",true);
                $("#banner").attr('src','./images/bannerE.png');
            }
    	})
        function setLocale(){
            var language = $('.selectLang').find("option:selected").attr("lang");
            sessionStorage.setItem('language',language);
            if(language=='zh-CN'){
                $("#banner").attr('src','./images/bannerC.png');
            }else if(language=='zh-TW'){
                $("#banner").attr('src','./images/bannerW.png');
            }else if(language=='en'){
                $("#banner").attr('src','./images/bannerE.png');
            }
            $.ajax({
                url:'/api/setLocale?lang='+language,
                type:'GET',
                success:function(data) {
                    console.log(JSON.stringify(data));
                    if(data){
                        // window.location.reload();
                        window.location.href = 'https://www.wennoanimal.com/aplasticocean';
                    }
                },
                error:function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log(XMLHttpRequest.status+'  '+XMLHttpRequest.readyState+'  '+textStatus);
                }
            });
        }
    </script>
</html>
