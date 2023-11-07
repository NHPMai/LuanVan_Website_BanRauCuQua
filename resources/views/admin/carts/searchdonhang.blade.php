@extends('admin.main')

@section('content')
<p style="font-weight:bold; font-size: 20px; ">Tổng Số Đơn Hàng: {{$donhangs->count()}}</p>

<table class="table">
    <thead>
        <tr>
            <th style="width: 50px">ID</th>
            <th>Tên Khách Hàng</th>
            <th>Tổng tiền</th>
            <th>Tình trạng</th>
            <th>Phương thức thanh toán</th>
            <th>Nhân viên duyệt đơn</th>
            <th>Ngày đặt</th>
            <th>Trạng thái</th>
            <th >&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        @foreach($donhangs as $key => $donhang)
        <tr>
            <td >{{ $donhang->id }}</td>
            <td>{{ $donhang->khachhangs->hoten}}</td>
            <td>{{ $donhang->dh_thanhtien }}</td>
            
            <!-- <td>
                <div class="col-md-12" style="margin-bottom: 50px;">
                    <form action="" method="post">
                        {{ csrf_field() }}
                            <div class="form-inline">
                                @if( $donhang->dh_trangthai == 1)
                                <select name="active" class="form-control input-inline" style="width: 150px; margin-right: 10px;">
                                    <option value="1">Chờ lấy hàng</option>
                                    <option value="2">Đang giao</option>
                                    <option value="3">Đã giao</option>
                                </select>

                                <input type="submit" value="Xác nhận" class="btn btn-primary">
                                @elseif( $donhang->dh_trangthai == 2 )
                                <label>Trạng thái đơn hàng: </label>
                                <select name="active" class="form-control input-inline" style="width: 150px; margin-right: 10px;">
                                    <option value="2">Đang giao</option>
                                    <option value="3">Đã giao</option>
                                </select>
                                <input type="submit" value="Xác nhận" class="btn btn-primary">
                                @endif
                            </div>
                    </form>
                </div>
            </td> -->
                @if( $donhang->dh_trangthai == 1)
                <td class="column-6">Chờ Lấy Hàng</td>
                @elseif( $donhang->dh_trangthai == 2)
                <td class="column-6">Đang Giao</td>
                @elseif( $donhang->dh_trangthai == 3)
                <td class="column-6">Đã Giao</td>
                @endif
            
            <td>{{ $donhang->dh_ghichu = 'Thanh toán khi đặt hàng' }}</td>
            <td>{{ $donhang->dh_thoigiandathang }}</td>
            <td>{{ $donhang->dh_thoigiandathang }}</td>
           
            
            
            
            <td>
                <a class="btn btn-primary btn-sm" href="/admin/customers/view/{{ $donhang->id }}">
                    <i class="fas fa-eye"></i>
                </a>
            </td>

            
        </tr>
        @endforeach
    </tbody>
</table>

<div class="card-footer clearfix">
  
</div>
@endsection