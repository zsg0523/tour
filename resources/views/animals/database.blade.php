<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=no" />
        <meta charset="UTF-8">
        <title></title>
    </head>
    <!-- <link rel="stylesheet" href="../animal/css/animalDetails.css"> -->
    <script type="text/javascript" src="../animal/js/orientationchange.js" ></script>
    <body class="database">
        <div id="database">
            <div id="Loading" v-show="Loading">
                <div class="loader-inner ball-beat">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>
    </body>
    <script src="../animal/js/jquery-3.4.1.min.js"></script>
    <script src="../animal/js/vue.min.js"></script>
    <script>
        var vm = new Vue({
            el: "#database",
            data:{
                Loading:false,
            },
            methods:{              
                animalsInfo(){
                    var self = this;
                    function GetQueryString(name){
                        var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
                        var r = window.location.search.substr(1).match(reg);
                        if(r!=null)return unescape(r[2]); return null;
                    }
                    var lang = GetQueryString("lang");
                    var language = sessionStorage.getItem('language');
                    var theme1 = GetQueryString("theme_id");
                    var theme_id;
                    if(theme1==null||theme1==''){
                        theme_id = '';
                    }else{
                        theme_id = theme1;
                    }
                    self.Loading = true;
                    let newLang = 'en';
                    let newTheme_id = theme_id;
                    console.log('language: '+language+'  lang: '+lang+' theme_id: '+theme_id);

                    if(lang!=null){
                        newLang = lang;
                    }
                    if(lang==null&&language!=null){
                        newLang = language;
                    }
                    setTimeout(function(){
                        self.Loading = false;
                        window.location.href = "https://www.wennoanimal.com/website/#/AnimalDetail/"+GetQueryString("product_name")+"?lang="+newLang+"&theme_id="+newTheme_id;
                    },1000);               
                },
            },
            mounted:function(){
                var that=this;
                that.animalsInfo();
            }
        });
 </script>
</html>