@extends('admin.main')


@section('content')
<p style="font-weight:bold; font-size: 20px; ">Tổng Số Phiếu Nhập: {{$warehousings->count()}}</p>
    <table class="table">
        <thead>
            <tr>
                <th style="width: 50px">ID</th>
                <th>Tên Phiếu Nhập</th>
                <th>Nhân Viên Nhập</th>
                <th>Số Lượng</th>
                <th>Đơn Vị</th>
                <th>Giá Nhập Hàng</th>
                <th>Ngày Sản Xuất</th>
                <th>Ngày Hết Hạn</th>
                <th>Ghi Chú</th>
                <th style="width: 50px;">Update</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
                @foreach($warehousings as $key => $warehousing)
                <tr>
                    <td>{{ $warehousing->id }}</td>
                    <td>{{ $warehousing->name }}</td>
                    <td>{{ $warehousing->user->name }}</td>
                    <td>{{ $warehousing->soluong }}</td>
                    <td>{{ $warehousing->donvi }}</td>
                    <td>{{ $warehousing->gianhaphang }}</td>
                    <td>{{ $warehousing->ngaysanxuat }}</td>
                    <td>{{ $warehousing->ngayhethan }}</td>
                    <td>{{ $warehousing->note }}</td>
                    <td>{{ $warehousing->updated_at }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="/admin/warehousings/edit/{{ $warehousing->id }}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="#" class="btn btn-danger btn-sm" 
                            onclick="removeRow( {{ $warehousing->id}},'/admin/warehousings/destroy')">
                            <i class="fas fa-trash"></i>
                        </a>
                        <a class="btn btn-primary btn-sm" href="/admin/warehousings/show/{{ $warehousing->id }}">
                            <i class="fas fa-eye"></i>
                            
                        </a>
                        
                    </td>
                </tr>
                @endforeach
        </tbody>
    </table>


{!! $warehousings->links() !!}
@endsection
