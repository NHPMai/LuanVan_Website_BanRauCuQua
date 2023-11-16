@extends('home')

@section('content')

<form class="bg0 p-t-100 p-b-85" action="/user/add_order" method="post">
    @include('admin.alert')



    <div class="container  p-t-50 p-l-50" style="border-radius: 5px;  background-color:aliceblue">

        <div class="row">
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" hidden name="khachhang_id" value="{{Auth::user()->id}}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="menu">Họ và Tên</label>
                            <input type="text" name="hoten" required value="{{$khachhang->hoten}}" class="form-control" placeholder="Nhập họ và tên" disabled>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="menu">Email</label>
                            <input type="text" name="email" required value="{{$khachhang->email}}" class="form-control" placeholder="Nhập họ và tên">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="menu">Số điện thoại</label>
                            <input type="number" name="sodienthoai" required value="{{$khachhang->sodienthoai}}" class="form-control" placeholder="Nhập số điện thoại">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="menu">Ghi chú</label>
                            <textarea type="text" name="dh_ghichu" value="dh_ghichu" class="form-control" placeholder="(Nếu có)"></textarea>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="menu">Địa chỉ</label>
                    <input type="text" name="diachi" required value="{{$khachhang->diachi}}" class="form-control" placeholder="Nhập địa chỉ">
                </div>

                <div>
                    <button type="submit" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 ">
                        Thêm địa chỉ
                    </button></br>
                </div>


                <div style="width:100%">
                    <form>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="menu">Chọn thành phố</label>
                                        <select name="tinh_thanhpho" id="tinh_thanhpho" class="form-control m-bot15 choose tinh_thanhpho">
                                            <option value="0">---Chọn tỉnh thành phố---</option>
                                            @foreach ($tinh_thanhpho as $key => $tp)
                                            <option value="{{$tp->id}}"> {{$tp->tp_ten}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="menu">Chọn quận huyện</label>
                                        <select name="quan_huyen" id="quan_huyen" class="form-control m-bot15 choose quan_huyen">
                                            <option value="">---Chọn quận huyện----</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="menu">Chọn xã phường</label>
                                        <select name="xa_phuong_thitran" id="xa_phuong_thitran" class="form-control m-bot15 xa_phuong_thitran">
                                            <option value="">---Chọn xã phường----</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div>
                                <input type="botton" value="Tính phí vận chuyển" name= "calculate_delivery" class="btn btn-primary btn-sm calculate_delivery">
                            </div>
                            <!-- <div style="text-align: right;">
                                <button type="button" name="add_delivery" class="btn btn-primary add_delivery">Thêm</button>
                            </div> -->
                            @csrf
                            <!-- </form> -->
                        </div>
                    </form>
                </div>


                <p>Mọi thông tin sẽ được cập nhật cho tài khoản của bạn</p>
            </div>


            <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                <div class="bor10 p-lr-40 p-t-30 p-b-20 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">

                    @php $total = 0; @endphp
                    <h4 class="mtext-109 cl2 p-b-15">
                        TỔNG TIỀN
                    </h4>

                    <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                        @foreach($products as $key => $product)
                        @php
                        $price = $product->gia;
                        $priceEnd = $price * $chitietdonhangs[$product->id];
                        $total += $priceEnd;
                        @endphp
                        @endforeach
                        <div class="size-209 w-full-ssm">
                            <span class="stext-110 cl2">
                                Tiền hàng:
                            </span>
                        </div>

                        <div class="size-208" style="text-align: right;">
                            <span class="mtext-110 cl2">
                                {{ number_format($total, 0, '', '.') }}
                            </span>
                        </div>

                        <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                            <div class="size-209 w-full-ssm">
                                <span class="stext-110 cl2">
                                    Phí vận chuyển:
                                </span>
                            </div>

                           
                            <div class="size-208 " style="text-align: right;">
                                <span class="mtext-110 cl2 phivanchuyen" id="phivanchuyen">
                              
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
                                            echo '
                                        <p> '.number_format($total_coupon,0,',','.').'đ</p>';

                                        @endphp
                                        </p>
                                    </div>
                                </div>

                                <div class="row p-1">
                                    <div class="col-6">
                                        Tiền thanh toán
                                    </div>

                                    <div class="col-6" style="text-align: right;">
                                        {{number_format($total - $total_coupon , 0,',','.') }} đ
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
                                            echo '
                                        <p> '.number_format($total_coupon,0,',','.').'đ</p>';

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
                    </div>


                    @csrf
                </div>


                <div class="bor10 p-lr-40 p-t-15 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">

                    <h4 class="mtext-108 cl2 p-b-15">
                        PHƯƠNG THỨC THANH TOÁN
                    </h4>


                    <input type="radio" id="html" name="fav_language" value="HTML">
                    <label for="html">Thanh toán khi giao hàng</label><br>
                    <input type="radio" id="html" name="fav_language" value="HTML">
                    <label for="html">PayPal</label><br>
                    <input type="radio" id="html" name="fav_language" value="HTML">
                    <label for="html">VNPay</label><br>



                    <button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer" type="submit">
                        Đặt hàng
                    </button>
                </div>
            </div>
        </div>
    </div>
    @csrf
</form>
@endsection