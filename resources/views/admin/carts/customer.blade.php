@extends('admin.main')

@section('content')
<!-- <p style="font-weight:bold; font-size: 20px; ">Tổng Số Đơn Hàng: {{$donhangs->count()}}</p> -->

<table class="table pt-2">
    <thead style="background-color:blanchedalmond;">
        <tr>
            <th style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">ID</th>
            <th style="text-align: center;vertical-align: middle; border: 1px solid LightGray; width:105px">Tên Khách Hàng</th>
            <th style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">Tổng tiền (vnđ)</th>
            <th style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">Tình Trạng</th>
            <th style="text-align: center;vertical-align: middle; border: 1px solid LightGray; padding-left:0px; padding-right:0px">Phương Thức Thanh Toán</th>
            <th style="text-align: center;vertical-align: middle; border: 1px solid LightGray;width: 80px;">Nhân Viên Duyệt Đơn</th>
            <th style="text-align: center;vertical-align: middle; border: 1px solid LightGray;width: 80px;">Nhân Viên Giao Hàng</th>
            <th style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">Ngày Đặt</th>
            <th style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">Hành Động</th>
        </tr>
    </thead>
    <tbody>
        @foreach($donhangs as $key => $donhang)
        <tr>
            <td style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">{{ $donhang->id }}</td>
            <td style="vertical-align: middle; border: 1px solid LightGray; text-align:center">{{ $donhang->khachhangs->hoten}}</td>
            <td style="text-align: center;vertical-align: middle; border: 1px solid LightGray; width:85px">{{number_format($donhang->dh_thanhtien, 0,',','.') }}</td>


            @if( $donhang->dh_trangthai == 1)
            <td class="column-6" style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">
                <span style="background-color: #b0b5ae; border-radius: 8px; font-weight:600 ">Chờ duyệt &nbsp <i class="	far fa-clock"></i></span>
            </td>
            @elseif( $donhang->dh_trangthai == 2)
            <td class="column-6" style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">
                <span style="background-color: #10dee6; border-radius: 8px;  font-weight:600">Đã Duyệt &nbsp<i class="	far fa-calendar-check"></i></span>
            </td>
            @elseif( $donhang->dh_trangthai == 3)
            <td class="column-6" style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">
                <span style="background-color: #ede609; border-radius: 8px;  font-weight:600">Đang giao &nbsp <i class="fas fa-truck"></i></span>
            </td>
            @elseif( $donhang->dh_trangthai == 4)
            <td class="column-6" style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">
                <span style="background-color: #68db2a; border-radius: 8px;  font-weight:600">Giao hàng thành công &nbsp <i class="fa fa-check"></i></span>
            </td>
            @elseif( $donhang->dh_trangthai == 5)
            <td class="column-6" style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">
                <span style="background-color:beige;color:crimson ;border-radius: 8px;  font-weight:600">Đã hủy đơn hàng &nbsp <i class="fa fa-times"></i> </span>
            </td>
            @elseif( $donhang->dh_trangthai == 6)
            <td class="column-6" style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">
                <span style="background-color:bisque;color:red ;border-radius: 8px;  font-weight:600">Giao hàng thất bại &nbsp <i class="fa fa-times"></i> </span>
            </td>
            @endif


            @if( $donhang->phuongthucthanhtoan_id ==1 )
            <td style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">
                <span style="background-color:#ede609; border-radius: 8px;  font-weight:600"> Thanh toán khi nhận hàng &nbsp <i class="far fa-money-bill-alt"></i></span>
            </td>
            @elseif( $donhang->phuongthucthanhtoan_id ==2 )
            <td style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">
                <span style="background-color:lightblue; border-radius: 8px;  font-weight:600"> Thanh toán qua PayPal &nbsp <i class="fab fa-paypal"></i></span>
            </td>
            @endif



            <td style="text-align: center; vertical-align: middle; border: 1px solid LightGray;">{{ $donhang->nhanviens->hoten}}</td>
            <td style="text-align: center; vertical-align: middle; border: 1px solid LightGray;">{{ $donhang->giaohangs->gh_hoten}}</td>

            <td style="text-align: center; vertical-align: middle; border: 1px solid LightGray;">{{ $donhang->dh_thoigiandathang }}</td>

            <td style="text-align: center; vertical-align: middle; border: 1px solid LightGray;">
                <a class="btn btn-primary btn-sm" href="/admin/customers/view/{{ $donhang->id }}">
                    <i class="fas fa-eye"></i>
                </a>
                <!-- @if ($donhang->dh_trangthai == 5 && $donhang->dh_huy !='')
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#xemlido" style="font-weight: 700;">
                    <i class="fas fa-eye"></i>
                </button>
                @endif -->
            </td>


        </tr>
        @endforeach
    </tbody>
</table>

<!-- Modal--XEM LÍ DO HỦY ĐƠN HÀNG-->
<!-- <div style="margin-top:200px" class="modal fade" id="xemlido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Xem lí do hủy đơn hàng </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            <textarea   disabled>{{$donhang->dh_id}}</textarea>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
          </div>
        </div>
    </div>
  </div> -->
  {!! $donhangs->links() !!}
@endsection