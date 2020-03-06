<style type="text/css">
.usList{width:72%;padding:2rem 0rem;margin:0px auto;text-align:left;color:#7b5c55;min-height:calc(100vh - 225px);}
.usList >>>h3 ,.usList >>>h4,.usList >>>h2,.usList >>>h1,.usList>>> h3{width:100%;height:60px;line-height:60px;font-size:1.1rem;font-weight:bold;}
.usList >>>p,.usList >>>li,.usList >>>span{display:block;width:100%;line-height:24px;font-size:0.9rem;text-align:justify;text-justify:newspaper}
.usList img{/*width:85%;*/padding:0.5rem 0rem;display:block;max-width: 100%}
@media screen and (max-width: 768px) {
    .usList{width:90%;}
    .usList >>>span{font-size:0.8rem;}
 }
</style>
@extends('layouts.app')
@section('title', '关于WENNO®')

@section('content')
<div class="aboutUsList contactUsList">
   	<div class="aboutTitle">
      	<div class="aboutName">
          	<ul class="contact_ul">
               <li class="contact_li">{{ __('shop.contact.aboutWenno') }}</li>
               <li class="contact_li"><a href="{{ url('/contact') }}">{{ __('shop.contact.contactUs') }}</a></li>
               <li class="contact_li"><a href="{{ url('/retail') }}">{{ __('shop.contact.retails') }}</a></li>              
            </ul>
      	</div>
   	</div>
   	<div class="usListBox">
     	<div class="usList"></div>
   	</div>

</div>
@endsection

@section('scriptsAfterJs')
	<script src="../animal/js/jquery-3.4.1.min.js"></script>
  	<script>
    $(document).ready(function() {
	    getData();
    });
    function getData(){
		$.ajax({
            url: 'https://www.wennoanimal.com/api/about-us',
            type: "GET",
            success: function(ret) {
                var s ='';
				s = ret.about.content.replace(/&amp;/g,"&");
				s = s.replace(/&lt;/g,"<");
				s = s.replace(/&gt;/g,">");
				s = s.replace(/&nbsp;/g," ");
				s = s.replace(/&#39;/g,"\'");
				s = s.replace(/&quot;/g,"\"");
				s = s.replace(/margin/gi, "m");
				s = s.replace(/text-indent/gi, "t");
				s = s.replace(/padding/gi, "p");
				if(!s){
					$('.usList').html('<p>尚未添加数据<p>');
				}else{
					$('.usList').html(s);
				}
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {

            }
        });
    }
  	</script>
@endsection
