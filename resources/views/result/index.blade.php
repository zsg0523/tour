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
                background-size: 100% auto;
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
                width: 100%;
                height: 30px;
                line-height: 30px;
                font-size: 14px;
                font-weight: bold;
                text-align: center;
                color: #c8752a;
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
                <div class="title">排行榜</div>
            </div>
            <div class="rank">5/2000</div>
            <div class="tips">请点击下面动物，查看它们的详细资料。</div>
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
            $(function(){
                console.log($);
                console.log('++++++++++');

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
                        animalName='';
                    break;
                    case 2:
                        animalName='';
                    break;
                    case 3:
                        animalName='';
                    break;
                    case 4:
                        animalName='';
                    break;
                    case 5:
                        animalName='';
                    break;
                    case 6:
                        animalName='';
                    break;
                    case 7:
                        animalName='';
                    break;
                    case 8:
                        animalName='';
                    break;
                    case 9:
                        animalName='';
                    break;
                    case 10:
                        animalName='';
                    break;
                    case 11:
                        animalName='';
                    break;
                    case 12:
                        animalName='';
                    break;
                    default:
                        // statements_def
                        break;
                }
                console.log(index);
                // window.location.href="";
            }
        </script>
    </body>
</html>
