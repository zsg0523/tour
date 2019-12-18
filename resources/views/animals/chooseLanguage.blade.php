<!DOCTYPE html>
<html>
	<head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=no" />
		<meta charset="UTF-8">
		<title></title>
	</head>
    <link rel="stylesheet" href="../css/chooseLanguage.css">
    <script type="text/javascript" src="../js/orientationchange.js" ></script>
    <body class="language">
         <div class="chooseLanguage" id="chooseLanguage">
         	<div class="icon">
         	 	<a class="back" href="{{url('animals')}}"></a>
         	 	<img src="../images/logo_set.png">
         	</div>
			<p class="choose"></p>
			<div class="chooseBox">
				<select class="selectBox" name="selectBox" id="selectBox">	
				</select>
			</div>
			<div class="sure">
				<!-- <p class="determine"></p> -->
			</div>
         </div>
    </body>
	<script src="../js/jquery-3.4.1.min.js"></script>
    <script>
		$(function (){
			var lang = 'zh-CN';
	        var language = [{
					'language': 'English',
					'title': 'en',
					'choose':'Choose Your Language',
					'determine':'Determine'
				},
				{
					'language': 'Deutsch',
					'title': 'de',
					'choose':'Wähle deine Sprache',
					'determine':'Bestimmen'
				},
				{
					'language': 'Français',
					'title': 'fr',
					'choose':'Choisissez votre langue',
					'determine':'Déterminer'
				},
				{
					'language': 'Italiano',
					'title': 'it',
					'choose':'Scegli la tua LINGUA',
					'determine':'Determinare'
				},
				{
					'language': 'Türkçe',
					'title': 'tr',
					'choose':'Dilinizi seçin',
					'determine':'belirlemek'
				},
				{
					'language': 'Nederlands',
					'title': 'nl',
					'choose':'Kies je taal',
					'determine':'Bepalen'
				},
				{
					'language': 'Dansk',
					'title': 'da',
					'choose':'Vælg dit sprog',
					'determine':'Bestemme'
				},
				{
					'language': 'Português',
					'title': 'pt',
					'choose':'Escolha o seu idioma',
					'determine':'Determinar'
				},
				{
					'language': 'Svenska',
					'title': 'sv',
					'choose':'Välj ditt språk',
					'determine':'Bestämma'
				},
				{
					'language': 'ภาษาไทย',
					'title': 'th',
					'choose':'เลือกภาษาของคุณ',
					'determine':'กำหนด'
				},
				{
					'language': '한국어',
					'title': 'ko',
					'choose':'당신의 언어를 선택하세요',
					'determine':'결정'
				},
				{
					'language': 'Norsk',
					'title': 'no',
					'choose':'Velg ditt språk',
					'determine':'Fastslå'
				},
				{
					'language': 'Bahasa Melayu',
					'title': 'ms',
					'choose':'Pilih Bahasa anda',
					'determine':'menentukan'
				},
				{
					'language': '中文简体',
					'title': 'zh-CN',
					'choose':'请选择你的语言',
					'determine':'确定'
				},
				{
					'language': '中文繁體',
					'title': 'zh-TW',
					'choose':'選擇你的語言',
					'determine':'確定'
				},
				{
					'language': 'العَرَبِية',
					'title': 'ar',
					'choose':'اختر لغتك',
					'determine':'تحديد'
				},
				{
					'language': 'Español',
					'title': 'es',
					'choose':'Elige tu idioma',
					'determine':'Determinar'
				},
				{
					'language': 'русский язык',
					'title': 'ru',
					'choose':'Выберите свой язык',
					'determine':'определить'
				},
				{
					'language': 'हिन्दी',
					'title': 'hi',
					'choose':'अपनी भाषा चुनिए',
					'determine':'निर्धारित'
				},
				{
					'language': 'Finnish',
					'title': 'fi',
					'choose':'Valitse kielesi',
					'determine':'määrittää'
				},
				{
					'language': '日本語',
					'title': 'jp',
					'choose':'言語を選んでください',
					'determine':'定めます'
				},
				{
					'language': 'українська мова',
					'title': 'uk',
					'choose':'Виберіть мову',
					'determine':'визначити'
				}
			];
			var option="";
		    for(var i=0;i<language.length;i++){
	            if(language[i].title==lang){
	               $(".choose").text(language[i].choose);
                   option+='<option value="'+language[i].language+'" title="'+language[i].title+'" choose="'+language[i].choose+'" determine="'+language[i].determine+'" selected>'+language[i].language+'</option>';	            	
	               //$(".determine").text(language[i].determine);
	            }else{
	               option+='<option value="'+language[i].language+'" title="'+language[i].title+'" choose="'+language[i].choose+'" determine="'+language[i].determine+'">'+language[i].language+'</option>';
	               $(".choose").text(language[0].choose);
	              // $(".determine").text(language[0].determine);
	            }
		    }
		    $('#selectBox').append(option);			
		});
		
		$("#selectBox").change(function(){
	       $(".choose").text($('#selectBox').find("option:selected").attr("choose"));
	      // $(".determine").text($('#selectBox').find("option:selected").attr("determine"));
		});
		$(".sure").click(function(){
            var language = $('#selectBox').find("option:selected").attr("title");
            sessionStorage.setItem('language',language);
            $.ajax({
		        url:'/api/setLocale?lang='+language,
		        type:'GET',
		        success:function(data) {
					console.log(JSON.stringify(data));
					if(data){
						window.location.href = '/animals';
					}
		        },
		        error:function(XMLHttpRequest, textStatus, errorThrown) {
		            console.log(XMLHttpRequest.status);
		            console.log(XMLHttpRequest.readyState);
		            console.log(textStatus);
		        }
		    });
		});
    </script>
</html>
