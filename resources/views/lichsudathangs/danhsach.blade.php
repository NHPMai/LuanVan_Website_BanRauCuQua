@extends('home')

@section('content')
<link href="/template/css/table/bang.css" rel="stylesheet">



<div class="wrapper" style="text-align: center;">
  <div style="width: 100%; text-align:center; ">
    @include('admin.alert')
  </div>
  <h1 style="font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif ;color:brown ;font-weight:600; font-style:italic; margin-top:20px; text-align:left;"><i class="zmdi zmdi-shopping-cart"></i> Lịch sử đặt hàng của bạn </h1>
  <div class="table">

    <div class="hang header" style="font-size: 16px;">
      <div class="cell">
        #ID
      </div>

      <div class="cell">
        Địa chỉ giao hàng
      </div>

      <div class="cell">
        Trạng thái đơn hàng
      </div>

      <div class="cell">
        Tổng tiền
      </div>

      <div class="cell">
        Phương thức thanh toán
      </div>

      <div class="cell">
        Thời gian đặt hàng
      </div>

      <div class="cell">
        Ngày cập nhật trạng thái
      </div>

      <div class="cell">
        Hành động
      </div>
    </div>

    @foreach($b as $key => $b)
    <div class="hang">
      <div class="cell" data-title="Username">
        {{ $b->id}}
      </div>
      <div class="cell" data-title="Username">
        {{ $b->dh_diachigiaohang}}
      </div>
      <div class="cell" data-title="Username">
        @if( $b->dh_trangthai == 1)
        <td class="column-6" style="text-align: center;vertical-align: middle">
          <button style="background-color: #b0b5ae; border-radius: 8px; font-weight:700">Chờ duyệt &nbsp <i class="fa fa-clock-o"></i></button>
        </td>
        @elseif( $b->dh_trangthai == 2)
        <td class="column-6" style="text-align: center;vertical-align: middle">
          <button style="background-color: #10dee6; border-radius: 8px; font-weight:700">Đã Duyệt &nbsp <i class="fa fa-calendar-check-o"></i></button>
        </td>
        @elseif( $b->dh_trangthai == 3)
        <td class="column-6" style="text-align: center;vertical-align: middle">
          <button style="background-color: #ede609; border-radius: 8px; font-weight:700">Đang giao &nbsp <i class="fa fa-bus"></i></button>
        </td>
        @elseif( $b->dh_trangthai == 4)
        <td class="column-6" style="text-align: center;vertical-align: middle">
          <button style="background-color: #68db2a; border-radius: 8px; font-weight:700">Giao hàng thành công &nbsp <i class="fas fa-check"></i></button>
        </td>
        @endif
      </div>
      <div class="cell" data-title="Username" style="font-size: 18px; text-align: center;vertical-align: middle">
        {{ number_format($b->dh_thanhtien, 0, '', '.') }} đ
      </div>


      <div class="cell" style="padding-right:0">
        @if( $b->phuongthucthanhtoan_id ==1 )
        <td style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">
          <button style="background-color:#ede609; border-radius: 8px; font-weight:600"> Thanh toán khi nhận hàng &nbsp <i class="far fa-money-bill-alt"></i></button>
        </td>
        @elseif( $b->phuongthucthanhtoan_id ==2 )
        <td style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">
          <button style="background-color:lightblue; border-radius: 8px; font-weight:600"> Thanh toán qua PayPal &nbsp <i class="fab fa-paypal"></i></button>
        </td>
        @endif
      </div>

      <div class="cell" data-title="Email" style="font-size: 15px; text-align: center;vertical-align: middle">
        {{ $b->dh_thoigiandathang}}
      </div>
      <div class="cell" data-title="Password" style="font-size: 15px; text-align: center;vertical-align: middle">
        {{$b->updated_at}}
      </div>
      <div class="cell" data-title="Active">
        <a class="btn btn-primary btn-sm" href="/user/order_history_detail/{{ $b->id }}">
          <i class="fas fa-eye"></i>
        </a>
      </div>
    </div>

    @endforeach


  </div>

</div>
@endsection