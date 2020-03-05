<style type="text/css">
.usList{width:72%;padding:2rem 0rem;margin:0px auto;text-align:left;color:#7b5c55;min-height:calc(100vh - 225px);}
.usList h3{width:100%;height:60px;line-height:60px;font-size:1.1rem;font-weight:bold;}
.usList p{display:block;width:100%;line-height:24px;font-size:0.9rem;text-align:justify;text-justify:newspaper}
</style>
@extends('layouts.app')
@section('title', '关于WENNO®')

@section('content')
<div class="aboutUsList contactUsList">
   	<div class="aboutTitle">
      	<div class="aboutName">
          	<ul class="contact_ul">
               <li class="contact_li">关于wenno®</li>
               <li class="contact_li"><a href="{{ url('/contact') }}">联络我们</a></li>
               <li class="contact_li"><a href="{{ url('/retail') }}">销售地点</a></li>              
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
				s = ret.data.about.content.replace(/&amp;/g,"&");
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
