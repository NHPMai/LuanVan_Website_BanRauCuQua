@extends('admin.main')

@section('content')
<!-- <p style="font-weight:bold; font-size: 20px; ">Tổng Số Sản Phẩm: </p> -->
    <table class="table" >
        <thead>
            <tr>
                <th style="width: 30px; text-align: center;vertical-align: middle;">ID</th>
                <th style="text-align: center;vertical-align: middle;">Tên Sản Phẩm</th>
                <th style="text-align: center;vertical-align: middle;">Hình Ảnh</th>
                <th style="text-align: center;vertical-align: middle;">Giá</th>
                <th style="text-align: center;vertical-align: middle;">Danh Mục</th>
                <th style="text-align: center;vertical-align: middle;">Thương Hiệu</th>
                <th style="text-align: center;vertical-align: middle;">Số Lượng</th>
                <th style="text-align: center;vertical-align: middle;">Mô Tả</th>
                <th style="text-align: center;vertical-align: middle;">Trạng Thái</th>
              
                <th style="width: 100px; text-align: center;vertical-align: middle;">Hành Động</th>
            </tr>
        </thead>
        <tbody>
                @foreach($products as $key => $product)
                <tr>
                    <td style="vertical-align: middle;text-align: center;">{{ $product->id }}</td>
                    <td style="vertical-align: middle;text-align: center; font-weight:700; font-size:17px">{{ $product->ten }}</td>
                    <td style="vertical-align: middle;text-align: center;"> <img src="{{ $product->hinhanh }}" height="100" width="100"></td>  
                    <td style="vertical-align: middle;text-align: center; font-weight:600; color:firebrick">{{number_format($product->gia, 0,',','.') }} đ</td>
                    <td style="vertical-align: middle;text-align: center;">{{ $product->menu->name }}</td>
                    <td style="vertical-align: middle;text-align: center;">{{ $product->brand->ten }}</td>
                    <td style="vertical-align: middle;text-align: center;">{{ $product->soluongsp }}</td>
                    <td style="vertical-align: middle;width:300px; text-align:justify">{{ $product->mota }}</td>
                    <td style="vertical-align: middle;text-align: center;">{!! \App\Helpers\Helper::active($product->hoatdong) !!}</td>
                    
                    <td style="vertical-align: middle;text-align: center;">
                        <a class="btn btn-primary btn-sm" href="/admin/products/edit/{{ $product->id }}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="#" class="btn btn-danger btn-sm" 
                            onclick="removeRow( {{ $product->id }} ,'/admin/products/destroy')">
                            <i class="fas fa-trash"></i>
                        </a>
                        
                    </td>
                </tr>
                @endforeach
        </tbody>
    </table>


{!! $products->links() !!}
@endsection
