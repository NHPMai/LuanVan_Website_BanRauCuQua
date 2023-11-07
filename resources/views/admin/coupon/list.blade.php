@extends('admin.main')

@section('content')

<style>
    body {
        font-family: "Helvetica Neue", Helvetica, Arial;
        font-size: 14px;
        line-height: 20px;
        font-weight: 400;
        /* color: #3b3b3b; */
        -webkit-font-smoothing: antialiased;
        font-smoothing: antialiased;
    }

    @media screen and (max-width: 580px) {
        body {
            font-size: 16px;
            line-height: 22px;
        }
    }

    /* .wrapper {
        margin: 0 auto;
        padding: 40px;
        max-width: 1300px;
    } */

    .table {
        margin: 0 0 20px 0;
        width: 100%;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
        display: table;
        /* border-collapse:collapse;
        border:1px solid black; */
    }

    @media screen and (max-width: 580px) {
        .table {
            display: block;
        }
    }

    .hang {
        display: table-row;
        background: #F5F5F5;
    }

    .hang:nth-of-type(odd) {
        background: #FFFFFF;
    }

    /* .row {
        display: table-row;
        background: #f6f6f6;
    } */

    .row:nth-of-type(odd) {
        /* background: #e9e9e9; */
    }

    .hang.header {
        font-size: :medium;
        font-weight: 700;
        color: #0a0a0a;
        background: #f3de4487;
    }

    .row.green {
        background: #27ae60;
    }

    .row.blue {
        background: #2980b9;
    }

    @media screen and (max-width: 580px) {
        .row {
            padding: 14px 0 7px;
            display: block;
        }

        .row.header {
            padding: 0;
            height: 6px;
        }

        .row.header .cell {
            display: none;
        }

        .row .cell {
            margin-bottom: 10px;
        }

        .row .cell:before {
            margin-bottom: 3px;
            content: attr(data-title);
            min-width: 98px;
            font-size: 10px;
            line-height: 10px;
            font-weight: bold;
            text-transform: uppercase;
            color: #d1d1d1;
            display: block;
        }
    }

    .cell {
        padding: 6px 12px;
        display: table-cell;
        border-collapse: collapse;
        /* border:1px solid black; */
        border: 1px ridge;
    }

    @media screen and (max-width: 580px) {
        .cell {
            padding: 2px 16px;
            display: block;
        }
    }

    /*BUTTOM*/
</style>


<div class="d-flex justify-content-between align-items-center p-2">
    <div>
        <!-- <h3 class="mb-0"> Thông tin chi tiết của đơn hàng ID <span class="text-primary font-weight-bold">#Y34XDHR</span></h> -->
    </div>
    <div class="text-end">
        <a href="/admin/coupons/add" class="btn btn-warning" data-abc="true"> <i class="fa fa-remove"></i></i> + Thêm mã mới</a>
    </div>
</div>

<div class="table">
    <div class="hang header" style="font-size: medium;">
        <div class="cell">
            #ID
        </div>

        <div class="cell">
            Tên giảm giá
        </div>

        <div class="cell">
            Mã giảm giá
        </div>

        <div class="cell">
            Số lượng mã
        </div>

        <div class="cell">
            Loại giảm
        </div>

        <div class="cell">
            Giá trị
        </div>

        <div class="cell">
            Tình trạng
        </div>

        <div class="cell">
            Hành động
        </div>
    </div>

    @foreach($magiamgias as $key => $magiamgia)

    <div class="hang">
        <div class="cell" data-title="Username">
            {{ $magiamgia->id }}
        </div>
        <div class="cell" data-title="Username">
            {{ $magiamgia->mgg_tengiamgia }}
        </div>
        <div class="cell" data-title="Username">
            {{ $magiamgia->mgg_magiamgia }}
        </div>
        <div class="cell" data-title="Username">
            {{ $magiamgia->mgg_soluongma }}
        </div>
        <div class="cell" data-title="Username">
            @if( $magiamgia->mgg_loaigiamgia == 1)
            <p class="column-6">Giảm theo phần trăm</p>
            @elseif($magiamgia->mgg_loaigiamgia == 2)
            <p class="column-6">Giảm theo tiền</p>
            @endif
        </div>
        <div class="cell" data-title="Email">
            <?php
            if ($magiamgia->mgg_loaigiamgia == 1) {
            ?>
                Giảm {{$magiamgia->mgg_giatrigiamgia}}%
            <?php
            } else {
            ?>
                Giảm {{$magiamgia->mgg_giatrigiamgia}}VND
            <?php
            }
            ?>
        </div>

        <div class="cell" data-title="Password">
            @if ($magiamgia->mgg_soluongma <= 0 )
                    <p style = ""><b>Hết mã</b></p>
            @elseif ($magiamgia->mgg_soluongma > 0)
                @if (\Carbon\Carbon::parse($magiamgia->mgg_ngayketthuc) > \Carbon\Carbon::now())
                    <p style = ""><b>Khả dụng</b></p>
                @else (\Carbon\Carbon::parse($magiamgia->mgg_ngayketthuc) < \Carbon\Carbon::now())
                    <p style=""><b>Hết hạn</b></p>
                @endif
            @endif            
        </div>

        <div class="cell" data-title="Active">
            <a class="btn btn-primary btn-sm" href="/admin/coupons/edit/{{ $magiamgia->id }}">
                <i class="fas fa-edit"></i>
            </a>
            <a href="#" class="btn btn-danger btn-sm" onclick="removeRow( {{ $magiamgia->id }} ,'/admin/coupons/destroy')">
                <i class="fas fa-trash"></i>
            </a>
        </div>
    </div>
    @endforeach
</div>



@endsection