@extends('home')

@section('content')

<form class="bg0 p-t-50 p-b-85" action="/user/add_order" method="post">





    <div class="container  p-t-30 p-l-50" style="border-radius: 5px;  background-color:aliceblue">
        <div style="width: 100%; text-align:center; ">
            @include('admin.alert')
        </div>

        <h1 style="font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif ;color:brown; font-weight:600; font-style:italic; margin-top:0px; margin-bottom: 20px">
            Thanh toán đơn hàng của bạn ở đây
        </h1>

        <div class="row">
            <div class="col-lg-10 col-xl-7 m-lr-auto ">
                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" hidden name="khachhang_id" value="{{Auth::user()->id}}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="menu" style="font-size: medium;">Họ và Tên <span class="text-danger">(*)</span></label>
                            <input type="text" name="hoten" required value="{{$khachhang->hoten}}" class="form-control" style="font-size: medium;" placeholder="Nhập họ và tên" disabled>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="menu" style="font-size: medium;">Email <span class="text-danger">(*)</span></label>
                            <input type="text" name="email" required value="{{$khachhang->email}}" class="form-control" style="font-size: medium;" placeholder="Nhập họ và tên" disabled>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="menu" style="font-size: medium;">Số điện thoại <span class="text-danger">(*)</span></label>
                            <input type="number" name="sodienthoai" required value="{{$khachhang->sodienthoai}}" class="form-control" style="font-size: medium;" placeholder="Nhập số điện thoại">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="menu" style="font-size: medium;">Ghi chú</label>
                            <input type="text" name="dh_ghichu" class="form-control" style="font-size: medium;" placeholder="(Nếu có)"></input>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="menu" style="font-size: medium; ">Địa chỉ</label>
                    <select class="form-control calculate_delivery" name="diachi_id" style="height: 35px; font-size: medium">
                        <option value="" style="font-size: medium;" >-----Chọn-----</option>
                        @foreach($diachi as $dc)
                        <option  value="{{ $dc->id }}" style="font-size: medium;" >{{ $dc->dc_diachi . ',' . $dc->xa_phuong_thitran->xa_ten . ', ' . $dc->quan_huyen->qh_ten . ', ' . $dc->tinh_thanhpho->tp_ten  }}</option>
                        @endforeach
                    </select>


                    <!-- <select class="form-control " name="diachi_id" style="height: 35px; font-size: medium">
                        <option value="" style="font-size: medium;" >-----Chọn-----</option>
                        @foreach($diachi as $dc)
                        <option  value="{{ $dc->id }}" style="font-size: medium;" >{{ $dc->dc_diachi . ',' . $dc->xa_phuong_thitran->xa_ten . ', ' . $dc->quan_huyen->qh_ten . ', ' . $dc->tinh_thanhpho->tp_ten  }}</option>
                        @endforeach
                    </select> -->
                </div>

                <div>

                    <button type="button" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 ">
                        <a href="{{URL::to('/user/account')}}" style="color: white;">Thêm địa chỉ</a>
                    </button></br>

                </div>


                <div style="width:100%">
                    <!-- <form>
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
                           
                            @csrf
                        </div>
                    </form> -->
                </div>


                <p>Mọi thông tin sẽ được cập nhật cho tài khoản của bạn</p>
                <img src="/template/images/anh.png" style="width: 300px;">

            </div>


            <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto ">
                <div class="bor10 p-lr-20 p-t-15 p-b-10 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">

                    @php $total = 0; @endphp
                    <p class="p-b-5" style="font-size:20px;font-weight:800  ;">
                        TỔNG TIỀN
                    </p>

                    <div class="flex-w flex-t p-t-15">
                        @foreach($products as $key => $product)
                            @php
                                $price = $product->gia;
                                $priceEnd = $price * $chitietdonhangs[$product->id];
                                $total += $priceEnd;
                            @endphp
                        @endforeach
                        
                        <div class="size-209 w-full-ssm ">
                            <span style="font-size: 20px;">
                                Tiền hàng:
                            </span>
                        </div>

                        <div class="size-208 " style="text-align: right;">
                            <span class="mtext-110 cl2">
                                {{ number_format($total, 0, '', '.') }} đ
                            </span>
                        </div>

                        <div class="flex-w flex-t p-t-15 ">
                            <div class="size-209 w-full-ssm m-b-10" style="width:150px">
                                <span style="font-size: 20px;">
                                    Phí vận chuyển:
                                </span>
                            </div>


                            <div class="size-208 m-b-10" style="text-align: right; padding-left: 100px;">
                                <span class="mtext-110 cl2 phivanchuyen" id="phivanchuyen">
                                    
                                </span>
                            </div>

                            <div style="width: 100%">
                                @if(Session::get('coupon'))
                                @foreach(Session::get('coupon') as $key => $cou)
                                @if ($cou['mgg_loaigiamgia']==1)
                                <div class="row p-1">
                                    <div class="col-6" style="font-size: 20px;">
                                        Mã giảm giá
                                    </div>

                                    <div class="col-6 mtext-110" style="text-align: right;">
                                        {{$cou['mgg_giatrigiamgia']}}%
                                    </div>
                                </div>


                                <div class="row p-1">
                                    <div class="col-8 " style="font-size:20px; padding-top: 10px;">
                                        Tổng tiền được giảm
                                    </div>

                                    <div class="col-4" style="text-align: right;">
                                        <p class="mtext-110">
                                            @php
                                            $total_coupon = ($total*$cou['mgg_giatrigiamgia'])/100;
                                            echo '
                                        <p class="mtext-110"> '.number_format($total_coupon,0,',','.').' đ</p>';

                                        @endphp
                                        </p>
                                    </div>
                                </div>

                                <div class="row p-1">
                                    <div class="col-6" style="font-size: 20px;">
                                        <!-- Tiền thanh toán -->
                                    </div>

                                    <div class="col-6 mtext-110" style="text-align: right; font-size: 20px;">
                                        <!-- {{number_format($total - $total_coupon , 0,',','.') }} đ -->
                                    </div>
                                </div>


                                @elseif($cou['mgg_loaigiamgia']==2)
                                <div class="row p-1">
                                    <div class="col-6" style="font-size: 20px;">
                                        Mã giảm giá
                                    </div>

                                    <div class="col-6 mtext-110" style="text-align: right;">
                                        {{number_format($cou['mgg_giatrigiamgia'], 0,',','.') }} đ
                                    </div>
                                </div>

                                <div class="row p-1 ">
                                    <div class="col-8 " style="font-size: 20px; padding-top: 10px;">
                                        Tổng tiền được giảm
                                    </div>

                                    <div class="col-4" style="text-align: right; font-size: 20px;">
                                        <p class="mtext-110">
                                            @php
                                            $total_coupon = $cou['mgg_giatrigiamgia'];
                                            echo '
                                        <p> '.number_format($total_coupon,0,',','.').'đ</p>';

                                        @endphp
                                        </p>
                                    </div>
                                </div>
                                <hr class="m-tb-10">
                                <div class="row p-1">
                                    <div class="col-6" style="font-size: 20px;">
                                        <!-- Tiền thanh toán -->
                                    </div>

                                    <div class="col-6 mtext-110" style="text-align: right;">
                                        <!-- {{number_format($total - $total_coupon, 0,',','.') }} đ -->
                                    </div>
                                </div>
                                @endif

                                @endforeach
                                @else

                                <div class="row p-1">
                                    <div class="col-6" style="font-size: 20px;">
                                        <!-- Tiền thanh toán -->
                                    </div>

                                    <div class="col-6 mtext-110" style="text-align: right;">
                                        <!-- {{number_format($total, 0,',','.') }} đ -->
                                    </div>
                                </div>
                                @endif

                            </div>

                        </div>
                    </div>
                   


                    @csrf
                </div>


                <div class="bor10 p-lr-40 p-t-15 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">

                    <p class="cl2 p-b-15" style="font-size: 20px; font-weight:700">
                        PHƯƠNG THỨC THANH TOÁN
                    </p>




                    <div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" style="font-size: 15px;">Chọn hình thức thanh toán</label>


                            <select name="payment_select" class="form-control input-sm m-bot15 payment_select" style="height: 30px; font-size: 15px;">

                                @foreach($phuongthucthanhtoan as $key => $pttt)
                                <option value="{{$pttt->id}}" style="font-size: 15px;">{{$pttt->pttt_mota}}</option>
                                @endforeach

                            </select>


                        </div>
                    </div>




                    <div>
                        @php
                        $vnd_to_usd = $total/24265;
                        $total_paypal = round($vnd_to_usd,2);
                        {{Session::put('total_paypal',$total_paypal);}}
                        @endphp
                        <div id="paypal-button-container"></div>
                    </div>




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