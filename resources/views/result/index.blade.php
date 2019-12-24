<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>RESULT</title>
        <style>
            body,html{
                margin: 0;
                padding: 0;
            }
            .main{
                width: 100%;
                height: 100vh;
                background:url('./resultImg/bg.png') no-repeat;
                background-size: cover;
                background-position:center;
                overflow: auto;
            }
            .head{
                width: 86%;
                height: auto;
                position: relative;
                margin-left: 7%;
            }
            .head img{
                width: 100%;
                height: auto;
            }
            .title{
                width: 100%;
                height: 100px;
                line-height: 100px;
                text-align: center;
                font-size: 40px;
                color: red;
                position: absolute;
                top: 50%;
                margin-top: -50px;
                left: 0;
                text-shadow:3px 3px 3px #fff,
                            -3px 3px 3px #fff,
                            -3px -3px 3px #fff,
                            3px -3px 3px #fff;
            }
            .rank{
                width: 50%;
                margin: auto;
                height: 50px;
                border-radius: 25px;
                background: #e2964b;
                color: #fff;
                text-align: center;
                line-height: 50px;
                font-size: 24px;
                font-weight: bold;
                
            }
            .tips{
                width: 90%;
                margin:15px 5%;
                min-height: 25px;
                line-height: 25px;
                font-size: 14px;
                font-weight: bold;
                text-align: center;
                color: #c8752a;
                word-break: normal;
            }
            .animals{
                width: 100%;
                height: auto;
                display: flex;
                display: -webkit-flex;
                flex-wrap: wrap;
                align-items: flex-start;
                justify-content: space-around;
            }
            .item{
                width: 27%;
                height: auto;
            }
            .item > img{
                width: 100%;
                height: auto;
            }
        </style>
    </head>
    <body>
        <div class="main">  
            <div class="head">
                <img src="{{asset('resultImg/phb.png')}}" alt="">
                <div class="title" id="title"></div>
            </div>
            <div class="rank" id="rank"></div>
            <div class="tips" id="tips"></div>
            <div class="animals">
                <div class="item" onclick="toDataBase(1)">
                    <img src="{{asset('resultImg/1.png')}}" alt="">
                </div>
                <div class="item" onclick="toDataBase(2)">
                    <img src="{{asset('resultImg/2.png')}}" alt="">
                </div>
                <div class="item" onclick="toDataBase(3)">
                    <img src="{{asset('resultImg/3.png')}}" alt="">
                </div>
                <div class="item" onclick="toDataBase(4)">
                    <img src="{{asset('resultImg/4.png')}}" alt="">
                </div>
                <div class="item" onclick="toDataBase(5)">
                    <img src="{{asset('resultImg/5.png')}}" alt="">
                </div>
                <div class="item" onclick="toDataBase(6)">
                    <img src="{{asset('resultImg/6.png')}}" alt="">
                </div>
                <div class="item" onclick="toDataBase(7)">
                    <img src="{{asset('resultImg/7.png')}}" alt="">
                </div>
                <div class="item" onclick="toDataBase(8)">
                    <img src="{{asset('resultImg/8.png')}}" alt="">
                </div>
                <div class="item" onclick="toDataBase(9)">
                    <img src="{{asset('resultImg/9.png')}}" alt="">
                </div>
                <div class="item" onclick="toDataBase(10)">
                    <img src="{{asset('resultImg/10.png')}}" alt="">
                </div>
                <div class="item" onclick="toDataBase(11)">
                    <img src="{{asset('resultImg/11.png')}}" alt="">
                </div>
                <div class="item" onclick="toDataBase(12)">
                    <img src="{{asset('resultImg/12.png')}}" alt="">
                </div>
            </div>
        </div>
        <script type="text/javascript" src="./js/jquery-3.4.1.min.js" ></script>
        <script>
            var text={
                en:{
                    title:'Ranking',
                    tips:'Please click on the animals<br/>to check out their details.'
                },
                cn:{
                    title:'排行榜',
                    tips:'请点击下面动物，查看它们的详细资料。'
                },
                hk:{
                    title:'排行榜',
                    tips:'請點擊下面動物，查看它們的詳細資料。'
                },
            }
            var rank=GetQueryString('rank')?GetQueryString('rank'):'???';   
            var lang=GetQueryString('lang')?GetQueryString('lang'):'zh-CN'; 
            $(function(){
                switch (lang) {
                    case 'zh-CN':
                        // zh-CN
                        $('#title').text(text.cn.title);
                        $('#tips').html(text.cn.tips);
                        break;
                    case 'zh-TW':
                        // zh-TW
                        $('#title').text(text.hk.title);
                        $('#tips').html(text.hk.tips);
                        break;
                    default:
                        $('#title').text(text.en.title);
                        $('#tips').html(text.en.tips);
                        break;
                }
                $('#rank').text(rank);
            });
            function GetQueryString(name){
                var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
                var r =  window.location.search.substr(1).match(reg);
                if(r!=null){
                    return r[2]; 
                }else{
                    return null;
                }
            }
            function toDataBase(index){
                var animalName='';
                switch (index) {
                    case 1:
                        animalName='ZEBRA';
                    break;
                    case 2:
                        animalName='WHITE_RHINOCEROS';
                    break;
                    case 3:
                        animalName='GIRAFFE';
                    break;
                    case 4:
                        animalName='OSTRICH';
                    break;
                    case 5:
                        animalName='LION';
                    break;
                    case 6:
                        animalName='AFRICAN_GAZELLE';
                    break;
                    case 7:
                        animalName='AFRICAN_CHEETAH';
                    break;
                    case 8:
                        animalName='GORILLA';
                    break;
                    case 9:
                        animalName='HIPPOPOTAMUS';
                    break;
                    case 10:
                        animalName='OLIVE_BABOON';
                    break;
                    case 11:
                        animalName='AFRICAN_CROCODILE';
                    break;
                    case 12:
                        animalName='AFRICAN_ELEPHANT';
                    break;
                    default:
                        // statements_def
                        break;
                }
                console.log(index);
                window.location.href="https://www.wennoanimal.com/animals/database?product_name="+animalName+"&lang="+lang;
            }
        </script>
    </body>
</html>
