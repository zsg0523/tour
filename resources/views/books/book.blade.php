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
        .prevnromal{background:url(./images/up.png) 50% 50% no-repeat;background-size:24% auto;}
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
		window.onorientationchange=function(){
		    if(window.orientation==90||window.orientation==-90){
				(function rotate() {
					var orientation = window.orientation;
					var pd = null;
					function createPd() {
						if(document.getElementById('preventTran') === null) {
							var imgData = 'data:image/png;base64,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';
							pd = document.createElement('div');
							pd.setAttribute('id', 'preventTran');
							pd.style.position = 'fixed';
							pd.style.left = '0';
							pd.style.top = '0';
							pd.style.width = '100%';
							pd.style.height = '100%';
							pd.style.overflow = 'hidden';
							pd.style.backgroundColor = '#2e2e2e';
							pd.style.textAlign = 'center';
							pd.style.zIndex = '99999';
							document.getElementsByTagName('body')[0].appendChild(pd);
							var img = document.createElement('img');
							img.src = imgData;
							pd.appendChild(img);
							img.style.margin = '30px auto 20px'
							var br = document.createElement('br');
							var p = document.createElement('p');
							p.style.width = '100%';
							p.style.height = 'auto';
							p.style.fontSize = '22px';
							p.style.color = '#626262';
							p.style.lineHeight = '34px';
							p.style.textAlign = 'center';
							p.innerHTML = '为了您的良好体验,请将手机/平板竖屏操作';
							p.appendChild(br);
							p.innerHTML += '為了您的良好體驗,請將手機/平板豎屏操作';
							p.appendChild(br);
							p.innerHTML += 'For your good experience, please operate your phone/tablet vertical screen';
							pd.appendChild(p);
						}
					}
					if(orientation == 90 || orientation == -90) {
						if(pd == null && document.getElementById('preventTran') === null) createPd();
						document.getElementById('preventTran').style.display = 'block';
					}
					window.onorientationchange = function() {
						if(pd == null && document.getElementById('preventTran') == null) createPd();
						document.getElementById('preventTran').style.display = 'none';
						rotate();
					};
				})();
		    }
		}   		
    </script>
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
				        var url = 'http://47.75.178.168/api/books/'+parameter+'?include=contents';
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