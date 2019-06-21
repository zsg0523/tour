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
            <div class="contentBox">
            	<div class="record">
	          		<div class="listen">
	          			<audio id="mp3Btn"  hidden="true" ></audio>
	          		</div>
	         		<div class="talk">
	         			<audio id="mp3Btn"  hidden="true" ></audio>
	         		</div>           		
            	</div>
            	<div class="title">
            		<p class="animalName"> African Elephant</p>
            	</div>
         	    <div class="Question">
         	    	<div class="doYouKnow">
         	    		<a><i>DO YOU KNOM</i></a>
         	    	</div>
         	    	<div class="problemTopic">
         	    	   <span>The black bear actually comes in six colors:black,blone,red,blue,chocolate and cinnamon</span>
         	    	</div>
         	    </div>
                <div class="detailsList">
                	<ul>
         	    		<li><a class="list_icon Scientific_Name"></a><span>Scientific Name: Users Americanus</span></li>
         	    		<li><a class="list_icon family"></a><span>Family:Elephantidae</span></li>
         	    		<li><a class="list_icon diet"></a><span>Diet:Herbivores</span></li>
         	    		<li><a class="list_icon habitat"></a><span>Habitat:Prairie、Savannh</span></li>
         	    		<li><a class="list_icon location"></a><span>Location:North America</span></li>
                        <li><a class="list_icon group-name"></a><span>Group name:Herd</span></li>
         	    	    <li class="intermediate">
         	    	       <p>
         	    	          <a class="lifespan">Lifespan:Up to 70 years</a>
         	    	          <a class="classification">Classification:Mammal</a>
         	    	       </p>
         	    	    </li>
         	    	    <li><a class="list_icon weight"></a><span>Weight:2.5 to 7 tons</span></li>
         	    	    <li><a class="list_icon size"></a><span>Size:Height at the shoulder,8.2 to 13 ft</span></li>
         	    	    <li><a class="list_icon speed"></a><span>Top Speed:40km/h</span></li>
         	    	    <li><a class="list_icon Endangered "></a><span>Endangered level:Vulnerable</span></li>
	         	    </ul>
	                <div class="bottom">
	                	<div class="bottom_box">
	                		<div class="bottom_title">
	                			ABOUT THE AFRICAN ELEOHANT
	                		</div>
	                		<span class="bottom_content">
	                			Elephant, English Elephant, long nose, elephant, common name.
The elephant is now the largest terrestrial mammal in the world. Elephants are social animals. They are family-based and heads of females. The time of daily activities, course of action, foraging sites, and habitats are all directed by females. Sometimes several elephant groups gather to form hundreds of elephants. Ivory is an important weapon against the enemy.
	                		</span>
	                	</div>
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
