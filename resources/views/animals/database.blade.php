<!DOCTYPE html>
<html>
	<head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=no" />
		<meta charset="UTF-8">
		<title></title>
	</head>
    <style>
		@media (max-width: 768px) {
		    .database {
		       flex-direction: column;
		       flex: 1;
		    }
		    .HolyGrail-nav,
		    .HolyGrail-ads,
		    .HolyGrail-content {
		     flex: auto;
		  }
		} 
		body,html{
		    margin:0px;
		    padding:0px;
		    font-family:Arial,'Times New Roman','Microsoft YaHei',SimHei;
		} 


		.database {
		    position:absolute;
		    display: flex;
		    width:100%;
		    height: 100%;
		    flex-direction: column;
		    /*background: rgba(210,191,171,1);*/
		}
        
        #database{
        	width:100%;
        	height:100%;
        	background:url(img/bj_map.png)50% 50% no-repeat;
        	background-size:100% 100%;
        }
		
		header{ 
			height:auto;
            width:100%;
		    margin:0px;
		    padding:0px;
            z-index:1;
        }   

        .tipImg{
        	width:100%;
            margin:0px;
            padding:0px;
        }

        .back{
        	z-index:3;
        	position:absolute;
        	width:50px;
        	height:50px;
        	left:3%;
        	top:2%;
        	background: url(../images/backBtn.png) 50% 50% no-repeat;
        	background-size:30% auto;
        }
			audio {
				display: block;
				margin-bottom: 10px;
			}
			
			#audio-container {
				padding: 20px 0;
			}
			
			.ui-btn {
				display: inline-block;
				padding: 5px 20px;
				font-size: 14px;
				line-height: 1.428571429;
				box-sizing: content-box;
				text-align: center;
				border: 1px solid #e8e8e8;
				border-radius: 3px;
				color: #555;
				background-color: #fff;
				border-color: #e8e8e8;
				white-space: nowrap;
				cursor: pointer;
				-webkit-user-select: none;
				-moz-user-select: none;
				-ms-user-select: none;
				user-select: none;
			}
			
			.ui-btn:hover,
			.ui-btn.hover {
				color: #333;
				text-decoration: none;
				background-color: #f8f8f8;
				border: 1px solid #ddd;
			}
			
			.ui-btn:focus,
			.ui-btn:active {
				color: #333;
				outline: 0;
			}
			
			.ui-btn.disabled,
			.ui-btn.disabled:hover,
			.ui-btn.disabled:active,
			.ui-btn[disabled],
			.ui-btn[disabled]:hover,
			.ui-state-disabled .ui-btn {
				cursor: not-allowed;
				background-color: #eee;
				border-color: #eee;
				color: #aaa;
			}
			
			.ui-btn-primary {
				color: #fff;
				background-color: #39b54a;
				border-color: #39b54a;
				position: fixed;
				bottom: 1.5rem;
				width: 80%;
				margin-left: 10%;
				padding: .5rem 0;
			}
			
			.ui-btn-primary:hover,
			.ui-btn-primary.hover {
				color: #fff;
				background-color: #16a329;
				border-color: #16a329;
			}
			
			.ui-btn-primary:focus,
			.ui-btn-primary:active {
				color: #fff;
			}
			
			.ui-btn-primary.disabled:focus {
				color: #aaa;
			}
			
			img {
				display: block;
				width: 40%;
				margin: auto;
			}
			
			body {
				margin: 0;
				padding: 0;
			}
			
			#mask {
				width: 43%;
				background: rgba(0, 0, 0, 0.05);
				padding: 3rem 0 1rem 0;
				display: none;
				margin: 2rem auto;
				margin-top: 51%;
			}
			
			#mask p {
				text-align: center;
				font-size: .8rem;
				color: rgba(0, 0, 0, 0.5);
			}
    </style>
    <body class="database">
        <div id="database">
         	<header>
                <a class="back" href=""></a>                
                <img class="tipImg" src="../images/bear.png" >
         	</header>
			<div id="mask">
				<img src="../images/5-121204193R0-50.gif" alt="">
				<p>录音中······</p>
			</div>
			<button id="start" class="ui-btn ui-btn-primary">按住  说话</button>
			<!-- <button id="stop" class="ui-btn ui-btn-primary" disabled>停止</button> -->
			<div id="audio-container"></div>
        </div>
    </body>
	<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/vue/2.2.3/vue.min.js"></script>
	<script src="../js/recorder.js"></script>
    <script>
		var vm = new Vue({
			el: "#database",
			data:{}
		});
		// window.onload = function(){
		var start = document.querySelector('#start');
		// var stop = document.querySelector('#stop');
		var container = document.querySelector('#audio-container');
		var recorder = new Recorder({
			sampleRate: 44100, //采样频率，默认为44100Hz(标准MP3采样率)
			bitRate: 128, //比特率，默认为128kbps(标准MP3质量)
			success: function() { //成功回调函数
				// start.disabled = false;
			},
			error: function(msg) { //失败回调函数
				alert(msg);
			},
			fix: function(msg) { //不支持H5录音回调函数
				alert(msg);
			}
		});
		var mask = document.getElementById('mask');
		var start = document.querySelector('#start');
		start.addEventListener('touchstart', function() {
			timer = setTimeout(function() {
				console.log(1);
				var audio = document.querySelectorAll('audio');
				for(var i = 0; i < audio.length; i++) {
					if(!audio[i].paused) {
						audio[i].pause();
					}
				}
				start.innerHTML = "松开  结束"
				mask.style.display = "block"
				recorder.start();
			}, 500);
		});
		start.addEventListener('touchmove', function() {
			timeOutEvent = setTimeout(function() {
				clearTimeout(timer);
				timer = 0;
			});
		})
		start.addEventListener("touchend", function(e) {
			console.log('touchend');
			recorder.stop();
			mask.style.display = "none"
			recorder.getBlob(function(blob) {
				var audioArr=container.getElementsByTagName("audio");
				if(audioArr.length!=0){
					console.log(URL.createObjectURL(blob));
					audioArr[0].src=URL.createObjectURL(blob);
					return;
				}else{
					console.log(URL.createObjectURL(blob));
					var audio = document.createElement('audio');
					audio.src = URL.createObjectURL(blob);
					audio.controls = true;
					container.appendChild(audio);					
				}
			});
			start.innerHTML = "按住  说话"
			clearTimeout(timer);
			return false;
		});
 </script>
</html>
