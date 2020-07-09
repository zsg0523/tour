<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=no" />
        <meta charset="UTF-8">
        <title></title>
    </head>
    <link rel="stylesheet" href="../animal/css/animalDetails.css">
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
            <div v-show="LoadCompleted">
                <header>
                    <!-- <a class="back" href="{{url('animals')}}"></a> -->  
                    <span class="back" @click=backHistory></span>            
                    <img class="tipImg" v-bind:src="database.animal.image_original" >
                </header>
                <div class="contentBox">
                    <div class="record" v-cloak>
                        <div class="listen"  @click="audioSoundPlay" v-if="path">
                            <audio id="mp3Btn"  hidden="true"  :src="database.sound.path"></audio>
                        </div>
                        <div class="listen"  @click="noData" v-if="sound"></div>
    <!--                <div class="transcription" onclick="startRecording()"> </div> 
                        <div class="talk" onclick="playRecording()">
                            <audio id="transcription" hidden="true" controls autoplay></audio>
                        </div>  -->                 
                    </div>
                    <div class="title">
                        <p class="animalName">@{{database.title}}</p>
                        <select class="selectLang" @change="setLocale()">
                            <option value='0' lang='en'>English</option>
                            <option value='1' lang='de'>Deutsch</option>
                            <option value='2' lang='fr'>Français</option>
                            <option value='3' lang='it'>Italiano</option>
                            <option value='4' lang='tr'>Türkçe</option>
                            <option value='5' lang='nl'>Nederlands</option>
                            <option value='6' lang='da'>Dansk</option>
                            <option value='7' lang='pt'>Português</option>
                            <option value='8' lang='sv'>Svenska</option>
                            <option value='9' lang='th'>ภาษาไทย</option>
                            <option value='10' lang='ko'>한국어</option>
                            <option value='11' lang='no'>Norsk</option>
                            <option value='12' lang='ms'>Bahasa Melayu</option>
                            <option value='13' lang='zh-CN'>中文简体</option>
                            <option value='14' lang='zh-TW'>中文繁體</option>
                            <option value='15' lang='ar'>العَرَبِية'</option>
                            <option value='16' lang='es'>Español</option>
                            <option value='17' lang='ru'>русский язык</option>
                            <option value='18' lang='hi'>हिन्दी</option>
                            <option value='19' lang='fi'>Finnish</option>
                            <option value='20' lang='jp'>日本語</option>
                            <option value='21' lang='uk'>українська мова</option>
                        </select>
                    </div>
                   <div class="Question" v-cloak>
                        <div class="doYouKnow">
                            <a><i>@{{database.title_fun_tips}}</i></a>
                        </div>
                        <div class="problemTopic">
                           <span>@{{database.fun_tips}}</span>
                        </div>
                    </div> 
                    <div class="detailsList" v-cloak>
                        <ul>
                            <li><a class="list_icon Scientific_Name"></a><span>{{ __('animals.scientific-name') }}: @{{database.genus}}</span></li>
                            <li><a class="list_icon family"></a><span>{{ __('animals.family') }}:@{{database.family}}</span></li>
                            <li><a class="list_icon diet"></a><span>{{ __('animals.diet') }}:@{{database.diet}}</span></li>
                            <li><a class="list_icon habitat"></a><span>{{ __('animals.habitat') }}:@{{database.habitat}}</span></li>
                            <li><a class="list_icon location"></a><span>{{ __('animals.location') }}:@{{database.location}}</span></li>
                            <li><a class="list_icon group-name"></a><span>{{ __('animals.group-name') }}:@{{database.group_name}}</span></li>
                            <li class="intermediate" v-show="animal">
                               <p>
                                  <a class="lifespan">{{ __('animals.lifespan') }}:@{{database.lifespan}}</a>
                                  <a class="classification">{{ __('animals.classification') }}:@{{database.classification}}</a>
                               </p>
                            </li>
                            <li class="intermediate" v-show="dinosaur">
                               <p>
                                  <a class="lifespan">{{ __('animals.date_of_naming') }}:@{{database.classification}}</a>
                                  <a class="classification">{{ __('animals.order') }}:@{{database.lifespan}}</a>
                               </p>
                            </li>
                            <li><a class="list_icon weight"></a><span>{{ __('animals.weight') }}:@{{database.weight}}</span></li>
                            <li><a class="list_icon size"></a><span>{{ __('animals.size') }}:@{{database.animal_height}}</span></li>
                            <li><a class="list_icon speed"></a><span>{{ __('animals.top-speed') }}:@{{database.speed}}</span></li>
                            <li v-show="animal"><a class="list_icon Endangered "></a><span>{{ __('animals.endangered-level') }}:@{{database.endangered_level}}</span></li>
                            <li v-show="dinosaur"><a class="list_icon Endangered "></a><span>{{ __('animals.fossils_discovered') }}:@{{database.endangered_level}}</span></li>
                        </ul>
                        <div class="bottom">
                            <div class="bottom_box">
                                <div class="bottom_title">@{{database.about}}</div>
                                <span class="bottom_content">@{{database.more_details}}</span>
                            </div>
                        </div>
                    </div>
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
                database:[],
                sound:false,
                path:false,
                dinosaur:false,
                animal:false,
                locationReload:false,
                Loading:false,
                LoadCompleted:false,
            },
            created(){
                // var language = sessionStorage.getItem('language');
                // $(".selectLang").find("option[lang='"+language+"']").prop("selected",true);
            },
            watch: {
                database: function() {
                    this.$nextTick(function(){
                        var locationReload = this.locationReload;
                        this.Loading = false;   
                        this.LoadCompleted = true;
                        var language = sessionStorage.getItem('language');
                        $(".selectLang").find("option[lang='"+language+"']").prop("selected",true);
                        if(locationReload==false){
                           var self = this;
                           self.locationReload = true;
                        }else{
                            return
                        }
                    })
                }
            },
            methods:{
                backHistory(){
                    function GetQueryString(name){
                        var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
                        var r = window.location.search.substr(1).match(reg);
                        // var r = search.substr(1).match(reg);
                        if(r!=null)return unescape(r[2]); return null;
                    }
                    var searchRoot = GetQueryString("root");
                    if(searchRoot==null||searchRoot==undefined){
                        console.log(document.referrer);
                        window.location.href = document.referrer;
                    }else{
                        console.log(searchRoot);
                        if(searchRoot==0){

                        }else{
                            var lang = GetQueryString("lang");
                            sessionStorage.setItem('language',lang);
                        }
                        window.location.href="/animals";
                    }
                },
                noData(){
                    var noData = "{{ __('animals.noData') }}";
                    alert(noData);                    
                },
                audioSoundPlay(e){
                    var audio = document.getElementById('mp3Btn');
                    audio.onplay = function(){
                       // console.log("视频已经开始播放");
                    };
                    $('#mp3Btn').on('ended', function(){
                       // console.log("音频已播放完成");
                    });
                    e.stopPropagation();//防止冒泡
                    if(audio.paused){ //如果当前是暂停状态
                        audio.play(); //播放
                        return;
                    }else{
                        audio.pause(); //暂停
                    }
                },
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
                    var theme2 = sessionStorage.getItem('theme_id');
                    var theme_id;
                    console.log(theme1+'   '+theme2);
                    if(theme1==null||theme1==''){
                        // if(theme2==null){
                        //     theme_id = '';                            
                        // }else{
                        //     theme_id = theme2;
                        // }
                        theme_id = '';
                    }else{
                        theme_id = theme1;
                    }
                    console.log('language: '+language+'  lang: '+lang+' theme_id: '+theme_id);
                    sessionStorage.setItem('theme_id',theme_id);
                    if(lang!=null){
                        console.log('lang not null');
                        $(".selectLang").find("option[lang='"+lang+"']").prop("selected",true);
                        var url ='/api/animal?include=sound,animal&product_name='+GetQueryString("product_name")+'&lang='+lang+'&theme_id='+theme_id;
                        $.ajax({
                            url:'/api/setLocale?lang='+lang,
                            type:'GET',
                            headers: {
                                "Accept": 'application/prs.wenno.v1+json',
                            },
                            success:function(data) {
                                console.log(JSON.stringify(data));
                                if(data){
                                    sessionStorage.setItem('language',lang);
                                    window.location.href = '/animals/database?product_name='+GetQueryString("product_name")+'&theme_id='+theme_id+'&root=0';
                                }
                            },
                            error:function(XMLHttpRequest, textStatus, errorThrown) {
                                console.log(XMLHttpRequest.status);
                                console.log(XMLHttpRequest.readyState);
                                console.log(textStatus);
                            }
                        });
                    }

                    if(lang==null&&language!=null){
                        console.log('lang is null,language not null');
                        $(".selectLang").find("option[lang='"+language+"']").prop("selected",true);
                        var url ='/api/animal?include=sound,animal&product_name='+GetQueryString("product_name")+'&lang='+language+'&theme_id='+theme_id;
                    }

                    if(lang==null&&language==null){
                        console.log('lang is null,language is null');
                         $(".selectLang").find("option[lang='en']").prop("selected",true);
                         var url ='/api/animal?include=sound,animal&product_name='+GetQueryString("product_name")+'&lang=en&theme_id='+theme_id;
                    }
                    // setTimeout(function(){
                    //     window.location.href = "https://www.wennoanimal.com/animalGame/website/#/AnimalDetail/"+GetQueryString("product_name")+"?lang=en&theme_id="+theme_id;
                    // },1000);
                    console.log(url);
                    $.ajax({
                        url:url,
                        type:'GET',
                        headers: {
                            "Accept": 'application/prs.wenno.v1+json',
                        },
                        success:function(data){
                            // console.log(JSON.stringify(data));
                            self.database = data;
                            document.title = data.title;
                            var sound = data.sound;
                            self.Loading = true;
                            self.LoadCompleted = true;  
                            if(sound==undefined){//没有获取到sound
                                self.sound = true;
                                self.path = false;
                            }else{
                                self.sound = false;
                                self.path = true;
                            }
                            var theme_name = data.theme_name;
                            //console.log(theme_name);
                            if(theme_name=='Mesozoic Era'){//恐龙
                                self.dinosaur = true;
                                self.animal = false;
                            }else{
                                self.dinosaur = false;
                                self.animal = true;                                
                            }

                        },
                        error:function(XMLHttpRequest, textStatus, errorThrown) {
                            console.log(XMLHttpRequest.status);
                            console.log(XMLHttpRequest.readyState);
                            console.log(textStatus);
                        }
                    });                     
                },
                setLocale(){
                    function GetQueryString(name){
                        var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
                        var r = window.location.search.substr(1).match(reg);
                        if(r!=null)return unescape(r[2]); return null;
                    }
                    var language = $('.selectLang').find("option:selected").attr("lang");
                    var theme_id = sessionStorage.getItem('theme_id');
                    console.log(language+ '  '+theme_id);
                    $.ajax({
                        url:'/api/setLocale?lang='+language,
                        type:'GET',
                        headers: {
                            "Accept": 'application/prs.wenno.v1+json',
                        },
                        success:function(data) {
                            console.log(JSON.stringify(data));
                            if(data){
                                sessionStorage.setItem('language',language);
                                // window.location.reload();
                                window.location.href = '/animals/database?product_name='+GetQueryString("product_name")+'&theme_id='+theme_id+'&root=0';
                            }
                        },
                        error:function(XMLHttpRequest, textStatus, errorThrown) {
                            console.log(XMLHttpRequest.status);
                            console.log(XMLHttpRequest.readyState);
                            console.log(textStatus);
                        }
                    });
                }
            },
            mounted:function(){
                var that=this;
                that.animalsInfo();
            }
        });
 </script>
</html>