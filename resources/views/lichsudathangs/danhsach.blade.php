@extends('home')

@section('content')
<link href="/template/css/table/bang.css" rel="stylesheet">



<div class="wrapper" style="text-align: center;">
  <div style="width: 100%; text-align:center; ">
    @include('admin.alert')
  </div>
  <h1 style="font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif ;color:brown ;font-weight:600; font-style:italic; margin-top:20px; text-align:left;"><i class="zmdi zmdi-shopping-cart"></i> Lịch sử đặt hàng của bạn </h1>

  <table class="table pt-2">
    <thead style="background-color:blanchedalmond;">
      <tr>
        <th style="vertical-align: middle;text-align: center;  font-size:16px; border: 1px solid LightGray;">ID</th>
        <th style="vertical-align: middle;text-align: center; font-size:16px; border: 1px solid LightGray;"> Địa chỉ giao hàng</th>
        <th style="vertical-align: middle;text-align: center; font-size:16px; border: 1px solid LightGray;">Trạng thái đơn hàng</th>
        <th style="vertical-align: middle;text-align: center; font-size:16px; border: 1px solid LightGray;">Tổng tiền</th>
        <th style="vertical-align: middle;text-align: center; font-size:16px; border: 1px solid LightGray;">Phương thức thanh toán</th>
        <th style="vertical-align: middle;text-align: center; font-size:16px; border: 1px solid LightGray;">Thời gian đặt hàng</th>
        <th style="vertical-align: middle;text-align: center; font-size:16px; border: 1px solid LightGray;"> Ngày cập nhật trạng thái</th>
        <th style=" vertical-align: middle;text-align: center; font-size:16px; border: 1px solid LightGray;">Hành Động</th>
      </tr>
    </thead>
    <tbody>
      @foreach($b as $key => $b)
      <tr>
        <td style="vertical-align: middle;text-align: center; font-weight:700; border: 1px solid LightGray;">{{ $b->id}}</td>
        <td style="vertical-align: middle; text-align:left;   font-size:16px;  border: 1px solid LightGray; width:208px">{{ $b->dh_diachigiaohang}}</td>

        @if( $b->dh_trangthai == 1)
        <td class="column-6" style="text-align: center;vertical-align: middle;  border: 1px solid LightGray;">
          <span style="background-color: #b0b5ae; border-radius: 8px; font-weight:700; height: 40px;">Chờ duyệt &nbsp <i class="fa fa-clock-o"></i></span>
        </td>
        @elseif( $b->dh_trangthai == 2)
        <td class="column-6" style="text-align: center;vertical-align: middle;  border: 1px solid LightGray;">
          <span style="background-color: #10dee6; border-radius: 8px; font-weight:700; height: 40px;">Đã Duyệt &nbsp <i class="fa fa-calendar-check-o"></i></span>
        </td>
        @elseif( $b->dh_trangthai == 3)
        <td class="column-6" style="text-align: center;vertical-align: middle;  border: 1px solid LightGray;">
          <span style="background-color: #ede609; border-radius: 8px; font-weight:700; height: 40px;">Đang giao &nbsp <i class="fa fa-bus"></i></span>
        </td>
        @elseif( $b->dh_trangthai == 4)
        <td class="column-6" style="text-align: center;vertical-align: middle;  border: 1px solid LightGray;">
          <span style="background-color: #68db2a; border-radius: 8px; font-weight:700; height: 40px;">Giao hàng thành công &nbsp
            <i class="fas fa-check"></i>
          </span>
        </td>
        @elseif( $b->dh_trangthai == 5)
        <td class="column-6" style="text-align: center;vertical-align: middle;  border: 1px solid LightGray;">
          <span style="background-color:crimson; color:white ; border-radius: 8px; font-weight:700; height: 40px; padding-left:5px; padding-right:5px">Đã hủy đơn hàng &nbsp <i class="fa fa-times"></i></span>
        </td>
        @elseif( $b->dh_trangthai == 6)
        <td class="column-6" style="text-align: center;vertical-align: middle;  border: 1px solid LightGray;">
          <span style="background-color:bisque;color:red; border-radius: 8px; font-weight:700; height: 40px; padding-left:5px; padding-right:5px">Giao hàng thất bại &nbsp <i class="fa fa-times"></i></span>
        </td>
        @endif

        <td style="vertical-align: middle;text-align: center; font-weight:700;"> {{ number_format($b->dh_thanhtien, 0, '', '.') }} đ</td>
       
        @if( $b->phuongthucthanhtoan_id ==1 )
        <td style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">
          <span style="background-color:#ede609; border-radius: 8px; font-weight:600"> Thanh toán khi nhận hàng &nbsp <i class="far fa-money-bill-alt"></i></span>
        </td>
        @elseif( $b->phuongthucthanhtoan_id ==2 )
        <td style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">
          <span style="background-color:lightblue; border-radius: 8px; font-weight:600"> Thanh toán qua PayPal &nbsp <i class="fab fa-paypal"></i></span>
        </td>
        @endif

        <td style="vertical-align: middle;text-align: center; font-size:16px;  border: 1px solid LightGray;"> {{ $b->dh_thoigiandathang}}</td>
        <td style="vertical-align: middle;text-align: center;  font-size:16px;  border: 1px solid LightGray;">  {{$b->updated_at}}</td>


        <td style="vertical-align: middle;text-align: center;  border: 1px solid LightGray;">
        <a class="btn btn-primary btn-sm" href="/user/order_history_detail/{{ $b->id }}">
          <i class="fas fa-eye"></i>
        </a>

        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

</div>
@endsection