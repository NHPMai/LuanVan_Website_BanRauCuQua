@extends('admin.main')


@section('content')
<p style="font-weight:bold; font-size: 20px; ">Tổng Số Nhà Cung Cấp: {{$nhacungcaps->count()}}</p>
    <table class="table">
        <thead>
            <tr>
                <th style="width: 50px">ID</th>
                <th>Tên Nhà Cung Cấp</th>
                <th>Email </th>
                <th>Số điện thoại</th>
                <th>Website</th>
                <th>Active</th>
                <th>Update</th>
                <th style="width: 100px">&nbsp</th>
            </tr>
        </thead>
        <tbody>
                @foreach($nhacungcaps as $key => $nhacungcap)
                <tr>
                    <td>{{ $nhacungcap->id }}</td>
                    <td>{{ $nhacungcap->ncc_ten }}</td>
                    <td>{{ $nhacungcap->ncc_email }}</td>
                    <td>{{ $nhacungcap->ncc_sodienthoai }}</td>
                    <td>{{ $nhacungcap->ncc_website }}</td>
                    <td>{!! \App\Helpers\Helper::active($nhacungcap->ncc_trangthai) !!}</td>
                    <td>{{ $nhacungcap->updated_at }}</td>
                    <td>
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


{!! $nhacungcaps->links() !!}
@endsection
