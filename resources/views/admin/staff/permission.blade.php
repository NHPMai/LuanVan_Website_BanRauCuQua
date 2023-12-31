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
                <a href="/admin/staffs/add" class="btn btn-warning"> <i class="	fas fa-plus"></i><b>&nbsp;Thêm nhân viên</b></a>
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
                        <th style="text-align:center">Email</th>
                        <th style="text-align:center">Quyền đơn hàng</th>
                        <th style="text-align:center">Quyền sản phẩm</td>
                        <th style="text-align:center">Quyền nhân sự</th>
                        <th style="text-align:center">Quyền bài viết </th>
                        <th style="text-align:center">Quyền kho hàng </th>
                        <th style="text-align:center">Thay Đổi Quyền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($nhanvien as $key => $nv)
                    <tr>

                        <td style="text-align:center">{{$nv->email}}</td>


                        <td style="text-align:center">

                            @foreach($chitietquyen as $key => $ctq)
                            @if($ctq->coquyen == 1 && $ctq->nhanvien_id == $nv->id && $ctq->quyen_id == 1)
                            <a href="/admin/staffs/coquyen/" onclick="return confirm('Bạn muốn thay đổi quyền?')">
                                <span class="fa fa-check"></span>
                            </a>
                            @elseif ($ctq->coquyen == 0 && $ctq->nhanvien_id == $nv->id && $ctq->quyen_id == 1)
                            <a href="/admin/staffs/khongquyen/" onclick="return confirm('Bạn muốn thay đổi quyền?')" style="color:red">
                                <span class="far fa-times-circle"></span>
                            </a>
                            @endif
                            @endforeach



                        </td>

                        <td style="text-align:center">

                            @foreach($chitietquyen as $key => $ctq)
                            @if($ctq->coquyen == 1 && $ctq->nhanvien_id == $nv->id && $ctq->quyen_id == 2)
                            <a href="/admin/staffs/coquyen/" onclick="return confirm('Bạn muốn thay đổi quyền?')">
                                <span class="fa fa-check"></span>
                            </a>
                            @elseif ($ctq->coquyen == 0 && $ctq->nhanvien_id == $nv->id && $ctq->quyen_id == 2)
                            <a href="/admin/staffs/khongquyen/" onclick="return confirm('Bạn muốn thay đổi quyền?')" style="color:red">
                                <span class="far fa-times-circle"></span>
                            </a>
                            @endif
                            @endforeach

                        </td>

                        <td style="text-align:center">

                            @foreach($chitietquyen as $key => $ctq)
                            @if($ctq->coquyen == 1 && $ctq->nhanvien_id == $nv->id && $ctq->quyen_id == 3)
                            <a href="/admin/staffs/coquyen/" onclick="return confirm('Bạn muốn thay đổi quyền?')">
                                <span class="fa fa-check"></span>
                            </a>
                            @elseif ($ctq->coquyen == 0 && $ctq->nhanvien_id == $nv->id && $ctq->quyen_id == 3)
                            <a href="/admin/staffs/khongquyen/" onclick="return confirm('Bạn muốn thay đổi quyền?')" style="color:red">
                                <span class="far fa-times-circle"></span>
                            </a>
                            @endif
                            @endforeach

                        </td>

                        <td style="text-align:center">

                            @foreach($chitietquyen as $key => $ctq)
                            @if($ctq->coquyen == 1 && $ctq->nhanvien_id == $nv->id && $ctq->quyen_id == 4)
                            <a href="/admin/staffs/coquyen/" onclick="return confirm('Bạn muốn thay đổi quyền?')">
                                <span class="fa fa-check"></span>
                            </a>
                            @elseif ($ctq->coquyen == 0 && $ctq->nhanvien_id == $nv->id && $ctq->quyen_id == 4)
                            <a href="/admin/staffs/khongquyen/" onclick="return confirm('Bạn muốn thay đổi quyền?')" style="color:red">
                                <span class="far fa-times-circle"></span>
                            </a>
                            @endif
                            @endforeach

                        </td>

                        <td style="text-align:center">

                            @foreach($chitietquyen as $key => $ctq)
                            @if($ctq->coquyen == 1 && $ctq->nhanvien_id == $nv->id && $ctq->quyen_id == 5)
                            <a href="/admin/staffs/coquyen/" onclick="return confirm('Bạn muốn thay đổi quyền?')">
                                <span class="fa fa-check"></span>
                            </a>
                            @elseif ($ctq->coquyen == 0 && $ctq->nhanvien_id == $nv->id && $ctq->quyen_id == 5)
                            <a href="/admin/staffs/khongquyen/" onclick="return confirm('Bạn muốn thay đổi quyền?')" style="color:red">
                                <span class="far fa-times-circle"></span>
                            </a>
                            @endif
                            @endforeach

                        </td>



                        @if ($nv->id == 9)
                            <!-- <td> <button  style="color: red;">Quản lí cấp cao</button></td> -->
                            <td style="text-align:center" ><button style="background-color: red; border-radius: 8px; color:white; font-weight:600; ">Quản lí cấp cao</button></td>
                        @else
                        <td style="text-align: center;vertical-align: middle;">
                            <a class="btn btn-primary btn-sm" href="/admin/staffs/edit_permission/{{$nv->id}}">
                                <i class="fas fa-edit"></i>
                            </a>

                        </td>
                        
                        @endif

                    </tr>
                    @endforeach
                </tbody>


            </table>
        </div>


    </div>
</div>

@endsection