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
                <a href="/admin/staffs/add" class="btn btn-warning" data-abc="true"> <i class="fa fa-remove"></i></i> + Thêm mới</a>
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
            <table id="product-table">
                <thead>
                    <tr style="background-color: lightskyblue;">
                        <th style="text-align:center">ID</th>
                        <th style="text-align:center">Họ và tên</th>
                        <th style="text-align:center">Avatar</th>
                        <th style="text-align:center">Giới tính</th>
                        <th style="text-align:center">Số điện thoại</th>
                        <th style="text-align:center">Địa chỉ</th>
                        <th style="text-align:center">Email</th>
                        <th style="text-align:center">Trạng thái</th>
                        <th style="text-align:center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($nhanviens as $key => $nhanvien)
                    <tr>

                        <td style="text-align:center">{{$nhanvien->id}}</td>
                        <td style="text-align:center">{{$nhanvien->hoten}}</td>
                        <td style="text-align:center"><img src="{{ $nhanvien->avata }}" style="border-radius: 50%; border: 2px solid #a1a1a1;" height="100" width="100"></td>
                            @if( $nhanvien->gioitinh == 1)
                            <td style="text-align:center">Nam</td>
                            @elseif ($nhanvien->gioitinh ==2)
                            <td style="text-align:center">Nữ</td>
                            @endif
                        <td style="text-align:center">{{$nhanvien->sodienthoai}}</td>
                        <td style="text-align:center">{{$nhanvien->diachi}}</td>
                        <td style="text-align:center">{{$nhanvien->email}}</td>
                            @if( $nhanvien->hoatdong == 0)
                            <td style="text-align:center"><button type="button" class="btn btn-danger">Khóa</button></td>
                            @elseif ($nhanvien->hoatdong == 1)
                            <td style="text-align:center"><button type="button" class="btn btn-success">Hoạt động</button></td>
                            @endif
                        <td style="text-align: center;vertical-align: middle;">
                            <a class="btn btn-primary btn-sm" href="/admin/staffs/edit/{{ $nhanvien->id }}">
                                <i class="fas fa-edit"></i>
                            </a>

                            <a href="#" class="btn btn-danger btn-sm" onclick="removeRow({{$nhanvien->id}},'/admin/staffs/destroy')">
                                <i class="fas fa-trash"></i>
                            </a>

                        </td>

                    </tr>
                    @endforeach
                </tbody>


            </table>
        </div>
    </div>
</div>

{!! $nhanviens->links() !!}
@endsection