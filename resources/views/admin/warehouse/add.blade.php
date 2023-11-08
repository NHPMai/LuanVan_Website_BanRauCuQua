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
        width: 100%;
    }

    th,
    td {
        padding: 15px;
    }
</style>

@section('content')
<form action="" method="POST">
    <div class="card-body">

        <div class="box">
            <div style=" border:1px solid #999;  border-radius: 5px;">
                <div style="padding: 10px; background-color: #87CEFA; font-weight:700">
                    Thông tin
                </div>
                <div style="padding: 10px;">
                    <form>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-4 col-form-label">Người lập phiếu<span class="text-danger">(*)</span></label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="inputPassword">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-4 col-form-label">Chọn nhà cung cấp<span class="text-danger">(*)</span></label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="inputPassword" placeholder="Password">
                            </div>
                        </div>
                    </form>
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
                            <textarea type="password" class="form-control" id="inputPassword"></textarea>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="mt-4">
            <div style=" border:1px solid #999;">
                <div style="border:1px solid #999; font-weight:700">
                    <div class="row">
                        <div class="col-1">
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Dropdown
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    <a class="dropdown-item" href="#">Dropdown link</a>
                                    <a class="dropdown-item" href="#">Dropdown link</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-11">
                            <form action="{{ url('admin/search')}}" method="GET" class="form-inline" style="margin-bottom:0" >
                                <div class="form-group" >
                                    <input style="width: 1086px;" class="form-control form-control-sidebar" name="query" type="search" placeholder="Search" aria-label="Search">
                                </div>

                                <button type="submit" class="btn btn-light" style=" height: 34px; width: 61px;">
                                    <i class="fas fa-search fa-fw"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div style="padding: 10px;">
                    <table>
                        <tr>
                            <th style="text-align:center">Mã SP</th>
                            <th style="text-align:center">Hình ảnh</th>
                            <th style="text-align:center">Tên sản phẩm</th>
                            <th style="text-align:center">Giá nhập</th>
                            <th style="text-align:center">Số lượng</th>
                            <th style="text-align:center">Xóa</th>
                        </tr>
                        <tr>
                            <td style="text-align:center">Peter</td>
                            <td style="text-align:center">Griffin</td>
                            <td style="text-align:center">$100</td>
                            <td style="text-align:center">
                                <input type="number" id="fname" name="fname" style="width: 150px;">
                            </td>
                            <td style="text-align:center">
                                <input type="number" id="fname" name="fname" style="width: 80px;">
                            </td>
                            <td style="text-align:center">$100</td>
                        </tr>
                        <tr>
                            <td colspan="4" style="text-align: end; color:red; font-weight:700">Tổng tiền: </td>
                            <td style="text-align: center">Tổng số lượng</td>
                            <td></td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>

        <!-- <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="user_id">Nội Dung Phiếu Nhập</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control"  placeholder="Nhập tên nhà cung cấp">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nhân Viên Nhập</label>
                        <select class="form-control" name="user_id">
                           
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="user_id">Số lượng</label>
                        <input type="number" name="soluong" value="{{ old('soluong') }}" class="form-control"  placeholder="Nhập số lượng">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Đơn Vị</label>
                        <input type="text" name="donvi" value="{{ old('donvi') }}" class="form-control"  placeholder="Nhập đơn vị">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Giá Nhập Hàng</label>
                        <input type="number" name="gianhaphang" value="{{ old('gianhaphang') }}" class="form-control"  placeholder="Nhập giá">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="user_id">Ngày sản xuất</label>
                        <input type="date" name="ngaysanxuat" value="{{ old('ngaysanxuat') }}" class="form-control"  placeholder="Nhập ngay san xuat">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Ngày hết hạn</label>
                        <input type="date" name="ngayhethan" value="{{ old('ngayhethan') }}" class="form-control"  placeholder="Nhập ngay het han">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="user_id">Ghi Chú</label>
                <textarea name="note" class="form-control">{{ old('note') }}</textarea>
            </div> -->


    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Thêm Dữ liệu Nhập</button>
    </div>
    @csrf
</form>
@endsection

@section('footer')
<script>
    CKEDITOR.replace('content');
</script>
@endsection