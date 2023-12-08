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
    <div style="font-weight:700">
        <div class="d-flex justify-content-between align-items-center p-2">
            <div style="font-weight:bold; font-size: 20px; ">
                <p>Tổng Số Khách Hàng: {{$khachhangs->count()}}</p>
            </div>

            <div class="text-end">
                <a href="/admin/clients/add" class="btn btn-warning" data-abc="true"> <i class="fas fa-plus"></i></i>&nbsp;<b>Thêm mới</b></a>
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
            <table id="myTable">
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
                    @foreach($khachhangs as $key => $khachhang)
                    <tr>

                        <td style="text-align:center">{{$khachhang->id}}</td>
                        <td style="text-align:center">{{$khachhang->hoten}}</td>
                        @if ($khachhang->avata == '')
                        <td style="text-align:center"><img src="/template/images/khachhang/no-avatar.png" style="border-radius: 50%; border: 2px solid #a1a1a1;" height="100" width="100"></td>
                        @else
                        <td style="text-align:center"><img src="{{$khachhang->avata}}" style="border-radius: 50%; border: 2px solid #a1a1a1;" height="100" width="100"></td>
                        @endif

                        @if( $khachhang->gioitinh == '1')
                        <td style="text-align:center">Nam</td>
                        @elseif ($khachhang->gioitinh == '2')
                        <td style="text-align:center">Nữ</td>
                        @endif
                        <td style="text-align:center">{{$khachhang->sodienthoai}}</td>
                        <td style="text-align:center">{{$khachhang->diachi}}</td>
                        <td style="text-align:center">{{$khachhang->email}}</td>


                        @if ( $khachhang->hoatdong == 1 )
                        <td style="text-align:center">
                            <a class="btn btn-success btn-sm" href="/admin/clients/unactive/{{$khachhang->id}}" onclick='return confirm("Bạn chắc chắn khóa không?")'>
                                <i class="fas fa-lock-open"></i>
                            </a>
                        </td>
                        @elseif ( $khachhang->hoatdong == 0 )
                        <td style="text-align:center">
                            <a href="/admin/clients/active/{{$khachhang->id}}" class="btn btn-danger btn-sm" onclick='return confirm("Bạn chắc chắn mở khóa không?")'>
                                <span class="fas fa-lock" style="font-size: 15px;color: white; font-weight: bold"></span>
                            </a>
                        </td>
                        @endif


                        <td style="text-align: center;vertical-align: middle;">
                            <a class="btn btn-warning btn-sm" href="/admin/clients/view/{{ $khachhang->id  }}">
                                <i class="fas fa-eye"></i>
                            </a>
                            
                            <a class="btn btn-primary btn-sm" href="/admin/clients/edit/{{ $khachhang->id }}">
                                <i class="fas fa-edit"></i>
                            </a>

                            <!-- <a href="#" class="btn btn-danger btn-sm" onclick="removeRow({{$khachhang->id}},'/admin/clients/destroy')">
                                <i class="fas fa-trash"></i>
                            </a> -->
                            <!-- <br><br> -->




                        </td>

                    </tr>
                    @endforeach
                </tbody>


            </table>
        </div>
    </div>
</div>


@endsection