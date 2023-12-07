@extends('home')
@section('content')
<div class="container p-t-80">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
        <a href="/shop" class="stext-109 cl8 hov-cl1 trans-04">
            Sản phẩm
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <a href="/danh-muc/{{ $product->menu->id }}-{{ Str::slug($product->menu->name) }}.html" class="stext-109 cl8 hov-cl1 trans-04">
            {{ $product->menu->name }}
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <span class="stext-109 cl4">
            {{ $title }}
        </span>
    </div>
</div>

<section class="sec-product-detail bg0 p-t-65 p-b-30">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-7 p-b-30">
                <div class="p-l-25 p-r-30 p-lr-0-lg">
                    <div class="wrap-slick3 flex-sb flex-w">
                        <div class="wrap-slick3-dots">
                            <ul class="slick3-dots" role="tablist">
                                <li class="slick-active" role="presentation">
                                    <img src="{{ $product->hinhanh}}">
                                    <div class="slick3-dot-overlay"></div>
                                </li>
                                <li class="slick-active" role="presentation">
                                    <img src="{{ $product->hinhanh }}">
                                    <div class="slick3-dot-overlay"></div>
                                </li>
                                <li class="slick-active" role="presentation">
                                    <img src="{{ $product->hinhanh }}">
                                    <div class="slick3-dot-overlay"></div>
                                </li>
                                <li class="slick-active" role="presentation">
                                    <img src="{{ $product->hinhanh }}">
                                    <div class="slick3-dot-overlay"></div>
                                </li>
                            </ul>
                        </div>


                        <div class="slick3 gallery-lb slick-initialized slick-slider slick-dotted">
                            <div class="slick-list draggable">
                                <div class="slick-track" style="opacity: 1; width: 1539px;">
                                    <div class="item-slick3 slick-slide slick-current slick-active" data-thumb="images/product-detail-01.jpg" data-slick-index="0" aria-hidden="false" style="width: 513px; position: relative; left: 0px; top: 0px; z-index: 999; opacity: 1;" tabindex="0" role="tabpanel" id="slick-slide10" aria-describedby="slick-slide-control10">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="{{ $product->hinhanh }}" alt="IMG-PRODUCT">

                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-01.jpg" tabindex="0">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-5 p-b-30">
                <div class="p-r-50 p-t-5 p-lr-0-lg">

                    @include('admin.alert')

                    <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                        {{ $title }}
                    </h4>

                    <span class="mtext-106 cl2">
                        {!! \App\Helpers\Helper::gia($product->gia) !!} đ/kg
                    </span>

                    <p class="stext-102 cl3 p-t-23" style="text-align: justify;">
                        {{ $product->mota }}
                    </p>

                    <p class="p-t-5" style="font-size:20px; font-weight:500">
                        Danh mục: {{ $product->menu->name }}
                    </p>

                    <p class="p-t-5" style="font-size:20px; font-weight:500">
                        Thương hiệu: {{ $product->brand->ten }}
                    </p>

                    <p class="p-t-5" style="font-size:20px; font-weight:500">
                        Số lượng sản phẩm: {{ $product->soluongsp }} kg
                    </p>

                    <!--  -->
                    <div class="p-t-33">
                        <div class="flex-w flex-r-m p-b-10">
                            <div class="size-204 flex-w flex-m respon6-next">
                                <form action="{{route('user.add-order-detail')}}" method="post">
                                    @if ($product->gia !== NULL) <!-- đối với ko có giá cần liên hệ -->
                                    <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                        <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-minus"></i>
                                        </div>

                                        <input class="mtext-104 cl3 txt-center num-product" type="number" name="num_product" value="1">

                                        <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-plus"></i>
                                        </div>
                                    </div>


                                    <button type="submit" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 ">
                                        Thêm vào giỏ hàng
                                    </button>
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    @endif
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>

                    <!--  -->
                    <div class="flex-w flex-m p-l-100 p-t-40 respon7">
                        <div class="flex-m bor9 p-r-10 m-r-11">
                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100" data-tooltip="Add to Wishlist">
                                <i class="zmdi zmdi-favorite"></i>
                            </a>
                        </div>

                        <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
                            <i class="fa fa-facebook"></i>
                        </a>

                        <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
                            <i class="fa fa-twitter"></i>
                        </a>

                        <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Google Plus">
                            <i class="fa fa-google-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="bor10 m-t-50 p-t-43 p-b-40">
            <!-- Tab01 -->
            <div class="tab01">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item p-b-10">
                        <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Mô tả Sản Phẩm</a>
                    </li>

                    <li class="nav-item p-b-10">
                        <a class="nav-link" data-toggle="tab" href="#information" role="tab">Thông Tin Chi Tiết</a>
                    </li>

                    <li class="nav-item p-b-10">
                        <a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Đánh Giá</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content ">
                    <!-- - -->
                    <div class="tab-pane fade show active" id="description" role="tabpanel">
                        <div class="how-pos2 ">
                            <span style="font-size: 20px; text-align:justify">
                                {!! $product->noidung !!}
                            </span>
                        </div>
                    </div>

                    <!-- - -->
                    <div class="tab-pane fade" id="information" role="tabpanel">
                        <div class="row">
                            <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                <ul class="p-l-200 p-lr-15-sm">
                                    <li class="flex-w flex-t p-b-7">
                                        <span class="stext-102 cl3 size-205">
                                            Trọng Lượng
                                        </span>

                                        <span class="stext-102 cl6 size-206">
                                            1 Kg
                                        </span>
                                    </li>

                                    <li class="flex-w flex-t p-b-7">
                                        <span class="stext-102 cl3 size-205">
                                            Kích Thước
                                        </span>

                                        <span class="stext-102 cl6 size-206">
                                            Vừa
                                        </span>
                                    </li>

                                    <li class="flex-w flex-t p-b-7">
                                        <span class="stext-102 cl3 size-205">
                                            Chất Lượng
                                        </span>

                                        <span class="stext-102 cl6 size-206">
                                            Tươi Sạch
                                        </span>
                                    </li>

                                    <li class="flex-w flex-t p-b-7">
                                        <span class="stext-102 cl3 size-205">
                                            Hương vị
                                        </span>

                                        <span class="stext-102 cl6 size-206">
                                            Thơm Ngon
                                        </span>
                                    </li>

                                    <li class="flex-w flex-t p-b-7">
                                        <span class="stext-102 cl3 size-205">
                                            Tình Trạng
                                        </span>

                                        <span class="stext-102 cl6 size-206">
                                            Có Sẵn
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- - -->
                    <div class="tab-pane fade" id="reviews" role="tabpanel">
                        <div class="row">
                            <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                <div class="p-b-30 m-lr-15-sm">

                                    <p class="stext-102 cl6 m-t-20">
                                        Hãy đánh giá thoải mái, tên và email của bạn sẽ không được hiện lên bạn nhé! <br>Cảm ơn các bạn!
                                    </p>

                                    <div class="flex-w flex-m p-t-20 p-b-23">
                                        <span class="stext-102 cl3 m-r-16">
                                            Đánh giá
                                        </span>

                                        <span class="wrap-rating fs-18 cl11 pointer">

                                            <ul class="list-inline" title="Average Rating" style="margin-bottom:0px">
                                                @for($count=1; $count<=5; $count++) @php if($count <=$rating){ $color='color:#ffcc00;' ; } else { $color='color:#ccc;' ; } @endphp <li title="start_rating" id="{{$product->id}}-{{$count}}" data-index="{{$count}}" data-product_id="{{$product->id}}" data-rating="{{$rating}}" class="rating" style="cursor: pointer; {{$color}} ; font-size:30px;">
                                                    &#9733;

                                                    </li>

                                                    @endfor
                                            </ul>




                                        </span>
                                    </div>

                                    <!-- Review -->
                                    <form>
                                        @csrf
                                        <input type="hidden" name="product_id" class="product_id" value="{{$product->id}}">
                                        <div id="comment_show"></div>
                                        

                                    </form>

                                    <!-- Add review -->
                                    <form action="#" class="w-full">

                                        <div class="row p-b-25">
                                            <div class="col-12 ">
                                                <label class="stext-102 cl3 m-t-20" for="review">Nội dung bình luận</label>
                                                <textarea class="comment_content size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="review" name="binhluan" ></textarea>
                                            </div>
                                            <div class="col-sm-6 p-b-5">
                                                <label class="stext-102 cl3" for="name">Tên bình luận</label>
                                                <input class="comment_name size-111 bor8 stext-102 cl2 p-lr-20" id="name" type="text" name="bl_ten">
                                            </div>
                                        </div>
                                        
                                        <div id="notify_comment"></div>

                                        <button class="send_comment flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10" type="button">
                                            Gửi bình luận
                                        </button>
                                       

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">

        <span class="stext-107 cl6 p-lr-25">
            Danh Mục: {{ $product->menu->name }}
        </span>
    </div>
</section>

<section class="sec-relate-product bg0 p-b-105">
    <div class="container">
        <div class="p-b-20">
            <h3 class="cl5 txt-center" style="font-family: arial; font-size: 40px ; font-weight:bolder">
                CÁC SẢN PHẨM LIÊN QUAN
            </h3>
        </div>

        @include('products.list')
    </div>
</section>

@endsection