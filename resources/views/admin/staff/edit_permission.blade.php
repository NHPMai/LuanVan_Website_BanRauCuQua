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
                            <input type="email" class="form-control" id="inputPassword" placeholder="Email">
                        </div>
                    </div>
                </form>

                <form class="form-inline">
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-5 col-form-label">Họ và tên</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="inputPassword" placeholder="Họ và tên">
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
                    @foreach($quyens as $key => $quyen)
                    <tr style="background-color: lightskyblue;">
                        <!-- <th style="text-align:center">Email</th>
                        <th style="text-align:center" value="{{$quyen->id ==1}}">Quyền Sản Phẩm</th>
                        <th style="text-align:center">Quyền Nhập Kho</th>
                        <th style="text-align:center">Quyền Sản Phẩm</th>
                        <th style="text-align:center">Quyền Nhân Sự</th>
                        <th style="text-align:center">Thay Đổi Quyền</th> -->
                        @if( $quyen->id == 1)
                        <td style="text-align:center">Quyền Đơn hàng</td>
                        @elseif ($quyen->id == 2)
                        <td style="text-align:center">Quyền Sản Phẩm</td>
                        @elseif ($quyen->id == 3)
                        <td style="text-align:center">Quyền Nhân Sự</td>
                        @elseif ($quyen->id == 4)
                        <td style="text-align:center">Quyền Bài Viết</td>
                        @elseif ($quyen->id == 5)
                        <td style="text-align:center">Quyền Kho Hàng</td>
                        @endif
                    </tr>
                    @endforeach
                </thead>
                <tbody>
                    @foreach($nhanviens as $key => $nhanvien)
                    <tr>

                        <td style="text-align:center">{{$nhanvien->email}}</td>
                        <td style="text-align:center"></td>
                        <td style="text-align:center"></td>
                        <td style="text-align:center"></td>
                        <td style="text-align:center"></td>
                        <td style="text-align: center;vertical-align: middle;">
                            <a class="btn btn-primary btn-sm" href="/admin/staffs/edit/{{ $nhanvien->id }}">
                                <i class="fas fa-edit"></i>
                            </a>

                        </td>

                    </tr>
                    @endforeach
                </tbody>


            </table>
        </div>


    </div>
</div>

{!! $quyens->links() !!}
@endsection