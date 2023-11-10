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
                <p>Tổng Số Nhân Viên: </p>
            </div>

            <div class="text-end">
                <a href="/admin/staffs/add" class="btn btn-warning"> <i class="fa fa-remove"></i></i> + Thêm mới</a>
            </div>
        </div>
    </div>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
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
        </nav>
        <div style="padding: 10px;">
            <div class="pb-3">
                <form class="form-inline pb-2">
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-5 col-form-label text-end">Email</label>
                        <div class="col-sm-7">
                            <input type="email" value="{{$nhanvien->email}}" class="form-control" id="inputPassword" placeholder="Email" disabled>
                        </div>
                    </div>
                    <div class="form-group row" style="margin-left: 60px">
                        <label for="inputPassword" class="col-sm-5 col-form-label">Họ và tên</label>
                        <div class="col-sm-7">
                            <input type="text" value="{{$nhanvien->hoten}}" class="form-control" id="inputPassword" placeholder="Họ và tên" disabled>
                        </div>
                    </div>
                </form>


                <!-- <div class="form-group">
                    <label for="menu">Họ và tên <span class="text-danger">(*)</span></label>
                    <input type="text" name="hoten" value="{{ old('hoten') }}" class="form-control" placeholder="Nhập họ và tên" disabled>
                </div> -->
            </div>
            <table id="product-table">
                <thead>
                    <tr style="background-color: lightskyblue;">
                        <th style="text-align:center">Quyền bài viết</th>
                        <th style="text-align:center">Quyền đơn hàng</td>
                        <th style="text-align:center">Quyền kho hàng</th>
                        <th style="text-align:center">Quyền nhân sự </th>
                        <th style="text-align:center">Quyền sản phẩm </th>

                    </tr>

                </thead>
                <tbody>
                    <tr>
                        <td>
                            @php $donhangquyen = $nhanvien->chitietquyen->where('quyen_id',1)->first(); @endphp

                            @if ($donhangquyen)
                                @if($donhangquyen->coquyen == 1)
                                    <a href="/admin/staffs/auth/{{$donhangquyen->id}}" onclick="return confirm('is_active?')">
                                        <span class="fa fa-check"></span>
                                    </a>
                                @else
                                    <a href="/admin/staffs/unauth/{{$donhangquyen->id}}" onclick="return confirm('is_active?')">
                                        <span class="far fa-times-circle"></span>
                                    </a>
                                @endif
                            @else
                             Không xác định
                            @endif
                        </td>

                    </tr>
                </tbody>


            </table>
        </div>


    </div>
</div>


@endsection