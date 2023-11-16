@extends('home')

@section('content')
<style>
    body {
        margin: 0;
        /* padding-top: 40px; */
        color: #2e323c;
        background: #f5f6fa;
        position: relative;
        height: 100%;
    }

    .account-settings .user-profile {
        margin: 0 0 1rem 0;
        padding-bottom: 1rem;
        text-align: center;
    }

    .account-settings .user-profile .user-avatar {
        margin: 0 0 1rem 0;
    }

    .account-settings .user-profile .user-avatar img {
        width: 120px;
        height: 120px;
        -webkit-border-radius: 100px;
        -moz-border-radius: 100px;
        border-radius: 100px;
    }

    .account-settings .user-profile h4.user-name {
        margin: 0 0 0.5rem 0;
    }

    .account-settings .user-profile h6.user-email {
        margin: 0;
        font-size: 0.8rem;
        font-weight: 400;
        color: #9fa8b9;
    }

    .account-settings .about {
        margin: 2rem 0 0 0;
        text-align: center;
    }

    .account-settings .about h4 {
        margin: 0 0 15px 0;
        color: #007ae1;
    }

    .account-settings .about p {
        font-size: 15px;
    }

    .form-control {
        border: 1px solid #cfd1d8;
        -webkit-border-radius: 2px;
        -moz-border-radius: 2px;
        border-radius: 2px;
        font-size: 13px;
        background: #ffffff;
        color: #2e323c;
    }

    .card {
        background: #ffffff;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        border: 0;
        margin-bottom: 1rem;
    }
</style>


<div class="container p-t-50 p-b-20">
    <div class="row gutters">
        <div class="col-xl-2 col-lg-3 col-md-12 col-sm-12 col-12">
            <div class="card h-40">
                <div class="card-body">
                    <div class="account-settings">
                        <div class="about" style="margin-top: 10px;">
                            <h4 style="text-decoration:underline" >Cài đặt</h4>
                            <div class="list-group">
                                <a href="#" class="list-group-item list-group-item-action list-group-item-primary" style="font-size: 16px; font-weight:500">Tài khoản</a>
                                <a href="#" class="list-group-item list-group-item-action list-group-item-secondary" style="font-size: 16px; font-weight:500">Mật khẩu</a>
                               
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
            <div class="card h-100">
                <div class="card-body">
                    <div class="border-bottom-5px"></div>
                    <div class="account-settings">
                        <h4 style="text-align:center; color:#007ae1; magin-top:20px;  text-decoration:underline">Ảnh đại diện</h4>
                        <div class="user-profile pt-2" style=" padding-bottom: 0px; margin-bottom: 5px;" >
                            <div class="user-avatar">
                                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" style="border-radius: 50%; border: 2px solid #a1a1a1;"  alt="Maxwell Admin">
                            </div>
                            <!-- <h5 class="user-name">{{Auth('web')->user()->hoten}}</h5> -->
                        </div>
                        <div class="about">
                            <i class='fas fa-image' style='font-size:36px'></i>
                            <h5>Ảnh đại diện</h5>
                            <p>Hãy tải ảnh lên với kích thước <br>150px x 150px <br>(Tỉ lệ 1x1)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-7 col-lg-9 col-md-12 col-sm-12 col-12">
            <div class="card h-100">
                <div class="card-body">
                    <h4 style="text-align:center; color:#007ae1; magin-top:20px; text-decoration:underline">THÔNG TIN CÁ NHÂN</h4>
                    <div class="row gutters">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="fullName">Họ tên</label>
                                <input type="text" class="form-control" id="fullName" placeholder="Nhập họ tên" value="{{ Auth('web')->user()->hoten }}">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="eMail">Email</label>
                                <input type="email" class="form-control" id="eMail" placeholder="Nhập email" value="{{ Auth('web')->user()->email }}">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="phone">Số điện thoại</label>
                                <input type="text" class="form-control" id="phone" placeholder="Nhập số điện thoại" value="{{ Auth('web')->user()->sodienthoai }}">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="website">Tổng tiền đã mua</label>
                                <input type="url" class="form-control" id="website" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="row gutters">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="Street">Địa chỉ 1</label>
                                <input type="name" class="form-control" id="Street" placeholder="">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="ciTy">Địa chỉ 2</label>
                                <input type="name" class="form-control" id="ciTy" placeholder="">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="sTate">Địa chỉ 3</label>
                                <input type="text" class="form-control" id="sTate" placeholder="">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <button type="submit" class="flex-c-m stext-103 cl0 size-103 bg1 bor1 hov-btn1 p-lr-15 trans-04 ">
                                <a href="{{URL::to('/user/diachikhachhang')}}">Thêm địa chỉ</a>
                            </button>
                        </div>
                    </div>
                    <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="text-right">
                                <button type="button" id="submit" name="submit" class="btn btn-secondary">Cancel</button>
                                <button type="button" id="submit" name="submit" class="btn btn-primary" style="margin:0">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection