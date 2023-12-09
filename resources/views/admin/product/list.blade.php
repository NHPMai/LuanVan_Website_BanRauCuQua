@extends('admin.main')


@section('content')
<!-- <p style="font-weight:bold; font-size: 20px; ">Tổng Số Sản Phẩm: </p> -->
<table class="table pt-2" >
    <thead style="background-color:blanchedalmond;">
        <tr>
            <th style="width: 30px; text-align: center;vertical-align: middle; border: 1px solid LightGray;">ID</th>
            <th style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">Tên Sản Phẩm</th>
            <th style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">Hình Ảnh</th>
            <th style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">Giá</th>
            <th style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">Danh Mục</th>
            <th style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">Thương Hiệu</th>
            <th style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">Số Lượng</th>
            <th style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">Mô Tả</th>
            <th style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">Trạng Thái</th>

            <th style="width: 100px; text-align: center;vertical-align: middle; border: 1px solid LightGray;">Hành Động</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $key => $product)
        <tr>
            <td style="vertical-align: middle;text-align: center; border: 1px solid LightGray;">{{ $product->id }}</td>
            <td style="vertical-align: middle;text-align: center; font-weight:700; font-size:17px; border: 1px solid LightGray;">{{ $product->ten }}</td>
            <td style="vertical-align: middle;text-align: center; border: 1px solid LightGray;"> <img src="{{ $product->hinhanh }}" height="100" width="100"></td>
            <td style="vertical-align: middle;text-align: center; font-weight:600; color:firebrick; border: 1px solid LightGray;">{{number_format($product->gia, 0,',','.') }} đ</td>
            <td style="vertical-align: middle;text-align: center; border: 1px solid LightGray;">{{ $product->menu->name }}</td>
            <td style="vertical-align: middle;text-align: center; border: 1px solid LightGray;">{{ $product->brand->ten }}</td>
            <td style="vertical-align: middle;text-align: center; border: 1px solid LightGray;">{{ $product->soluongsp }} kg</td>
            <td style="vertical-align: middle;width:300px; text-align:justify; border: 1px solid LightGray;">{{ $product->mota }}</td>
            <td style="vertical-align: middle;text-align: center; border: 1px solid LightGray;">{!! \App\Helpers\Helper::active($product->hoatdong) !!}</td>

            <td style="vertical-align: middle;text-align: center; border: 1px solid LightGray;">
                <a class="btn btn-primary btn-sm" href="/admin/products/edit/{{ $product->id }}">
                    <i class="fas fa-edit"></i>
                </a>
                <!-- <a href="#" class="btn btn-danger btn-sm" onclick="removeRow( {{ $product->id }} ,'/admin/products/destroy')">
                    <i class="fas fa-trash"></i>
                </a> -->

                @if ( $product->an == 1 )
                <a class="btn btn-success btn-sm" href="/admin/products/unactive/{{$product->id}}" onclick='return confirm("Bạn chắc chắn khóa không?")'>
                    <i class="fas fa-lock-open"></i>
                </a>
                @elseif ( $product->an == 0 )
                <a   href="/admin/products/active/{{$product->id}}" class="btn btn-danger btn-sm" onclick='return confirm("Bạn chắc chắn mở khóa không?")'>
                    <span class="fas fa-lock" style="font-size: 15px;color: white; font-weight: bold"></span>
                </a>
                @endif

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{!! $products->links() !!}

@endsection