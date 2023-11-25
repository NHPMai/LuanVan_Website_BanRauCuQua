@extends('shipper.main')

@section('content')
<div class="customer mt-3">
    <ul>

        <li>Tên khách hàng: <strong>{{ $donhang->khachhangs->hoten}}</strong></li>
        <li>Số điện thoại: <strong>{{ $donhang->khachhangs->sodienthoai }}</strong></li>
        <li>Địa chỉ: <strong>{{ $donhang->khachhangs->diachi }}</strong></li>
        <li>Email: <strong>{{ $donhang->khachhangs->email }}</strong></li>
        <li>Ghi chú: <strong>{{ $donhang->dh_ghichu }}</strong></li>

    </ul>
</div>

<div class="carts">
    @php $total = 0; @endphp
    <table class="table">
        <tbody>
            <tr class="table_head" style="background-color:beige">
                <th class="column-1" style="text-align: center;vertical-align: middle">Hình Ảnh</th>
                <th class="column-2" style="text-align: center;vertical-align: middle">Sản Phẩm</th>
                <th class="column-3" style="text-align: center;vertical-align: middle">Giá</th>
                <th class="column-4" style="text-align: center;vertical-align: middle">Số Lượng</th>
                <th class="column-5" style="text-align: center;vertical-align: middle">Tổng</th>
                <th class="column-6" style="text-align: center;vertical-align: middle">Trạng Thái</th>
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
                <td class="column-2" style="text-align: center;vertical-align: middle;  font-size:18px; color:navy; font-weight:700">{{ $chitietdonhang->product->ten }}</td>
                <td class="column-3" style="text-align: center;vertical-align: middle; font-size:18px;">{{ number_format($price, 0, '', '.') }}</td>
                <td class="column-4" style="text-align: center;vertical-align: middle; font-size:18px;">{{ $chitietdonhang->ctdh_soluong }}</td>
                <td class="column-5" style="text-align: center;vertical-align: middle; font-size:18px;">{{ number_format($price, 0, '', '.') }}</td>

                @if( $donhang->dh_trangthai == 1)
                <td class="column-6" style="text-align: center;vertical-align: middle">
                    <a style="background-color: #b0b5ae; border-radius: 8px; font-weight:700; font-size:18px;">Chờ duyệt &nbsp <i class="fa fa-clock-o"></i></a>
                </td>

                @elseif( $donhang->dh_trangthai == 2)
                <td class="column-6" style="text-align: center;vertical-align: middle">
                    <a style="background-color: #10dee6; border-radius: 8px; font-weight:700; font-size:18px;">Đã Duyệt &nbsp <i class="fa fa-calendar-check-o"></i></a>
                </td>

                @elseif( $donhang->dh_trangthai == 3)
                <td class="column-6" style="text-align: center;vertical-align: middle">
                    <a style="background-color: #ede609; border-radius: 8px; font-weight:700; font-size:18px;">Đang giao &nbsp <i class="fa fa-bus"></i></a>
                </td>

                @elseif( $donhang->dh_trangthai == 4)
                <td class="column-6" style="text-align: center;vertical-align: middle">
                    <a style="background-color: #68db2a; border-radius: 8px; font-weight:700; font-size:18px;">Giao hàng thành công &nbsp <i class="fas fa-check"></i></a>
                </td>
                @endif
            </tr>
            @endforeach
            <tr>
                <td colspan="5" class="text-right" style="font-size: 20px; color:brown; font-weight:700">Tổng Tiền</td>
                <td style="font-size: 20px; color:brown; font-weight:700">{{ number_format($total, 0, '', '.') }}</td>
            </tr>

        </tbody>
    </table>
    <div class="col-md-12" style="margin-bottom: 50px;">
        <form action="" method="post">
            {{ csrf_field() }}
            <div class="col-md-8"></div>
            <div class="col-md-4">

                <div class="form-inline">
                    @if( $donhang->dh_trangthai== 1)
                    <label style="margin-bottom: 10px;">Trạng thái đơn hàng: </label>
                    <select name="dh_trangthai" class="form-control input-inline" style="width: 150px; margin-right: 10px;">ư
                        <option value="1">Chờ duyệt</option>
                        <option value="2">Đã Duyệt</option>
                        <option value="3">Đang giao</option>
                        <option value="4">Giao hàng thành công</option>
                    </select>
                    <input type="submit" value="Xác nhận" class="btn btn-primary">

                    @elseif( $donhang->dh_trangthai == 2 )
                    <label>Trạng thái đơn hàng: </label>
                    <select name="dh_trangthai" class="form-control input-inline" style="width: 150px; margin-right: 10px;">
                        <option value="2">Đã Duyệt</option>
                        <option value="3">Đang giao</option>
                        <option value="4">Giao hàng thành công</option>
                    </select>
                    <input type="submit" value="Xác nhận" class="btn btn-primary">

                    @elseif( $donhang->dh_trangthai == 3 )
                    <label>Trạng thái đơn hàng: </label>
                    <select name="dh_trangthai" class="form-control input-inline" style="width: 150px; margin-right: 10px;">
                        <option value="3">Đang giao</option>
                        <option value="4">Giao hàng thành công</option>
                    </select>
                    <input type="submit" value="Xác nhận" class="btn btn-primary">


                    @endif
                </div>
            </div>
        </form>
    </div>

    <div>

    </div>

</div>
@endsection