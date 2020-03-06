@extends('layouts.app')
@section('title', '联络我们')

@section('content')
<div class="contactUsList">
	<div class="aboutTitle">
      	<div class="aboutName">
          	<ul class="contact_ul">
				<li class="contact_li">{{ __('shop.contact.retails') }}</li>
				<li class="contact_li"><a href="{{ url('/aboutUs') }}">{{ __('shop.contact.aboutWenno') }}</a></li>
				<li class="contact_li"><a href="{{ url('/contact') }}">{{ __('shop.contact.contactUs') }}</a></li>
            </ul>
      	</div>
   	</div>
	<div class="map">           
        <div class="dropDownMenu">
          	<select class="select" id="address">
          	</select>
		</div> 
		<div class="table">
            <table border="0px">           
              	<thead>
                	<tr>
	                    <th class="first">{{ __('shop.contact.pname') }}</th></td>
	                    <th>{{ __('shop.contact.address') }}</th>
	                    <th>{{ __('shop.contact.phone') }}</th>
	                    <th>{{ __('shop.contact.business') }}</th>
                	</tr>
              	</thead>
              	<tbody id="address_info"></tbody>
			</table>            
		</div>         
	</div>
</div>
@endsection

@section('scriptsAfterJs')
	<script src="../animal/js/jquery-3.4.1.min.js"></script>
  	<script>
  		$(document).ready(function() {
		    getretails();
		    getaddress();
	    });
      	$("#address").change(function(){
	        var address = $("#address").val();
	       	$.ajax({
	            url: 'https://www.wennoanimal.com/api/locals?location='+address+'&include=retails',
	            type: "get",
	            dataType: "json",
	            data: {
	               
	            },
	            success: function(ret) {
	                var retail = ret.data[0].retails.data;
	                for(var i = 0;i<retail.length;i++){
		            	$("#address_info").append("<tr><td class='first'>"+retail[i].name+"</td><td>"+retail[i].address+"</td><td>"+retail[i].phone+"</td><td>"+retail[i].business_hours+"</td></tr>");
		            }
	            },
	        });
	    });
      	function getretails(){
      		$.ajax({
	            url: 'https://www.wennoanimal.com/api/locals',
	            type: "GET",
	            data:{
	            	
	            },
	            success: function(ret) {
	            	console.log(JSON.stringify(ret));
	                var retail = ret.data;
	                for(var i = 0;i<retail.length;i++){
	                	$("#address").append("<option value='"+retail[i].id+"'>"+retail[i].location+"</option>");
	                }
	            },
	            error: function(XMLHttpRequest, textStatus, errorThrown) {

	            }
	        });
      	}
      	function getaddress(){
            $.ajax({
	            url: 'https://www.wennoanimal.com/api/locals?include=retails',
	            type: "GET",
	            data:{
	            	
	            },
	            success: function(ret) {
	                if(ret.data!=null){
		                var retail = ret.data[0].retails.data;
		                for(var i = 0;i<retail.length;i++){
			            	$("#address_info").append("<tr><td class='first'>"+retail[i].name+"</td><td>"+retail[i].address+"</td><td>"+retail[i].phone+"</td><td>"+retail[i].business_hours+"</td></tr>");
			            }
		            }else{
		                return
	             	}
	                
	            },
	            error: function(XMLHttpRequest, textStatus, errorThrown) {

	            }
	        });
      	}
  	</script>
@endsection