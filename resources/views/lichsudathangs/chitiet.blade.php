@extends('home')


@section('content')

<style>
  .card-stepper {
    z-index: 0
  }

  #progressbar-2 {
    color: #455A64;
  }

  #progressbar-2 li {
    list-style-type: none;
    font-size: 13px;
    width: 33.33%;
    float: left;
    position: relative;
  }

  #progressbar-2 #step1:before {
    content: '\f058';
    font-family: "Font Awesome 5 Free";
    color: #fff;
    width: 37px;
    margin-left: 0px;
    padding-left: 0px;
  }

  #progressbar-2 #step2:before {
    content: '\f058';
    font-family: "Font Awesome 5 Free";
    color: #fff;
    width: 37px;
  }

  #progressbar-2 #step3:before {
    content: '\f058';
    font-family: "Font Awesome 5 Free";
    color: #fff;
    width: 37px;
    margin-right: 0;
    text-align: center;
  }

  #progressbar-2 #step4:before {
    content: '\f111';
    font-family: "Font Awesome 5 Free";
    color: #fff;
    width: 37px;
    margin-right: 0;
    text-align: center;
  }

  #progressbar-2 li:before {
    line-height: 37px;
    display: block;
    font-size: 12px;
    background: #c5cae9;
    border-radius: 50%;
  }

  #progressbar-2 li:after {
    content: '';
    width: 100%;
    height: 10px;
    background: #c5cae9;
    position: absolute;
    left: 0%;
    right: 0%;
    top: 15px;
    z-index: -1;
  }

  #progressbar-2 li:nth-child(1):after {
    left: 1%;
    width: 100%
  }

  #progressbar-2 li:nth-child(2):after {
    left: 1%;
    width: 100%;
  }

  #progressbar-2 li:nth-child(3):after {
    left: 1%;
    width: 100%;
    /* background: #c5cae9 !important; */
  }

  #progressbar-2 li:nth-child(4) {
    left: 0;
    width: 37px;
    /* background: #c5cae9 !important; */
  }

  #progressbar-2 li:nth-child(4):after {
    left: 0;
    width: 0;
  }

  #progressbar-2 li.active:before,
  #progressbar-2 li.active:after {
    background: #6520ff;
  }


  /* cuc */
  body {
            background-color:
                #eeeeee;
            font-family: 'Open Sans', serif
        }

        .container_order {
            margin-top: 50px;
            margin-bottom: 50px
        }

        .card {
            position:
                relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction:
                normal;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color:
                #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius:
                0.10rem
        }

        .card-header:first-child {
            border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0
        }

        .card-header {
            padding:
                0.75rem 1.25rem;
            margin-bottom: 0;
            background-color: #fff;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1)
        }

        .track {
            position:
                relative;
            background-color: #ddd;
            height: 7px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            margin-bottom:
                60px;
            margin-top: 50px
        }

        .track .step {
            -webkit-box-flex: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
            width: 25%;
            margin-top:
                -18px;
            text-align: center;
            position: relative
        }

        .track .step.active:before {
            background: #FF5722
        }

        .track .step::before {
            height: 7px;
            position: absolute;
            content: "";
            width: 100%;
            left: 0;
            top: 18px
        }

        .track .step.active .icon {
            background: #ee5435;
            color: #fff
        }

        .track .icon {
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height:
                40px;
            position: relative;
            border-radius: 100%;
            background: #ddd
        }

        .track .step.active .text {
            font-weight: 400;
            color:
                #000
        }

        .track .text {
            display: block;
            margin-top: 7px
        }

        .itemside {
            position: relative;
            display: -webkit-box;
            display:
                -ms-flexbox;
display: flex;
            width: 100%
        }

        .itemside .aside {
            position: relative;
            -ms-flex-negative: 0;
            flex-shrink:
                0
        }

        .img-sm {
            width: 80px;
            height: 80px;
            padding: 7px
        }

        ul.row,
        ul.row-sm {
            list-style: none;
            padding: 0
        }

        .itemside .info {
            padding-left: 15px;
            padding-right: 7px
        }

        .itemside .title {
            display: block;
            margin-bottom: 5px;
            color:
                #212529
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem
        }

        .btn-warning {
            color: #ffffff;
            background-color: #ee5435;
            border-color:
                #ee5435;
            border-radius: 1px
        }

        .btn-warning:hover {
            color: #ffffff;
            background-color: #ff2b00;
            border-color:
                #ff2b00;
            border-radius: 1px
        }
</style>

