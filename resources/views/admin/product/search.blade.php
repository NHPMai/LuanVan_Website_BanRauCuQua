@extends ('admin.main')

@section('content')

<style>
    th,
    td {
        border: 1px solid LightGray;
    }
</style>

<table class="table" >
        <thead style="background-color:blanchedalmond;">
        <tr>
                <th style="width: 50px">ID</th>
                <th style="vertical-align: middle;text-align: center;">Tên Sản Phẩm</th>
                <th style="vertical-align: middle;text-align: center;">Hình Ảnh</th>
                <th style="vertical-align: middle;text-align: center;">Giá</th>
                <th style="vertical-align: middle;text-align: center;">Danh Mục</th>
                <th style="vertical-align: middle;text-align: center;">Thương Hiệu</th>
                <th style="vertical-align: middle;text-align: center;">Số Lượng Sản Phẩm</th>
                <th style="vertical-align: middle;text-align: center;">Mô Tả</th>
                <th style="vertical-align: middle;text-align: center;">Trạng Thái</th>
                <th style="vertical-align: middle;text-align: center;">Hành Dộng</th>
                <th style="width: 100px">&nbsp</th>
            </tr>
        </thead>
        <tbody>
        @foreach($products as $key => $product)
                <tr>
                    <td style="vertical-align: middle;text-align: center;">{{ $product->id }}</td>
                    <td style="vertical-align: middle;text-align: center;">{{ $product->ten }}</td>
                    <td style="vertical-align: middle;text-align: center;"> <img src="{{ $product->hinhanh }}" height="100" width="100"></td>  
                    <td style="vertical-align: middle;text-align: center;">{{ $product->gia }}</td>
                    <td style="vertical-align: middle;text-align: center;">{{ $product->menu->name }}</td>
                    <td style="vertical-align: middle;text-align: center;">{{ $product->brand->ten }}</td>
                    <td style="vertical-align: middle;text-align: center;">{{ $product->soluongsp }}</td>
                    <td style="vertical-align: middle;">{{ $product->mota }}</td>
                    <td style="vertical-align: middle;text-align: center;">{!! \App\Helpers\Helper::active($product->hoatdong) !!}</td>
                    <td style="vertical-align: middle;text-align: center;">{{ $product->updated_at }}</td>
                    <td style="vertical-align: middle;text-align: center;">
                        <a class="btn btn-primary btn-sm" href="/admin/products/edit/{{ $product->id }}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="#" class="btn btn-danger btn-sm" 
                            onclick="removeRow( {{$product->id}},'/admin/products/destroy')">
                            <i class="fas fa-trash"></i>
                        </a>
                        
                    </td>
                </tr>
                @endforeach
        </tbody>

@endsection