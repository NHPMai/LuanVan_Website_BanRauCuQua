<!-- <div style="width:600px; margin:0 auto">
    <div>
        <h2>Xin Chao </h2>
        <p>Bạn đã đặt hàng tại cửa hàng chúng tôi, vui lòng kiểm tra lại thông tin đơn hàng của bạn</p>
        <p>
            <a href="">Xác nhận đơn hàng của bạn</a>
        </p>
    </div>

    <div class="row">
        <div class="col-md-6">
            <p>Người đặt hàng</p>
            <table border="1" cellspacing="0" cellpadding="10" style="width:100%">

            </table>
        </div>
    </div>
</div> -->



<h2>Hi {{$c_name}}</h2>

<p>
    <b>Bạn đã đặt hàng thành công tại cửa hàng chúng tôi</b>
</p>
<h4>Thông tin đơn hàng của bạn</h4>
<h4>Mã đơn hàng: {{$donhang->id}}</h4>
<h4>Ngày đặt hàng: {{$donhang->dh_thoigiandathang}} </h4>

<h4>Chi tiết đơn hàng</h4>

<!-- <table border="1" cellspacing="0" cellpadding="10" width="400">
    <tbody>
        <tr class="table_head" style="background-color:beige">
            <th class="column-1" style="text-align: center;vertical-align: middle">Hình Ảnh</th>
            <th class="column-2" style="text-align: center;vertical-align: middle">Sản Phẩm</th>
            <th class="column-3" style="text-align: center;vertical-align: middle">Giá</th>
            <th class="column-4" style="text-align: center;vertical-align: middle">Số Lượng</th>
            <th class="column-5" style="text-align: center;vertical-align: middle">Tổng</th>
        </tr>

        @foreach($chitietdonhangs as $key => $chitietdonhang)
        @php
        $price = $chitietdonhang->ctdh_gia * $chitietdonhang->ctdh_soluong;
        $total += $price;
        @endphp
        <tr>
            <td class="column-1" style="text-align: center;vertical-align: middle">
                <div class="how-itemcart1">
                    <img src="{{ $chitietdonhang->product->hinhanh}}" alt="IMG" style="width: 100px">
                </div>
            </td>
            <td class="column-2" style="text-align: center;vertical-align: middle; font-size:18px; color:navy; font-weight:700">{{ $chitietdonhang->product->ten }}</td>
            <td class="column-3" style="text-align: center;vertical-align: middle; font-size:18px; ">{{ number_format($price, 0, '', '.') }}</td>
            <td class="column-4" style="text-align: center;vertical-align: middle ; font-size:18px; ">{{ $chitietdonhang->ctdh_soluong }}</td>
            <td class="column-5" style="text-align: center;vertical-align: middle ; font-size:18px; ">{{ number_format($price, 0, '', '.') }}</td>


        </tr>
        @endforeach
        <tr>
            <td colspan="5" class="text-right" style="font-size: 20px; color:brown; font-weight:700">Tổng Tiền</td>
            <td style="font-size: 20px; color:brown; font-weight:700">{{ number_format($total, 0, '', '.') }}</td>
        </tr>

    </tbody>
</table> -->

<!-- <div class="container  p-t-50 p-l-50" style="border-radius: 5px;  background-color:aliceblue">

    <div>
        <h2>XIN CHÀO</h2>
        <p>Bạn đã đặt hàng tại cửa hàng chúng tôi, vui lòng kiểm tra lại thông tin đơn hàng của bạn và nhấn vào nút "Xác Nhận" đơn hàng của bạn</p>
        <p>
            <a href="">Xác nhận đơn hàng của bạn</a>
        </p>
    </div>
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

                    <div class="size-209 w-full-ssm p-t-15">
                        <span class="stext-110 cl2">
                            Phí Vận chuyển:
                        </span>
                    </div>

                    <div class="size-208 p-t-15" style="text-align: right;">
                        <span class="mtext-110 cl2">
                            0
                        </span>
                    </div>

                    <div class="size-209 w-full-ssm p-t-15">
                        <span class="stext-110 cl2">
                            Mã giảm giá:
                        </span>
                    </div>

                    <div class="size-208 p-t-15" style="text-align: right;">
                        <span class="mtext-110 cl2">
                            0
                        </span>
                    </div>

                    <div class="size-209 w-full-ssm p-t-15">
                        <span class="stext-110 cl2">
                            Tổng tiền được giảm:
                        </span>
                    </div>

                    <div class="size-208 p-t-15" style="text-align: right;">
                        <span class="mtext-110 cl2">
                            0
                        </span>
                    </div>
                </div>


                <div class="flex-w flex-t p-t-15 p-b-33" style="color: brown;">
                    <div class="size-209 w-full-ssm p-t-15">
                        <span class="stext-110 cl2">
                            Tiền thanh toán:
                        </span>
                    </div>

                    <div class="size-208 p-t-15" style="text-align: right;">
                        <span class="mtext-110 cl2">
                            {{ number_format($total, 0, '', '.') }}
                        </span>
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
</div> -->
@csrf