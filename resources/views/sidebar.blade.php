<section>
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
				<h2>Thương Hiệu</h2>
		<div class="panel-group category-products" id="accordian">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title" style="text-align: center;"><a href="#"></a> {!! $brandsHtml !!} </h4>
				</div>
			</div>
		</div>


		<div class="price-range">
			<!-- <h2 for="amount">Lọc theo giá</h2> -->
			<form>
				<div id="slider-range"></div>
				<input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
				<input type="hidden" name="start_price" id="start_price">
				<input type="hidden" name="end_price" id="end_price">
				<br>
				<!-- <input type="submit" name="filter_price" value="Lọc giá" class="btn btn-sm btn-default"> -->
			</form>
		</div>


</section>