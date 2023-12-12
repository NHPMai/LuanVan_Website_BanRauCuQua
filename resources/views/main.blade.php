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
	<section class="section-slide" id="slider" style="padding-bottom: 20px;">
		<!-- <div class="container"> -->
		<div class="row">
			<div class="col-sm-12">
				<div class="wrap-slick1">
					<div class="slick1">

						@foreach($sliders as $slider)

						<div class="item-slick1" style="background-image: url({{$slider->thumnb}}); height:100% ; ">
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
		<!-- </div> -->

	</section>

	<article class="introduce m-b-5 ">
		<div class="container">
			<div class="row justify-content-end">
				<div class="col-lg-6">
					<img class="rounded img-fluid" src="/template/images/slider-1.jpg" alt="">
				</div>

				<div class="col-lg-6 mt-5">
					<p style=" font-size:60px; font-weight: 700; font-style:italic; font-family:serif; color: #DEB887; margin-bottom: 10px;">Cửa hàng rau quả</p>
					<p style="line-height: 2.5; font-size: 17px; text-align:justify">
						Cửa hàng rau củ quả Vegetables Family lấy tiêu chí “sạch” phải được đặt lên hàng đầu, khách hàng luôn quan tâm đến nguồn hàng chất lượng
						Chính vì thế để tăng thêm lòng tin của khách hàng về chất lượng sản phẩm, chúng tôi cần có giấy chứng nhận chất lượng cho nơi sản xuất rau mà cửa hàng nhập hàng.
						Đây chính là lời cam kết đảm bảo tốt nhất của bạn dành cho khách hàng.
					</p>
				</div>
			</div>
		</div>
	</article>

	<article class="service bg-light ">
		<div class="container pb-5">
			<div class="row  align-items-end">
				<div class="col-lg-12 text-center my-4">
					<p style=" font-size:40px; font-weight: 700; font-style:italic; font-family:serif; color: #CC9966; ">Các Loại Sản Phẩm Trong Cửa Hàng</p>
				</div>

				<div class="col-lg-4 text-center ">
					<div class="col-lg-12  ">
						<img class="img-fluid " src="/template/images/rau.png" style="weight:200px; height:200px">
					</div>
					<div class="col-lg-12 ">
						<h5 style="font-size: 20px; font-weight: bold; color: #FF8000">Rau xanh</h5>
						<p style="line-height: 2; font-size: 17px; text-align:center">Rau xanh là thực phẩm rất giàu vitamin, khoáng chất và chất xơ, ít calo. Rau xanh có thể giúp kiểm soát cân nặng, giảm nguy cơ mắc một số bệnh ung thư, bệnh tim. </p>
					</div>
				</div>

				<div class="col-lg-4 text-center ">
					<div class="col-lg-12  ">
						<img class="img-fluid " src="/template/images/cu.icon.png" style="weight:200px; height:200px">
					</div>
					<div class="col-lg-12 ">
						<h5 style="font-size: 20px; font-weight: bold; color: #FF8000">Củ các loại</h5>
						<p style="line-height: 2; font-size: 17px; text-align:center">Rau củ là thành phần không thể thiếu trong tháp dinh dưỡng cơ bản. Trong mỗi bữa ăn, đặc biệt là bữa trưa nên có rau xanh hoặc củ quả, giàu chất xơ.</p>
					</div>
				</div>

				<div class="col-lg-4  text-center">
					<div class="col-lg-12 ">
						<img class="img-fluid " src="/template/images/traicay.icon.png" style="weight: 200px; height:200px">
					</div>
					<div class="col-lg-12 p-0">
						<h5 style="font-size: 20px; font-weight: bold; color: #FF8000">Trái cây</h5>
						<p style="line-height: 2; font-size: 17px; text-align:center">Trái cây là nguồn cung cấp nhiều chất dinh dưỡng thiết yếu được tiêu thụ ít, bao gồm kali, chất xơ, vitamin C và folate (axit folic),giàu kali có thể giúp duy trì huyết áp khỏe mạnh.</p>
					</div>
				</div>

			</div>
		</div>
	</article>

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

			<div>
				<div class="flex-w flex-sb-m ">
					<div class="flex-w flex-l-m filter-tope-group m-tb-10">
						<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
							Tất Cả Sản Phẩm
						</button>
					</div>

					<div class="flex-w flex-c-m m-tb-10 ">

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


					<!-- Filter -->

					<!-- <div class="row">
									<div class="col-md-4">
										<label for="amount">Sắp xếp theo</label>
										<form>
											@csrf
											<section name = "sort_by" id="loc">
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

					<div class="dis-none panel-filter w-full p-t-10">
						<div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
							<div class="filter-col1 p-r-15 p-b-27">
								<div class="mtext-102 cl2 p-b-15" value="{{Request::url()}}?sort_by=none">
									Sắp xếp theo
								</div>

								<ul>
									<li class="p-b-6">
										<option value="{{Request::url()}}?sort_by=ten_a_z" class="filter-link stext-106 trans-04">
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
					</div>
				</div>







				<div id="loadProduct">
					@include('products.list')
				</div>

				
				<!-- <div class="flex-c-m flex-w w-full p-t-20 p-b-20" id="button-loadMore">
					<input type="hidden" value="1" id="page">
					<a onclick="loadMore()" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
						Load More
					</a>
				</div> -->
			</div>

		</div>
	</section>




	@include('footer')

</body>

</html>