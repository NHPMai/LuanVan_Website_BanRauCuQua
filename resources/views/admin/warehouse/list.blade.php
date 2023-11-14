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


<div style="  border-radius: 5px;">
    <div style="padding: 10px; font-weight:700">
        <div class="d-flex justify-content-between align-items-center p-2">
            <div style="font-weight:bold; font-size: 20px; ">
                <p>Tổng Số Phiếu Nhập: </p>
            </div>

            <div class="text-end">
                <a href="/admin/warehouses/add" class="btn btn-warning" data-abc="true"> <i class="fas fa-plus"></i>&nbsp;<b> Thêm phiếu mới</b></a>
            </div>
        </div>
    </div>
    <div>
        <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Excel</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">PDF <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <form action="{{ url('admin/search')}}" method="GET" class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav> -->
        <div style="padding: 10px;">
            <!-- <table id="myTable"> -->
            <table>
                <tr style="background-color: lightskyblue;">
                    <th style="text-align:center">ID</th>
                    <th style="text-align:center">Nhân viên lập phiếu</th>
                    <th style="text-align:center">Ngày nhập</th>
                    <th style="text-align:center">Ngày xác nhận</th>
                    <th style="text-align:center">Trạng thái</th>
                    <th style="text-align:center">Hành động</th>
                </tr>
                <tr>
                    <td style="text-align:center">Peter</td>
                    <td style="text-align:center">Griffin</td>
                    <td style="text-align:center">$100</td>
                    <td style="text-align:center">$100</td>
                    <td style="text-align:center">$100</td>
                    <td style="text-align: center;vertical-align: middle;">
                        <a class="btn btn-primary btn-sm" href="/admin/customers/view/}">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a class="btn btn-primary btn-sm" href="/admin/sliders/edit/">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="#" class="btn btn-danger btn-sm" onclick="removeRow(,'/admin/sliders/destroy')">
                            <i class="fas fa-trash"></i>
                        </a>

                    </td>
                </tr>

            </table>
        </div>
    </div>
</div>






@endsection