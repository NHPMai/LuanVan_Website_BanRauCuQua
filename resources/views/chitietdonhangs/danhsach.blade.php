@extends('home')

@section('content')
<form class="bg0 p-t-60" method="post">
    @include('admin.alert')

    @if (count($products) != 0)
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-8 ">
                <div class="m-l-25 m-r--38 m-lr-0-xl">
                    <div class="wrap-table-shopping-cart">
                        @php $total = 0; @endphp
                        
                        <table class="table-shopping-cart">
                            <tbody>
                                <tr class="table_head">
                                    <th class="column-1">Sản Phẩm</th>
                                    <th class="column-2"></th>
                                    <th class="column-3">Giá</th>
                                    <th class="column-4">Số Lượng</th>
                                    <th class="column-5">Tổng</th>
                                    <th class="column-6">&nbsp;</th>
                                </tr>

                                @foreach($products as $key => $product)
                                @php
                                $price = $product->gia;
                                $priceEnd = $price * $chitietdonhangs[$product->id];
                                $total += $priceEnd;
                                @endphp
                                <tr class="table_row">
                                    <td class="column-1">
                                        <div class="how-itemcart1">
                                            <img src="{{ $product->hinhanh }}" alt="IMG">
                                        </div>
                                    </td>
                                    <td class="column-2">{{ $product->ten }}</td>
                                    <td class="column-3">{{ number_format($price, 0, '', '.') }}</td>
                                    <td class="column-4">
                                        <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-minus"></i>
                                            </div>

                                            <input class="mtext-104 cl3 txt-center num-product" type="number" name="num_product[{{ $product->id }}]" value="{{ $chitietdonhangs[$product->id] }}">

                                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-plus"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="column-5">{{ number_format($priceEnd, 0, '', '.') }}</td>
                                    <td class="p-r-15">
                                        <a href="/user/order-detail/delete/{{ $product->id }}">Xóa</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="flex-w flex-sb-m bor15 p-lr-40 p-lr-15-sm">

                        <td class="p-r-15">
                           
                            <a href="/user/delete_all"></a>
                        </td>

                        <input type="submit" value="Cập Nhật Giỏ Hàng" formaction="/user/update-order-detail" class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                        @csrf
                    </div>
                   
                </div>
            </div>


            <div class="col-sm-10 col-lg-7 col-xl-4">
                <div class="bor10 p-lr-10 p-t-30 p-b-40 m-l-40 m-r-40 m-lr-0-xl ">

                    <h4 class="mtext-109 cl2 p-b-15">
                        GIỎ HÀNG
                    </h4>

                    <div class="flex-w flex-t bor12 p-b-13">
                        <div class="size-209">
                            <span class="stext-110 cl2">
                                Tổng Cộng:
                            </span>
                        </div>

                        <div class="size-208" style="text-align: right;">
                            <span class="mtext-110 cl2">
                                {{ number_format($total, 0, '', '.') }}
                            </span>
                        </div>
                    </div>

                    <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                        <div class="size-209 w-full-ssm">
                            <span class="stext-110 cl2">
                                Vận chuyển:
                            </span>
                        </div>

                        <div class="size-208" style="text-align: right;">
                            <span class="mtext-110 cl2">
                                0
                            </span>
                        </div>

                        <div style="width: 100%">
                            @if(Session::get('coupon'))
                                @foreach(Session::get('coupon') as $key => $cou)
                                    @if ($cou['mgg_loaigiamgia']==1)
                                        <div class="row p-1">
                                            <div class="col-6">
                                                Mã giảm giá
                                            </div>

                                            <div class="col-6" style="text-align: right;">
                                                {{$cou['mgg_giatrigiamgia']}}%
                                            </div>
                                        </div>
                                        
                                        <div class="row p-1">
                                            <div class="col-8 " style=" padding-top: 10px;">
                                                Tổng tiền được giảm
                                            </div>

                                            <div class="col-4" style="text-align: right;">
                                                <p>
                                                    @php 
                                                        $total_coupon = ($total*$cou['mgg_giatrigiamgia'])/100;
                                                        echo '<p> '.number_format($total_coupon,0,',','.').'đ</p>';
                                                      
                                                    @endphp
                                                </p>
                                            </div>
                                        </div>

                                        <div class="row p-1">
                                            <div class="col-6">
                                                Tiền thanh toán
                                            </div>

                                            <div class="col-6" style="text-align: right;">
                                                {{number_format($total - $total_coupon, 0,',','.') }} đ
                                            </div>
                                        </div>
                                        

                                    @elseif($cou['mgg_loaigiamgia']==2)
                                        <div class="row p-1">
                                            <div class="col-6">
                                                Mã giảm giá
                                            </div>

                                            <div class="col-6" style="text-align: right;">
                                                {{number_format($cou['mgg_giatrigiamgia'], 0,',','.') }} đ
                                            </div>
                                        </div>

                                        <div class="row p-1">
                                            <div class="col-8 " style=" padding-top: 10px;">
                                                Tổng tiền được giảm
                                            </div>

                                            <div class="col-4" style="text-align: right;">
                                                <p>
                                                    @php 
                                                        $total_coupon = $cou['mgg_giatrigiamgia'];
                                                        echo '<p> '.number_format($total_coupon,0,',','.').'đ</p>';
                                                        
                                                    @endphp
                                                </p>            
                                            </div>
                                        </div>

                                        <div class="row p-1">
                                            <div class="col-6">
                                                Tiền thanh toán
                                            </div>

                                            <div class="col-6" style="text-align: right;">
                                                {{number_format($total - $total_coupon, 0,',','.') }} đ
                                            </div>
                                        </div>
                                    @endif
                                    
                                @endforeach
                            @else
                                <div class="row p-1">
                                    <div class="col-6">
                                        Tiền thanh toán
                                    </div>

                                    <div class="col-6" style="text-align: right;">
                                        {{number_format($total, 0,',','.') }} đ
                                    </div>
                                </div>
                            @endif
                            
                        </div>

                    </div>


                    <!-- <div class="flex-w flex-t p-t-27 p-b-33">
                        <div class="size-209">
                            <span class="mtext-101 cl2">
                                Tiền thanh toán:
                            </span>
                        </div>

                        <div class="size-208 p-t-1" style="text-align: right;">
                            <span class="mtext-110 cl2">
                            
                            </span>
                        </div>
                    </div> -->

                    <a href="/user/checkout" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer" type="submit">
                        THANH TOÁN
                    </a>
                    @csrf

                </div>
            </div>
        </div>
    </div>
