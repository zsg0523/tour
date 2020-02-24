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
               <li class="contact_li"><a href="{{ url('/aboutUs') }}">销售地点</a></li>              
            </ul>
      	</div>
   	</div>
   	<div class="usListBox">
     	<div class="usList">
     		<h3>What's New?</h3>

			<p>Here we would like to introduce “Wenno® World” to the market in order to enhance the Wenno® fun learning experience.</p>
			<p>The selection of animals in each series is based on the 7 continents and 5 oceans of our modern world. To learn more about the history of this world we also feature both endangered and extinct animals. For a comprehensive world experience we also have the beloved dinosaurs from Mesozoic Era, Traditional Wild Animal, Farm Animal and Marine Life series which are timeless and being popular.</p>
			<p>We have QR codes printed on playcards provided in each box. It can show more detailed information about each animal by connecting these cards with mobile devices, such as the animals’ habitats, living environment and fun facts. It also fosters a sense of environmental awareness in children from a young age.</p>

			<h3>Quality animal figurines</h3>

			<p>We are experts in the design and manufacturing of PVC animal figurines. We have been awarded ICTI, ISO9001; IOS 14006 certificates and all our products comply with EN71 and ASTM.</p>

			<p>Hexamoll® DINCH® from BASF</p>
			<p>Hexamoll® DINCH® is the trusted non-phthalate plasticizer especially developed for applications with close human contact. Therefore, it is the ideal solution when it comes to high safety and quality standards for use in many sensitive products, such as toys, food contact applications and medical devices.</p>
			<p>Hexamoll® DINCH® is approved for toy applications inculding:</p>
			<p>Complies with Regulation (EC) No. 1907/2006, Annex XVII, 51/52 and can be used for toy manufacturing in compliance with the Toy Safety Directive 2009/48/EC</p>
			<p>Complies with US ASTM F963</p>
			<p>By using Hexamoll® DINCH®, it is possible to satisfy the requirements of EN 71-3, EN 71-5 and EN 71-9</p>
			<p>We have been a Hexamoll® DINCH® Trusted Partner since the program was launched in 2012. This is BASF's initiative in Asia Pacific to partner with companies who put product safety as their highest priority.</p>
			<p>For more information, visit www.hexamoll-dinch.com and www.hexamoll-dinch.com/trusted-partners . Both Hexamoll® and DINCH® are registered trademarks of BASF SE.</p>

			<p>"We strive to make our products environmentally friendly. We use Kraft paper and soy ink for the Wenno® product packaging and up to 90% of the package materials are recyclable!"</p>
     	</div>         
   	</div>

</div>
@endsection
