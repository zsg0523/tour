<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=no" />
    <meta http-equiv="cache-control" content="no-cache, must-revalidate">
    <meta http-equiv="expires" content="0">
    <meta content="yes" name="apple-mobile-web-app-capable">
	<meta content="black" name="apple-mobile-web-app-status-bar-style">
	<meta content="telephone=no" name="format-detection">
    <meta name="screen-orientation" content="portrait">
    <meta name="x5-orientation" content="portrait">
    <title>Wenno</title>
    <style>
		@media screen and (max-width: 1600px) {
		    html{font-size: 2.4rem;}
		}
		@media screen and (max-width: 1200px) {
		    html{font-size: 1.6rem;}
		}
		@media screen and (max-width: 800px) {
		    html{font-size: 1rem;}
		}
		@media screen and (max-width: 600px) {
		    html{font-size: 0.8rem;}
		}
		* {margin: 0;padding: 0;}
		li{list-style: none;}
		html,body {padding: 0 !important;padding: 0;width: 100%;height: 100%;overflow: hidden;-webkit-tap-highlight-color: rgba(0, 0, 0, 0);}
		#header {position: absolute;top: 0;width: 100%;height: 80px;background: #e2c8a4;line-height:80px;text-align: center;}/*background: #fff6e9 url(./images/map_bg.png)50% 0% no-repeat;background-size:100% auto;*/
		#middle {position: absolute!important;top:80px!important;height: auto!important;position: relative;top: -80px;height: 100%;bottom: 70px;width: 100%;text-align: center;overflow: auto;background: #fff6e9 url(./images/map_bg.png)50% 0% no-repeat;background-size:100% auto;}
		.middleBox{width:100%;height:100%;position:relative;}/*background:url(./images/africa.png)106% 94% no-repeat;background-size:auto 20%;*/
		.imgBox{position:absolute;height:22%;width:40%;bottom:6%;right:0%;}
		.imgMap{display:block;height:100%;float:right;margin-right:0px;}
		#footer {position: absolute;bottom: 0;width: 100%;height:70px;background: #e2c8a4;line-height:70px;text-align: center;}
		#header a,.contentBox a{display:block;}
		.headerIconL{background:url(./images/logo.png) 100% 50% no-repeat;background-size: auto 50%;}
		.headerIconL,.headerIconR{width:25%;height:80px;}
		#header p{width:50%;max-width:70%;float:left;color:#7b5c55;font-size:1em;font-weight:550;padding:0px;margin:0px;overflow: hidden;text-overflow: ellipsis;display: box;display: -webkit-box;-webkit-line-clamp:1;-webkit-box-orient: vertical;}
		#footer p{width:100%;color:#835c61;font-size:0.9em;overflow: hidden;text-overflow: ellipsis;display: box;display: -webkit-box;-webkit-line-clamp:1;-webkit-box-orient: vertical;}
        .title{width:100%;height:12%;position:relative;}
        .title p{position:absolute;background:#b98857;padding:0.3rem 0.8rem 0.4rem 0.8rem;font-size:1rem;border-radius:1rem;color:#fff;display:block;top:50%;left:50%;-webkit-transform:translate(-50%,-50%);transform:translate(-50%,-50%);}
        .nav{width:100%;height:73%;}
        .left{float:left;}
        .right{float:right;}
        .content{width:100%;height:15%;background:url(./images/ani.png)50% 100% no-repeat;background-size:94% auto;}
        .prev,.next{width:18%;height:100%;}
        .prevnromal{background:url(./images/prev.png) 50% 50% no-repeat;background-size:24% auto;}
        .nextnromal{background:url(./images/next.png) 50% 50% no-repeat;background-size:24% auto;}
        .prevlock{background:url(./images/up_no.png) 50% 50% no-repeat;background-size:24% auto;}
        .nextlock{background:url(./images/next_no.png) 50% 50% no-repeat;background-size:24% auto;}
        .photo{width:62%;height:100%;float:left;position:relative;}
        .photo li{position:absolute;width:100%;display:block;top:50%;left:50%;-webkit-transform:translate(-50%,-50%);transform:translate(-50%,-50%);float:left;overflow: hidden;}
        .photo li img.images{width: auto;height: auto;max-width: 80%;max-height: 90%; border:4px solid #fff;border-radius:8px;display: block;margin:0px auto;}
        .audioBox{width:60%;height:62%;line-height:62%;margin:0px auto;position:relative;}
        .audioBox .text{width:84%;height:90%;line-height:90%;margin-left:16%;position: relative;display:block;color:#b98857;font-size:1rem;}
        .text p{position:absolute;/*font-size:1rem;*/border-radius:1rem;color:#b98857;display:block;top:50%;left:21%;-webkit-transform:translate(-50%,-21%);transform:translate(-50%,-21%);}
        .btn-audio{position:absolute;left:0px;top:0px;width:18%;height:100%;background:url(./images/transmit.png) no-repeat 30% 60%;background-size:auto 60%;}
   </style>
    <script type="text/javascript">
   		document.addEventListener('plusready', function(){
   			//console.log("所有plus api都应该在此事件发生后调用，否则会出现plus is undefined。"src="img/africa.png"
   		});  		
    </script>
    <script type="text/javascript" src="./js/orientationchange.js" ></script>
</head>
<body>
	<div id="weenoBox">
	    <div id="header">
	       <a class="headerIconL left"></a>
	       <p>WENNO-BOOKS</p>
	       <a class="headerIconR right"></a>
	    </div>
	    <div id="middle">
			<div class="middleBox">
				<div class="imgBox">
					<img class="imgMap" :src="imgMap">
				</div>
				<div class="title">
					<p>@{{message}}</p>
				</div>
				<div class="nav">
					<div :class="prevLeft" id="prev" @click="isPrevClick&&prevHandler()"></div>
					<div class="photo">
					    <li><img class="images" :src="images[currentIndex].image" v-bind:length="images.length" alt="" @click="imgHandler"></li>
					</div>
				    <div :class="nextRight" id="next"  @click="isNextClick&&nextHandler()"></div>				
				</div>
				<div class="content">
					<div class="audioBox">
						<!--<div class="btn-audio" @click="audioPlay"></div>-->
						<div class="btn-audio" @click="audioPlay"><audio id="mp3Btn" ref="audio"   hidden="true"  :src="images[currentIndex].file" v-bind:length="images.length"></audio></div>
					    <div class="text">
					    	<p>Read story</p>
					    </div>
					</div>
				</div>				
			</div>
	    </div>
	    <div id="footer">
	       <p>2016-2019 Wenno 版权所有</p>
	    </div>
	</div>
	<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/vue/2.2.3/vue.min.js"></script>
    <script>
		let vm = new Vue({   // 声明变量  实例化一个对象vm(指的是vue的实例)  controls autoplay="autoplay" hidden="true"<!--autoplay="autoplay"controls-->
	        el:"#middle",    //绑定根元素
	        data:{
	        	images:[],
                message: '',
                imgMap:'',
                prevLeft:'prev left',
                nextRight:'next right',
                isPrevClick:false,
                isNextClick:true,
                currentIndex:0 //一开始设置为 0
	        },
			watch: {
			    images: function() {
			        this.$nextTick(function(){
			          /*现在数据已经渲染完毕*/
					    console.log();
			        })
			    }
			},
	        methods:{// 对象内容是js函数
	            prevHandler(e) {
	                console.log(e);
	                this.currentIndex--;
	                this.isNextClick=true;//解方下一页点击事件
	                if (this.currentIndex == 0) { //js的if判断语句
                        this.isPrevClick=false;
                        this.prevLeft = 'prev left prevlock';
                        this.nextRight = 'next right nextnromal';
//                      return;
	                }else{
	                	this.prevLeft = 'prev left prevnromal';
	                	this.nextRight = 'next right nextnromal';
	                }
//	                this.$options.methods.audioPlay();
                    $('.btn-audio').css({'background':'url(./images/transmit.png) no-repeat 30% 60%','background-size':'auto 60%'});
	            },	           
	            nextHandler(e){
	                this.currentIndex++;
	                this.isPrevClick=true;//解方上一页点击事件
	                if (this.currentIndex == this.length-1){ //js的if判断语句
                        this.isNextClick=false;
                        this.prevLeft = 'prev left prevnromal';
                        this.nextRight = 'next right nextlock';
//                      return;
	                }else{
	                	this.prevLeft = 'prev left prevnromal';
	                	this.nextRight = 'next right nextnromal';
	                }
//                 this.$options.methods.audioPlay();
                   $('.btn-audio').css({'background':'url(./images/transmit.png) no-repeat 30% 60%','background-size':'auto 60%'});
	            },
	            imgHandler(e){ //每一个事件都有一个event对象, 冒泡阻止默认事件学的
	                console.log(e.target);//当前目标对象 <img src="img/1.jpg" alt>
	                console.log(this); //实例化里面的对象this 指的都是当前实例化对象
	            },
	            audioPlay(e){//点击播放音频
	            	console.log(this); //实例化里面的对象this 指的都是当前实例化对象
	            	var audio = document.getElementById('mp3Btn');
					audio.onplay = function(){
					    console.log("视频已经开始播放");
					    $('.btn-audio').css({'background':'url(./images/play.png) no-repeat 30% 60%','background-size':'auto 60%'});
					};
	            	$('#mp3Btn').on('ended', function(){
	            		console.log("音频已播放完成");
	            	    $('.btn-audio').css({'background':'url(./images/transmit.png) no-repeat 30% 60%','background-size':'auto 60%'});
	            	});
	            	//var audio = document.getElementById('mp3Btn');
	            	e.stopPropagation();//防止冒泡
	            	if(audio.paused){ //如果当前是暂停状态
	            		$('.btn-audio').css({'background':'url(./images/play.png) no-repeat 30% 60%','background-size':'auto 60%'});
	                    audio.play(); //播放
	                    return;
	                }else{
	                	$('.btn-audio').css({'background':'url(./images/stop.png) no-repeat 30% 60%','background-size':'auto 60%'});
	                    audio.pause(); //暂停
	                }
	            },
	            getData(){//AJAX是异步函数（关于异步可以去看我上一篇博客），它的回调函数执行环境是全局作用域，所以在getData中AJAX的this指向的是window。这有两个解决方法，一个是像我这样的用self把this存起来，还有一种就是用箭头函数this绑定。
	            	let self = this;
	            	function GetQueryString(name){
						var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
						var r = window.location.search.substr(1).match(reg);
						if(r!=null)return unescape(r[2]); return null;
					}
					var parameter = GetQueryString("book");
				    if(!isNaN(parameter)){
				       // alert(parameter +"是数字");					
				        var url = '/api/books/'+parameter+'?include=contents';
	                    // var url = 'http://wennoanimal.test/api/books/'+parameter+'?include=contents';
						$.ajax({
					        url:url,
					        type:'GET',
					        success:function(data) {
	//				            console.log(JSON.stringify(data));
					            self.message = data.name;
					            self.images = data.contents.data;
					            self.imgMap = data.map;
					            self.length = data.contents.data.length;
					            if(data.contents.data.length==1){
					               self.prevLeft = 'prev left prevlock';
					               self.nextRight = 'next right nextlock';
					            }else{
					               self.prevLeft = 'prev left prevlock';
					               self.nextRight = 'next right nextnromal';				            	
					            }
					        },
					        error:function(XMLHttpRequest, textStatus, errorThrown) {
					            console.log(XMLHttpRequest.status);
					            console.log(XMLHttpRequest.readyState);
					            console.log(textStatus);
					        }
					    });
				    } else{
				        alert("error");
				        return;
				    }
	            }
	        },
	        created:function(){
	        	var that=this;
	        	that.getData();
	        }
		});

	</script>
</body>
</html>