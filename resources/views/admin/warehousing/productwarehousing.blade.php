@extends('admin.main')

@section('content')
<div class="warehousing mt-3">
    <ul>
        <li>Người Nhập: <strong>{{ $warehousing->id }}</strong></li>
        <li>Nội dung nhập hàng: <strong>{{ $warehousing->name }}</strong></li>
        <li>Ghi Chú: <strong>{{ $warehousing->note }}</strong></li>
        <li>Ngày tạo: <strong>{{ $warehousing->created_at }}</strong></li>
    </ul>
</div>

<div class="productwarehousings">
    @php $total = 0; @endphp
      <table class="table">
        <tbody>
            <tr class="table_head">
                
               
                <th class="column-1">Tên Sản Phẩm</th>
                <th class="column-2">Nhà Cung Cấp</th>
                <th class="column-3">Số Lượng</th>
                <th class="column-4">Đơn Giá</th>
                <th class="column-5">Đơn Vị</th>
                <th class="column-6">Ngày Sản Xuất</th>
                <th class="column-7">Ngày Hết Hạn</th>
                <th class="column-8">Tổng Tiền</th>
            </tr>

            @foreach($productwarehousings as $key => $productwarehousing)
            @php
            $total = $productwarehousing->gianhaphang * $productwarehousing->soluong;
            
            @endphp
            <tr>
              
                <td class="column-1">{{ $productwarehousing->product->name }}</td>
                <td class="column-2">{{ $productwarehousing->supplier->name }}</td>
                <td class="column-3">{{ $productwarehousing->warehousing->soluong }}</td>
                <td class="column-4">{{ $productwarehousing->warehousing->gianhaphang }}</td>
                <td class="column-5">{{ $productwarehousing->warehousing->donvi }}</td>
                <td class="column-6">{{ $productwarehousing->warehousing->ngaysanxuat }}</td>
                <td class="column-7">{{ $productwarehousing->warehousing->ngayhethan }}</td>
                <td class="column-8">{{ number_format($total, 0, '', '.') }}</td>
            </tr>
            @endforeach
            

        </tbody>
    </table>
    
</div>
@endsection