</form>


    <!-- <form action="/user/check_coupon" method="post">
    
        <div class="flex-w flex-m m-r-20 m-tb-5">
            <input class=" cl2 plh4 size-115 bor13 p-lr-20 m-r-10 m-tb-5" type="text" name="coupon" placeholder="Mã giảm giá">

            <input type="submit" value="Áp dụng" name="check_coupon" class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">

        </div>
        
        @csrf
    </form>
    @if(Session::get('coupon'))
        <a href="/user/delete_coupon">Xóa mã giảm giá</a>
    @endif -->

    <div >
        <div class="container">
            <div class="cart__discount container">
                @php
                    $cou = $cou ?? ['mgg_magiamgia' => ''];
                @endphp
                <form action="check_coupon" method="POST">
                    @csrf
                    <!-- <input type="text" name="coupon" style="color: black" placeholder="Nhập mã giảm giá" value="{{ old($cou['mgg_magiamgia'], $cou['mgg_magiamgia']) }}">
                    <button type="submit">Áp dụng</button> -->
                    <div class="flex-w flex-m m-r-20 m-tb-5">
                        <input class="stext-106 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text" name="coupon"  placeholder="Nhập mã giảm giá" value="{{ old($cou['mgg_magiamgia'], $cou['mgg_magiamgia']) }}">
                            
                        <button type="submit" class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
                            Áp dụng
                        </button>

                        @if(Session::get('coupon'))
                        <button type="submit" class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5" style="margin-left: 20px";>
                            <a href="/user/delete_coupon">Xóa mã giảm giá</a>
                        </button>
                        @endif
                    </div>
                </form>
                
                    
                
            </div>
        </div>
    </div>

<!-- <div class="text-center">
    <h2>Giỏ hàng trống</h2>
</div> -->
@endif
@endsection