<section class="vh-100" style="background-color: #8c9eff; font-size:medium">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 p-t-20">
        <div class="card card-stepper text-black" style="border-radius: 16px;">
        
          <div class="card-body p-5">
         
            <div class="d-flex justify-content-between align-items-center mb-5">
              <div>
                <h3 class="mb-0"> Thông tin chi tiết của đơn hàng ID: <span class="text-primary font-weight-bold">{{$donhang->id}}</span></h>
              </div>
              @if ($donhang->dh_trangthai == 1 )
              <div class="text-end">
                <a href="#" class="btn btn-warning" data-abc="true" style="font-weight: 600;"> <i class="fa fa-remove"></i> Hủy đơn hàng</a>
              </div>
              @elseif ($donhang->dh_trangthai == 3 )
              <div class="text-end">
                <!-- <a href="shipper/order_history/{{$donhang->id}}" class="btn btn-success" data-abc="true" style="font-weight: 600;"> <i class="fa fa-check"></i> Đã nhận</a> -->
                <a href="/user/order_update/{{$donhang->id}}" class="btn btn-success" data-abc="true" style="font-weight: 600;"> <i class="fa fa-check"></i> Đã nhận</a>
              </div>
              @endif
            </div>

            <article class="card ">
              <div class="card-body row">
                <div class="col"> <strong>Thời gian đặt hàng:</strong> <br>{{$donhang->dh_thoigiandathang}} </div>
                <div class="col"> <strong>Giao bởi:</strong> <br> Chưa xác định, | <i class="fa fa-phone"></i> {{$donhang->khachhangs->sodienthoai}} </div>
                <div class="col"> <strong>Trạng thái:</strong> <br>
                  @if ($donhang->dh_trangthai == 1)
                      Chờ duyệt
                  @elseif ($donhang->dh_trangthai == 2)
                      Đã duyệt
                  @elseif ($donhang->dh_trangthai == 3)
                      Đang vận chuyển
                  @elseif ($donhang->dh_trangthai == 4)
                      Giao hàng thành công
                  @endif
                </div>
                <div class="col"> <strong>Theo dõi #:</strong> <br>{{$donhang->id}}</div>
              </div>
            </article>

            @php
              $status_confirmed = '';
              $status_picked = '';
              $status_way = '';
              $status_ready = '';

              if ($donhang->dh_trangthai == 4) {
                  $status_confirmed = 'active';
                  $status_picked = 'active';
                  $status_way = 'active';
                  $status_ready = 'active';
              } elseif ($donhang->dh_trangthai == 3) {
                  $status_confirmed = 'active';
                  $status_picked = 'active';
                  $status_way = 'active';
              } elseif ($donhang->dh_trangthai == 2) {
                  $status_confirmed = 'active';
                  $status_picked = 'active';
              } else {
                  $status_confirmed = 'active';
              }
          @endphp

            <ul id="progressbar-2" class="d-flex justify-content-between mx-0 mt-0 mb-5 px-0 pt-5 pb-2">
              <li class="step0 {{ $status_confirmed }} text-center" id="step1"></li>
              <li class="step0 {{ $status_picked }} text-center" id="step2"></li>
              <li class="step0 {{ $status_way }} text-center" id="step3"></li>
              <li class="step0 {{ $status_ready }}  text-center" id="step4"></li>
            </ul>

            <div class="d-flex justify-content-between">
              <div class="d-lg-flex align-items-center">
                <i class="fas fa-clipboard-list fa-3x me-lg-4 mb-3 mb-lg-0"></i>
                <div class="p-l-6" style="font-size: 15px; font-weight:bolder">
                  <p class="fw-bold mb-1">Chờ</p>
                  <p class="fw-bold mb-0">Xác Nhận</p>
                </div>
              </div>
              <div class="d-lg-flex align-items-center">
                <i class="fas fa-box-open fa-3x me-lg-4 mb-3 mb-lg-0"></i>
                <div class="p-l-6" style="font-size: 15px; font-weight:bolder">
                  <p class="fw-bold mb-1 ">Đã</p>
                  <p class="fw-bold mb-0">Duyệt</p>
                </div>
              </div>
              <div class="d-lg-flex align-items-center">
                <i class="fas fa-shipping-fast fa-3x me-lg-4 mb-3 mb-lg-0"></i>
                <div class="p-l-6" style="font-size: 15px; font-weight:bolder">
                  <p class="fw-bold mb-1">Đang</p>
                  <p class="fw-bold mb-0">Vận Chuyển</p>
                </div>
              </div>
              <div class="d-lg-flex align-items-center">
                <i class="fas fa-home fa-3x me-lg-4 mb-3 mb-lg-0"></i>
                <div class="p-l-6" style="font-size: 15px; font-weight:bolder">
                  <p class="fw-bold mb-1">Giao hàng</p>
                  <p class="fw-bold mb-0">Thành công</p>
                </div>
              </div>
            </div>

          </div>
         
          <div class="p-5">
          @php $total = 0; @endphp
            @foreach($chitietdonhangs as $key => $chitietdonhang)
            @php
            $price = $chitietdonhang->ctdh_gia * $chitietdonhang->ctdh_soluong;
            $total += $price;
            @endphp
            <div class="row itemside  p-1" style="border-top: 1px solid #e6e6e6; ">
              <div class="col-2 ">
                <img src="{{ $chitietdonhang->product->hinhanh}}" alt="IMG" style="width: 100px">
              </div>
              <div class="col-10 info align-self-center">
             
                <p class="title" style="font-size: larger; font-weight:700"> <br> {{ $chitietdonhang->product->ten}}</p> <span class="text-muted">{{ $chitietdonhang->product->gia}} </span>
             
              </div>
            </div>
            @endforeach
            <hr>
            <div class="row">
              <div class="col-6">
                <a href="/user/order_history" class="btn btn-secondary text-start" data-abc="true"> <i class="fa fa-chevron-left"></i> Quay lại</a>
              </div>

              <div class="col-6">
                <h4 class="mb-0" style="text-align: right;">Tổng tiền: <span>{{$donhang->dh_thanhtien}}</span> VNĐ</h4>
              </div>

            </div>


          </div>

        
        </div>

      </div>
    </div>
  </div>
</section>

@endsection