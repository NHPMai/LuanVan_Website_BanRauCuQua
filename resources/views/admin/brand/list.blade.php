@extends('admin.main')

@section('content')
<!-- <p style="font-weight:bold; font-size: 20px; ">Tổng Số Sản Phẩm: </p> -->
    <table class="table">
        <thead>
            <tr>
                <th style="vertical-align: middle;text-align: center;">ID</th>
                <th style="vertical-align: middle;text-align: center;">Tên Thương Hiệu</th>
                <th style="vertical-align: middle;text-align: center;">Mô Tả</th>
                <th style="vertical-align: middle;text-align: center;">Trạng Thái</th>
                <th style="vertical-align: middle;text-align: center;">Cập Nhật</th>
                <th style=" vertical-align: middle;text-align: center;">Hành Động</th>
            </tr>
        </thead>
        <tbody>
                @foreach($brands as $key => $brand)
                <tr>
                    <td style="vertical-align: middle;text-align: center;">{{ $brand->id }}</td>
                    <td style="vertical-align: middle;text-align: center; font-weight:600; font-size:16px">{{ $brand->ten }}</td>
                    <td style="vertical-align: middle;text-align:justify; width:500px">{{ $brand->mota }}</td>
                    <td style="vertical-align: middle;text-align: center;">{!! \App\Helpers\Helper::active($brand->hoatdong) !!}</td>
                    <td style="vertical-align: middle;text-align: center;">{{ $brand->updated_at }}</td>
                    <td style="vertical-align: middle;text-align: center;">
                        <a class="btn btn-primary btn-sm" href="/admin/brands/edit/{{ $brand->id }}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="#" class="btn btn-danger btn-sm" 
                            onclick="removeRow( {{ $brand->id }} ,'/admin/brands/destroy')">
                            <i class="fas fa-trash"></i>
                        </a>
                        
                    </td>
                </tr>
                @endforeach
        </tbody>
    </table>


{!! $brands->links() !!}
@endsection
