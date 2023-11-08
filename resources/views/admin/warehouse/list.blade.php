@extends('admin.main')


@section('content')

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

<p style="font-weight:bold; font-size: 20px; ">Tổng Số Phiếu Nhập: </p>
    

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


@endsection
