@extends('admin.main')

@section('head')
<script src="/ckeditor/ckeditor.js"></script>
@endsection




<style>
    .box {
        display: grid;
        grid-template-columns: 1fr 1fr;
        /* chia làm 4 cột */
        grid-column-gap: 20px;
        /* khoảng cách giữa các cột */
        grid-row-gap: 20px;
        /* khoảng cách giữa các hàng cột */
    }

    /* size màn hình dưới 700px sẽ về 2 cột */
    @media (max-width: 700px) {
        .box {
            grid-template-columns: 1fr 1fr;
        }

        /* thành 2 cột */
    }

    /* size màn hình dưới 300px sẽ về 1 cột */
    @media (max-width: 300px) {
        .box {
            grid-template-columns: 1fr;
        }

        /* thành 1 cột */
    }

    table,
    td,
    th {
        border: 1px solid #ddd;
        text-align: left;
    }

    table {
        border-collapse: collapse;
    }

    th,
    td {
        padding: 15px;
    }
</style>

@section('content')

<div class="card-body">
    <div class="box">
        <div style=" border:1px solid #999;  border-radius: 5px;">
            <div style="padding: 10px; background-color: #87CEFA; font-weight:700">
                Thông tin
            </div>
            <div style="padding: 10px;">
                <div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-4 col-form-label">Người lập phiếu<span class="text-danger">(*)</span></label>
                        <div class="col-sm-8">
                            <a>{{ $phieunhap->nhanviens->hoten}}</a>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-4 col-form-label">Chọn nhà cung cấp<span class="text-danger">(*)</span></label>
                        <div class="col-sm-8">
                            <strong>{{ $phieunhap->nhacungcaps->ncc_ten}}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div style=" border:1px solid #999;  border-radius: 5px;">
            <div style="padding: 10px; background-color: #87CEFA; font-weight:700">
                Thông tin
            </div>
            <div style="padding: 10px;">
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-4 col-form-label">Ghi chú</label>
                    <div class="col-sm-8">
                        <textarea name="ctpn_ghichu" value="{{ $phieunhap->ghichu}}" type="text" class="form-control" id="inputPassword"></textarea>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="mt-4">
        <div style=" border:1px solid #999;">
            @php $tongsoluong = 0; @endphp
            <div style="padding: 10px;">
                <div class="card">
                    <table class="table table-bordered" id="product-table" style=" margin-bottom: 0px;">
                        <thead style="text-align: center;">
                            <tr role="row" style="background-color:#87CEFA">
                                <th>Mã sản phẩm</th>
                                <th>Hình ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá nhập</th>
                                <th>Số lượng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($chitietphieunhap as $key => $ctpn)
                            @php
                            $a = $ctpn->ctpn_soluong;
                            $tongsoluong += $a ;
                          
                            @endphp
                            <tr>
                                <td class="column-2" style="text-align: center;vertical-align: middle">#{{ $ctpn->products->id }}</td>
                                <td class="column-1" style="text-align: center;vertical-align: middle">
                                    <div class="how-itemcart1">
                                        <img src="{{ $ctpn->products->hinhanh}}" alt="IMG" style="width: 100px">
                                    </div>
                                </td>
                                <td class="column-2" style="text-align: center;vertical-align: middle; font-weight:600">{{ $ctpn->products->ten }}</td>
                                <td class="column-2" style="text-align: center;vertical-align: middle; font-weight:600; color:brown">{{ $ctpn->ctpn_gianhap }}</td>
                                <td class="column-2" style="text-align: center;vertical-align: middle">{{ $ctpn->ctpn_soluong }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr style="font-weight: 600;">
                                <td colspan="4" style="text-align: right;">Tổng tiền: {{ number_format($phieunhap->pn_tongtiennhap, 0, '', '.') }}</td> 
                                <td style="text-align: right;"> Tổng số lượng: {{$tongsoluong}}</td>
                            </tr>
                        </tfoot>
                    </table>
                   
                </div>

            </div>
        </div>
    </div>
</div>


@csrf

@endsection

@section('footer')
<script>
    CKEDITOR.replace('content');
</script>
@endsection