@extends('layouts.app')
@section('title', '联络我们')

@section('content')
<div class="contactUsList">
       <div class="aboutTitle">
          <div class="aboutName">
            <ul class="contact_ul">
               <li class="contact_li">{{ __('shop.contact.contactUs') }}</li>
               <li class="contact_li"><a href="{{ url('/aboutUs') }}">{{ __('shop.contact.aboutWenno') }}</a></li>
               <li class="contact_li"><a href="{{ url('/retail') }}">{{ __('shop.contact.retails') }}</a></li>              
            </ul>
          </div>
       </div>
       <div class="usList">
       	   <div class="listBox">
	       	   <div class="left">
	       	   	   <p class="contactTitle">{{ __('shop.contact.contactInformation') }}</p>
	       	   	   <span>{{ __('shop.contact.telephone') }}: (+852) 2464 8378 </span>
	       	   	   <span>{{ __('shop.contact.telephone') }}: (+852) 2463 6704 </span>
	       	   	   <span><a href="mailto:marketing@shtoys.com.hk">marketing@shtoys.com.hk </a></span>
	       	   	   <input type="text" placeholder="name" class="name" ref="name"><!-- placeholder="Name" -->
	       	   	   <input type="text" placeholder="email" class="email" ref="email">
	       	   </div>
	       	   <div class="right">
	       	   	   <p class="contactTitle">{{ __('shop.contact.Showroom') }}</p>
	       	   	   <span>Room 05, 6/F, Houston Centre,63 Mody Road,Tsim Sha Tsui East, Kowloon Hong Kong </span>
	       	   	   <div class="conter">
	       	   	   	  <textarea class="tValue" placeholder="Message" ref="Message"></textarea>
	       	   	   </div>
	       	   </div>       	  	
       	   </div>
       	   <button onclick="submit()">{{ __('shop.contact.sendMessage') }}</button>
       </div>
    </div>
@endsection

@section('scriptsAfterJs')
	<script src="../animal/js/jquery-3.4.1.min.js"></script>
  	<script>
	    function submit(){
	    	var name = $("input.name").val();
			var email = $("input.email").val();
			var message = $("textarea.tValue").val();
	    	if(name==""||email==""||message==""){
	    		console.log("请输入");
        	}else{
	            $.ajax({
		            url: 'https://www.wennoanimal.com/api/contact',
		            type: "POST",
		            data:{
		            	name:name,
		                email: email,
		                message: message
		            },
		            success: function(ret) {
		            	console.log(JSON.stringify(ret));
		                if(ret.status==200){
		                	console.log("已发出");
		                 }else{

		                 }
		            },
		            error: function(XMLHttpRequest, textStatus, errorThrown) {

		            }
		        });
	        }
	    }
  	</script>
@endsection