<section >
@php $menusHtml = \App\Helpers\Helper::menus($menus); @endphp
@php $brandsHtml = \App\Helpers\Helper::brands($brands); @endphp
	<div class="left-sidebar" style="width: 225;">
		<h2>Danh Mục</h2>
		<div class="panel-group category-products" id="accordian"><!--category-productsr-->
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title" style="text-align: center;"><a href="#"></a> {!! $menusHtml !!} </h4>
				</div>
			</div>
		</div><!--/category-products-->
	

		<!--BRAND-PRODUCT-->
		<!-- <h2>Thương Hiệu</h2>
		<div class="brands_products" style="text-align: center;">
			<div class="brands-name">
				<ul >
					<li>
						@foreach($brands as $key => $brand)
						<h4 class="panel-title" style="line-height: 1.5;" >
							<a href="{{URL::to('/thuonghieusanpham/'.$brand->id)}}">  {{$brand->ten}} </a>
						</h4>
						@endforeach
					</li>
				</ul>
			</div>
		</div> -->
		<h2>Thương Hiệu</h2>
		<div class="panel-group category-products" id="accordian">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title" style="text-align: center;"><a href="#"></a> {!! $brandsHtml !!} </h4>
				</div>
			</div>
		</div>

		<div class="price-range"><!--price-range-->
			<h2>Price Range</h2>
			<div class="well text-center">
				<input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
				<b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
			</div>
		</div><!--/price-range-->
		
		<div class="shipping text-center"><!--shipping-->
			<img src="images/home/shipping.jpg" alt="" />
		</div><!--/shipping-->
		
	</div>
</section>
