@extends('admin.main')

<style>
    th,
    td {
        border: 1px solid LightGray;
    }
</style>

@section('content')
<p style="font-weight:bold; font-size: 20px; ">Tổng Số Nhà Cung Cấp: {{$nhacungcaps->count()}}</p>
    <table class="table" id="myTable" >
        <thead style="background-color:blanchedalmond;">
            <tr>
                <th style="width: 50px; text-align: center;">ID</th>
                <th style="text-align: center;">Tên Nhà Cung Cấp</th>
                <th style="text-align: center;">Email </th>
                <th style="text-align: center;">Số điện thoại</th>
                <th style="text-align: center;">Website</th>
                <th style="text-align: center;">Trạng thái</th>
                <th style="text-align: center;">Ngày cập nhật</th>
                <th style="width: 100px; text-align: center;">Hoạt động</th>
            </tr>
        </thead>
        <tbody>
                @foreach($nhacungcaps as $key => $nhacungcap)
                <tr>
                    <td style="text-align: center;">{{ $nhacungcap->id }}</td>
                    <td style="text-align: center;">{{ $nhacungcap->ncc_ten }}</td>
                    <td style="text-align: center;">{{ $nhacungcap->ncc_email }}</td>
                    <td style="text-align: center;">{{ $nhacungcap->ncc_sodienthoai }}</td>
                    <td style="text-align: center;">{{ $nhacungcap->ncc_website }}</td>
                    <td style="text-align: center;">{!! \App\Helpers\Helper::active($nhacungcap->ncc_trangthai) !!}</td>
                    <td style="text-align: center;">{{ $nhacungcap->updated_at }}</td>
                    <td style="text-align: center;">
                        <a class="btn btn-primary btn-sm" href="/admin/suppliers/edit/{{ $nhacungcap->id }}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="#" class="btn btn-danger btn-sm" 
                            onclick="removeRow( {{ $nhacungcap->id }} ,'/admin/suppliers/destroy')">
                            <i class="fas fa-trash"></i>
                        </a>
                        
                    </td>
                </tr>
                @endforeach
        </tbody>
    </table>


@endsection
