<!DOCTYPE html>
<html lang="en">

<head>
	@include('head')
</head>

<body>
	<!-- class="animsition" -->

	<!-- Header -->
	@include('header')


	<!-- Cart -->
	@include('cart')

	<!-- Slider -->
	<section class="section-slide" id="slider">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="wrap-slick1">
						<div class="slick1">

							@foreach($sliders as $slider)

							<div class="item-slick1" style="background-image: url({{$slider->thumnb}}); height: 50% ; ">
								<div class="container h-full">
									<div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
										<div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
											<span class="ltext-101 cl2 respon2 pl-5">
												Vegetable Family
											</span>
										</div>

										<div class="layer-slick1 animated visible-false " data-appear="fadeInUp" data-delay="800">
											<h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1 pl-5 mt-0 pt-0">
												{{ $slider->name }}
											</h2>
										</div>
									</div>
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>

	</section>


	<!-- Banner -->
	<!-- <div class="sec-banner bg0 p-t-80 p-b-50">
		<div class="container">
			<div class="row">
				@foreach($menus as $menu)
				<div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
				
					<div class="block1 wrap-pic-w">
						<img src="/template/images/bg6.png" alt="IMG-BANNER">

						<a href="/danh-muc/{{ $menu->id }}-{{ \Str::slug($menu->name, '-') }}.html" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
							<div class="block1-txt-child1 flex-col-l">
								<span class="block1-name ltext-102 trans-04 p-b-8">
									{{ $menu->name }}
								</span>
							</div>

						</a>
					</div>
				</div>

				@endforeach
			</div>
		</div>
	</div> -->

	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					@include('sidebar')
				</div>

				<div class="col-sm-9 padding-right">

					<!-- <div class="category-tab">
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#tshirt" data-toggle="tab">T-Shirt</a></li>
								<li><a href="#blazers" data-toggle="tab">Blazers</a></li>
								<li><a href="#sunglass" data-toggle="tab">Sunglass</a></li>
								<li><a href="#kids" data-toggle="tab">Kids</a></li>
								<li><a href="#poloshirt" data-toggle="tab">Polo shirt</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="tshirt" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery3.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
							</div>
							
							<div class="tab-pane fade" id="blazers" >
								
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery1.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
							</div>
							
							<div class="tab-pane fade" id="sunglass" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery3.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
							</div>
							
							<div class="tab-pane fade" id="kids" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery1.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
							</div>
							
							<div class="tab-pane fade" id="poloshirt" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery1.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="recommended_items">
						<h2 class="title text-center">recommended items</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">	
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend3.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
								</div>
								<div class="item">	
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend3.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
								</div>
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div> -->

					<div>
						<div class="flex-w flex-sb-m ">
							<div class="flex-w flex-l-m filter-tope-group m-tb-10">
								<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
									Tất Cả Sản Phẩm
								</button>
							</div>

							<div class="flex-w flex-c-m m-tb-10 ">
								<!-- <div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
										<i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
										<i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
										Filter
									</div> -->
								<div>
									<form id="search-form" action="{{ url('/searchProductMicrophone')}}" class="d-flex" method="get">
										<div class="btn btn-white input-group-text border-0" type="submit" id="">
											<div style="display:none">
												<input id="search-input" name="keywork" type="text">

											</div>
											<span class="microphone">
												<i class="fas fa-microphone"></i>
												<span class="recording-icon"></span>
											</span>
										</div>
									</form>
								</div>

								<div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
									<i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
									<i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
									Search
								</div>
							</div>

							<!-- Search product -->
							<div class="dis-none panel-search w-full p-t-10 p-b-15">
								<div class="bor8 dis-flex p-l-15">
									<form class="form-inline" action="{{ url('search') }}" method="get">
										<input class="mtext-107 cl2 size-114 plh2 p-r-15" type="search" name="query" id="keywords" placeholder="Tìm Kiếm Sản Phâm">
										<button type="submit" class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
											<i class="zmdi zmdi-search"></i>
										</button>
									</form>
								</div>

								<!-- <form action="{{ url('search')}}" method="GET" class="form-inline pl-3 pt-3" >
										<div class="form-group">
											<input class="form-control form-control-sidebar" name="query" type="search" placeholder="Search" aria-label="Search">
										</div>

										<button type="submit" class="btn btn-light">
											<i class="fas fa-search fa-fw"></i>
										</button>
									</form> -->

							</div>


							<!-- Filter -->

							<!-- <div class="row">
									<div class="col-md-4">
										<label for="amount">Sắp xếp theo</label>
										<form>
											@csrf
											<section name = "sort" id="loc">
												<option value="{{Request::url()}}?sort_by=none">Lọc theo</option>
												<option value="{{Request::url()}}?sort_by=gia_tang_dan">Giá: Tăng dần</option>
												<option value="{{Request::url()}}?sort_by=gia_giam_dan">Giá: Giảm dần</option>
												<option value="{{Request::url()}}?sort_by=ten_a_z">Tên: A->Z</option>
												<option value="{{Request::url()}}?sort_by=ten_z_a">Tên: Z->A</option>
											</section>
										</form>
									</div>
									<div class="col-md-4">
										<label for="amount">Lọc giá theo</label>
										<form>
											<div id = "slider-range"></div>
											<input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
										</form>
									</div>
								</div> -->

							<!-- <div class="dis-none panel-filter w-full p-t-10">
									<div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
										<div class="filter-col1 p-r-15 p-b-27">
											<div class="mtext-102 cl2 p-b-15" value="{{Request::url()}}?sort_by=none">
												Sắp xếp theo
											</div>

											<ul>
												<li class="p-b-6">
													<option  value="{{Request::url()}}?sort_by=ten_a_z" class="filter-link stext-106 trans-04">
														Tên: A->Z
													</option>
												</li>

												<li class="p-b-6">
													<a href="#" value="{{Request::url()}}?sort_by=ten_z_a" class="filter-link stext-106 trans-04">
														Tên: Z->A
													</a>
												</li>

												<li class="p-b-6">
													<a href="#" class="filter-link stext-106 trans-04">
														Giá: Tăng dần
													</a>
												</li>

												<li class="p-b-6">
													<a href="#" class="filter-link stext-106 trans-04">
														Giá: Giảm dần
													</a>
												</li>

											</ul>
										</div>

										<div class="filter-col2 p-r-15 p-b-27">
											<div class="mtext-102 cl2 p-b-15">
												Giá
											</div>

											<ul>
												<li class="p-b-6">
													<a href="#" class="filter-link stext-106 trans-04 filter-link-active">
														Tất cả
													</a>
												</li>

												<li class="p-b-6">
													<a href="#" class="filter-link stext-106 trans-04">
														0đ - 50.000đ
													</a>
												</li>

												<li class="p-b-6">
													<a href="#" class="filter-link stext-106 trans-04">
														50.000đ - 200.000đ
													</a>
												</li>

												<li class="p-b-6">
													<a href="#" class="filter-link stext-106 trans-04">
														200.00đ - $500.000đ
													</a>
												</li>

												<li class="p-b-6">
													<a href="#" class="filter-link stext-106 trans-04">
														500.000đ - 1.000.000đ
													</a>
												</li>

											</ul>
										</div>

										<div class="filter-col3 p-r-15 p-b-27">
											<div class="mtext-102 cl2 p-b-15">
												Màu Sắc
											</div>

											<ul>
												<li class="p-b-6">
													<span class="fs-15 lh-12 m-r-6" style="color: #222;">
														<i class="zmdi zmdi-circle"></i>
													</span>

													<a href="#" class="filter-link stext-106 trans-04">
														Black
													</a>
												</li>

												<li class="p-b-6">
													<span class="fs-15 lh-12 m-r-6" style="color: #4272d7;">
														<i class="zmdi zmdi-circle"></i>
													</span>

													<a href="#" class="filter-link stext-106 trans-04 filter-link-active">
														Blue
													</a>
												</li>

												<li class="p-b-6">
													<span class="fs-15 lh-12 m-r-6" style="color: #b3b3b3;">
														<i class="zmdi zmdi-circle"></i>
													</span>

													<a href="#" class="filter-link stext-106 trans-04">
														Grey
													</a>
												</li>

												<li class="p-b-6">
													<span class="fs-15 lh-12 m-r-6" style="color: #00ad5f;">
														<i class="zmdi zmdi-circle"></i>
													</span>

													<a href="#" class="filter-link stext-106 trans-04">
														Green
													</a>
												</li>

												<li class="p-b-6">
													<span class="fs-15 lh-12 m-r-6" style="color: #fa4251;">
														<i class="zmdi zmdi-circle"></i>
													</span>

													<a href="#" class="filter-link stext-106 trans-04">
														Red
													</a>
												</li>

												<li class="p-b-6">
													<span class="fs-15 lh-12 m-r-6" style="color: #aaa;">
														<i class="zmdi zmdi-circle-o"></i>
													</span>

													<a href="#" class="filter-link stext-106 trans-04">
														White
													</a>
												</li>
											</ul>
										</div>

									</div>
								</div> -->
						</div>



						<div id="loadProduct">
							@include('products.list')
						</div>

						<!-- Load more -->
						<div class="flex-c-m flex-w w-full p-t-45" id="button-loadMore">
							<input type="hidden" value="1" id="page">
							<a onclick="loadMore()" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
								Load More
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
	</section>




	@include('footer')

</body>

</html>