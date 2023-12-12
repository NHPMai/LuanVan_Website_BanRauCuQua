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


	<!-- Banner -->
	<div class="sec-banner bg0 p-t-50">
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
	</div>

	<section class="p-t-20">
		<div class="container">
			<div class="row">
				<div class="col-sm-3 p-t-20">
					@include('sidebar')
				</div>

				<div class="col-sm-9 padding-right">

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
								<form >
									@csrf
									<select name="sort" id="sort" class="form-control" style="height: 35px;">
										<option value="{{Request::url()}}?sort_by=none" class="filter-link stext-106 trans-04">
											---Lọc theo---
										</option>

										<option value="{{Request::url()}}?sort_by=ten_a_z" class="filter-link stext-106 trans-04">
											Tên: A->Z
										</option>

										<option value="{{Request::url()}}?sort_by=ten_z_a" class="filter-link stext-106 trans-04">
											Tên: Z->A
										</option>

										<option value="{{Request::url()}}?sort_by=gia_tang_dan" class="filter-link stext-106 trans-04">
											Giá: Tăng dần
										</option>

										<option value="{{Request::url()}}?sort_by=gia_giam_dan" class="filter-link stext-106 trans-04">
											Giá: Giảm dần
										</option>


									</select>
								</form>



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

							</div>


							<div class="dis-none panel-filter w-full p-t-10">
								<div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
									<div class="filter-col1 p-r-15 p-b-27">
										
										<form>
											@csrf
											<select name="sort" id="sort" class="form-control">
												<option value="{{Request::url()}}?sort_by=none" class="filter-link stext-106 trans-04">
													-----Lọc theo-----
												</option>

												<option value="{{Request::url()}}?sort_by=ten_a_z" class="filter-link stext-106 trans-04">
													Tên: A->Z
												</option>

												<option value="{{Request::url()}}?sort_by=ten_z_a" class="filter-link stext-106 trans-04">
													Tên: Z->A
												</option>

												<option value="{{Request::url()}}?sort_by=gia_tang_dan" class="filter-link stext-106 trans-04">
													Giá: Tăng dần
												</option>

												<option value="{{Request::url()}}?sort_by=gia_giam_dan" class="filter-link stext-106 trans-04">
													Giá: Giảm dần
												</option>


											</select>
										</form>

									</div>

								</div>
							</div>
						</div>



						<div id="loadProduct">
							@include('products.list')
						</div>

				
						<!-- <div class="flex-c-m flex-w w-full p-t-45" id="button-loadMore">
							<input type="hidden" value="1" id="page">
							<a onclick="loadMore()" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
								Load More
							</a>
						</div> -->
					</div>
				</div>
			</div>
		</div>

	</section>




	@include('footer')

</body>


</html>