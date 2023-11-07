@extends ('admin.main')

@section('content')

<table class="table">
        <thead>
        <tr>
                <th style="width: 50px">ID</th>
                <th>Tên Sản Phẩm</th>
                <th>Hình Ảnh</th>
                <th>Giá</th>
                <th>Danh Mục</th>
                <th>Thương Hiệu</th>
                <th>Số Lượng Sản Phẩm</th>
                <th>Mô Tả</th>
                <th>Trạng Thái</th>
                <th>Hành Dộng</th>
                <th style="width: 100px">&nbsp</th>
            </tr>
        </thead>
        <tbody>
        @foreach($products as $key => $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->ten }}</td>
                    <td> <img src="{{ $product->hinhanh }}" height="100" width="100"></td>  
                    <td>{{ $product->gia }}</td>
                    <td>{{ $product->menu->name }}</td>
                    <td>{{ $product->brand->ten }}</td>
                    <td>{{ $product->soluongsp }}</td>
                    <td>{{ $product->mota }}</td>
                    <td>{!! \App\Helpers\Helper::active($product->hoatdong) !!}</td>
                    <td>{{ $product->updated_at }}</td>
                    <td>
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

@endsection