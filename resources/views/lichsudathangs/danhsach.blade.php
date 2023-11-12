@extends('home')

@section('content')
<link href="/template/css/table/bang.css" rel="stylesheet">

<div class="wrapper">

  <div class="table">

    <div class="hang header" style="font-size: medium;">
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
          <button style="background-color: #b0b5ae; border-radius: 8px; ">Chờ duyệt &nbsp <i class="fa fa-clock-o"></i></button>
        </td>
        @elseif( $b->dh_trangthai == 2)
        <td class="column-6" style="text-align: center;vertical-align: middle">
          <button style="background-color: #10dee6; border-radius: 8px;">Đã Duyệt &nbsp <i class="fa fa-calendar-check-o"></i></button>
        </td>
        @elseif( $b->dh_trangthai == 3)
        <td class="column-6" style="text-align: center;vertical-align: middle">
          <button style="background-color: #ede609; border-radius: 8px;">Đang giao &nbsp <i class="fa fa-bus"></i></button>
        </td>
        @elseif( $b->dh_trangthai == 4)
        <td class="column-6" style="text-align: center;vertical-align: middle">
          <button style="background-color: #68db2a; border-radius: 8px;">Giao hàng thành công &nbsp <i class="fas fa-check"></i></button>
        </td>
        @endif
      </div>
      <div class="cell" data-title="Username">
        {{ $b->dh_thanhtien}}
      </div>
      <div class="cell" data-title="Username">

      </div>
      <div class="cell" data-title="Email">
        {{ $b->dh_thoigiandathang}}
      </div>
      <div class="cell" data-title="Password">

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