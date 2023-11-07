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
          <p>Chờ Lấy Hàng</p>
          @elseif( $b->dh_trangthai == 2)
          <p>Đang Giao</p>
          @elseif( $b->dh_trangthai == 3)
          <p>Đã Giao<p>
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
        <a class="btn btn-primary btn-sm" href="/lichsu/view/{{ $b->id }}">
            <i class="fas fa-eye"></i>
        </a>
      </div>
    </div>

    @endforeach


  </div>

</div>
@endsection