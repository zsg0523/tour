<!DOCTYPE html>
<html>
	<head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=no" />
		<meta charset="UTF-8">
		<title>{{ __('animals.page-title') }}</title>
	</head>
    <link rel="stylesheet" href="./animal/css/swiper.min.css" />
    <!-- <link rel="stylesheet" href="./animal/css/animalIndex.css"> -->
    <script type="text/javascript" src="./animal/js/orientationchange.js" ></script>
    <body class="HolyGrail">
        <div  id="HolyGrailBody">
			<div id="Loading" v-show="Loading">
				<div class="loader-inner ball-beat">
					<div></div>
					<div></div>
					<div></div>
				</div>
			</div>
        </div>
    </body>
    <script src="./animal/js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="./animal/js/swiper.js" ></script>
    <script src="./animal/js/vue.min.js"></script>
    <script>
		var vm = new Vue({
			el: "#HolyGrailBody",
			data:{
				Loading:false,
			},
			methods:{
                getSwiper(){
                    var self = this;          
                    function GetQueryString(name){
                        var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
                        var r =  window.location.search.substr(1).match(reg);
                        if(r!=null){
                        	return r[2]; 
                        }else{
                        	return null;
                        }
                    }
                    var theme = decodeURI(GetQueryString('theme'));
                    var lang = GetQueryString('lang');
                    var language = sessionStorage.getItem('language');
                    console.log('language: '+language+' lang: '+lang+' theme: '+theme);

                    self.Loading = true;
                    let newLang = 'en';
                    let newTheme = '';

                    var url = '/api/animals?lang=en&include=sound,animal';
                    if(!theme||theme=='null'){
                          if(lang==null){
                          	   if(language==null){
			                    }else{
			                    	newLang = language;                    	
			                    }
                          }else{
                          		newLang = lang;
                          }
                    }else{
                    	if(lang==null){
                             if(language==null){                              
                             }else{
                             	newLang = language;
                    			newTheme = theme;
                             }
                    	}else{
                    		newLang = lang;
                    		newTheme = theme;
                    	}
                    }
                    setTimeout(function(){
                        self.Loading = false;
                        window.location.replace("https://www.wennoanimal.com/website/#/AnimalLibrary?theme="+newTheme+"&lang="+newLang);
                    },1000);
                }
			},
			mounted:function(){
	        	var that=this;
	        	that.getSwiper();
	        },
		});
    </script>
</html>
