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

            </div>
            <table id="product-table">
                <thead>
                    <tr style="background-color: lightskyblue;">
                        <th style="text-align:center">Quyền đơn hàng</th>
                        <th style="text-align:center">Quyền sản phẩm</td>
                        <th style="text-align:center">Quyền nhân sự</th>
                        <th style="text-align:center">Quyền bài viết </th>
                        <th style="text-align:center">Quyền kho hàng </th>

                    </tr>

                </thead>
                <tbody>
                    <tr>
                        <td style="text-align:center">
                           
                            
                                @if($nhanvien1->coquyen == 1)
                                    <a href="/admin/staffs/coquyen/{{$nhanvien1->id}}" onclick="return confirm('Bạn muốn thay đổi quyền?')">
                                        <span class="fa fa-check"></span>
                                    </a>
                                @else
                                    <a href="/admin/staffs/khongquyen/{{$nhanvien1->id}}" onclick="return confirm('Bạn muốn thay đổi quyền?')" style="color:red">
                                        <span class="far fa-times-circle"></span>
                                    </a>
                                @endif
                            
                            
                           
                        </td>

                        <td style="text-align:center">
                           
                                @if($nhanvien2->coquyen == 1)
                                    <a href="/admin/staffs/coquyen/{{$nhanvien2->id}}" onclick="return confirm('Bạn muốn thay đổi quyền?')">
                                        <span class="fa fa-check"></span>
                                    </a>
                                @else
                                    <a href="/admin/staffs/khongquyen/{{$nhanvien2->id}}" onclick="return confirm('Bạn muốn thay đổi quyền?')" style="color:red">
                                        <span class="far fa-times-circle"></span>
                                    </a>
                                @endif
                           
                        </td>

                        <td style="text-align:center">
                          
                                @if($nhanvien3->coquyen == 1)
                                    <a href="/admin/staffs/coquyen/{{$nhanvien3->id}}" onclick="return confirm('Bạn muốn thay đổi quyền?')">
                                        <span class="fa fa-check"></span>
                                    </a>
                                @else
                                    <a href="/admin/staffs/khongquyen/{{$nhanvien3->id}}" onclick="return confirm('Bạn muốn thay đổi quyền?')" style="color:red">
                                        <span class="far fa-times-circle"></span>
                                    </a>
                                @endif
                           
                        </td>

                        <td style="text-align:center">
                            
                                @if($nhanvien4->coquyen == 1)
                                    <a href="/admin/staffs/coquyen/{{$nhanvien4->id}}" onclick="return confirm('Bạn muốn thay đổi quyền?')">
                                        <span class="fa fa-check"></span>
                                    </a>
                                @else
                                    <a href="/admin/staffs/khongquyen/{{$nhanvien4->id}}" onclick="return confirm('Bạn muốn thay đổi quyền?')" style="color:red">
                                        <span class="far fa-times-circle"></span>
                                    </a>
                                @endif
                          
                        </td>

                        <td style="text-align:center">
                           
                                @if($nhanvien5->coquyen == 1)
                                    <a href="/admin/staffs/coquyen/{{$nhanvien5->id}}" onclick="return confirm('Bạn muốn thay đổi quyền?')">
                                        <span class="fa fa-check"></span>
                                    </a>
                                @else
                                    <a href="/admin/staffs/khongquyen/{{$nhanvien5->id}}" onclick="return confirm('Bạn muốn thay đổi quyền?')" style="color:red">
                                        <span class="far fa-times-circle"></span>
                                    </a>
                                @endif
                           
                        </td>
                    </tr>
                </tbody>


            </table>
        </div>


    </div>
</div>


@endsection