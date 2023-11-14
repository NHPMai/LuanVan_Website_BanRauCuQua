@extends('admin.main')

@section('content')
<p style="font-weight:bold; font-size: 20px; ">Tổng Số Đơn Hàng: {{$donhangs->count()}}</p>

<table class="table pt-2" id="myTable">
    <thead style="background-color:blanchedalmond;">
        <tr>
            <th style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">ID</th>
            <th style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">Tên Khách Hàng</th>
            <th style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">Tổng tiền</th>
            <th style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">Tình Trạng</th>
            <th style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">Phương Thức Thanh Toán</th>
            <th style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">Nhân Viên Duyệt Đơn</th>
            <th style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">Ngày Đặt</th>
            <th style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">Trạng Thái</th>
            <th style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">Hành Động</th>
        </tr>
    </thead>
    <tbody>
        @foreach($donhangs as $key => $donhang)
        <tr>
            <td style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">{{ $donhang->id }}</td>
            <td style="vertical-align: middle; border: 1px solid LightGray;">{{ $donhang->khachhangs->hoten}}</td>
            <td style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">{{ $donhang->dh_thanhtien }}</td>
            
            <!-- <td>
                <div class="col-md-12" style="margin-bottom: 50px;">
                    <form action="" method="POST">
                        {{ csrf_field() }}
                            <div class="form-inline">
                                @if( $donhang->dh_trangthai == 1)
                                <select name="dh_trangthai" class="form-control input-inline" style="width: 150px; margin-right: 10px;">
                                    <option value="1">Chờ lấy hàng</option>
                                    <option value="2">Đang giao</option>
                                    <option value="3">Đã giao</option>
                                </select>

                                <input type="submit" value="Xác nhận" class="btn btn-primary">
                                @elseif( $donhang->dh_trangthai == 2 )
                                <label>Trạng thái đơn hàng: </label>
                                <select name="dh_trangthai" class="form-control input-inline" style="width: 150px; margin-right: 10px;">
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
                <td class="column-6" style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">
                    <button style="background-color: #b0b5ae; border-radius: 8px; ">Chờ duyệt &nbsp <i class="glyphicon glyphicon-time"></i></button>
                </td>
                @elseif( $donhang->dh_trangthai == 2)
                <td class="column-6" style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">
                    <button style="background-color: #10dee6; border-radius: 8px;">Đã Duyệt &nbsp <i class="fas fa-check"></i></button>
                </td>
                @elseif( $donhang->dh_trangthai == 3)
                <td class="column-6" style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">
                    <button style="background-color: #ede609; border-radius: 8px;">Đang giao &nbsp <i class="fas fa-check"></i></button>
                </td>
                @elseif( $donhang->dh_trangthai == 4)
                <td class="column-6" style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">
                    <button style="background-color: #68db2a; border-radius: 8px;">Giao hàng thành công &nbsp <i class="fas fa-check"></i></button>
                </td>
                @endif
            
            <td style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">{{ $donhang->dh_ghichu = 'Thanh toán khi đặt hàng' }}</td>
            <th style="text-align: center;vertical-align: middle; border: 1px solid LightGray;"></th>
            <td style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">{{ $donhang->dh_thoigiandathang }}</td>
            <td style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">{{ $donhang->dh_thoigiandathang }}</td>
           
            
            
            
            <td style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">
                <a class="btn btn-primary btn-sm" href="/admin/customers/view/{{ $donhang->id }}">
                    <i class="fas fa-eye"></i>
                </a>
            </td>

            
        </tr>
        @endforeach
    </tbody>
</table>


@endsection