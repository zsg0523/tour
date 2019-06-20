<!DOCTYPE html>
<html>
	<head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=no" />
		<meta charset="UTF-8">
		<title></title>
	</head>
    <link rel="stylesheet" href="../css/animalDetails.css">
    <script type="text/javascript" src="../js/orientationchange.js" ></script>
    <body class="database">
        <div id="database">
         	<header>
                <a class="back" href=""></a>                
                <img class="tipImg" src="../images/bear.png" >
         	</header>
         	<div class="record">
         		<div class="listen"></div>
         		<div class="talk"></div>
         	</div>         	
	        <div class="contentBox">
	         	<div class="content">
	         		<p class="animalName"> African Elephant</p>
	         	    <div class="Question">
	         	    	<div class="doYouKnow">
	         	    		<a><i>DO YOU KNOM</i></a>
	         	    	</div>
	         	    	<div class="problemTopic">
	         	    	   <span>The black bear actually comes in six colors:black,blone,red,blue,chocolate and cinnamon</span>
	         	    	</div>
	         	    </div>
	         	    <div class="detailsList">
	         	    	<ul class="upon">
	         	    		<li><a class="list_icon Scientific_Name"></a><span>Scientific Name: Users Americanus</span></li>
	         	    		<li><a class="list_icon family"></a><span>Family:Elephantidae</span></li>
	         	    		<li><a class="list_icon diet"></a><span>Diet:Herbivores</span></li>
	         	    		<li><a class="list_icon habitat"></a><span>Habitat:Prairie、Savannh</span></li>
	         	    		<li><a class="list_icon location"></a><span>Location:North America</span></li>
                            <li><a class="list_icon group-name"></a><span>Group name:Herd</span></li>
	         	    	    <li class="intermediate"></li>
	         	    	</ul>
	         	    </div>
	         	</div>         		
         	</div>

        </div>
    </body>
	<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/vue/2.2.3/vue.min.js"></script>
    <script>
		var vm = new Vue({
			el: "#database",
			data:{}
		});

 </script>
</html>
