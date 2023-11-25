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
                            <h4 style="text-decoration:underline">Cài đặt</h4>
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
                        <div class="user-profile pt-2" style=" padding-bottom: 0px; margin-bottom: 5px;">
                            <div class="user-avatar">
                                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" style="border-radius: 50%; border: 2px solid #a1a1a1;" alt="Maxwell Admin">

                                <!-- <input type="file" class="form-control" id="upload">
                                <div id="image_show"></div>
                                <input type="hidden" name="avata" id="thumnb"> -->

                            </div>
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
                                <label for="fullName">Họ tên<span class="text-danger">(*)</span></label>
                                <input type="text" class="form-control" id="fullName" placeholder="Nhập họ tên" value="{{ Auth('web')->user()->hoten }}">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="eMail">Email<span class="text-danger">(*)</span></label>
                                <input type="email" class="form-control" id="eMail" placeholder="Nhập email" value="{{ Auth('web')->user()->email }}" disabled>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="phone">Số điện thoại<span class="text-danger">(*)</span></label>
                                <input type="text" class="form-control" id="phone" placeholder="Nhập số điện thoại" value="{{ Auth('web')->user()->sodienthoai }}">
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="website">Tổng tiền đã mua<span class="text-danger">(*)</span></label>
                                <input type="number" class="form-control" id="tongtienmua" placeholder="Tổng tiền mua" value="{{ Auth('web')->user()->tongtienmua }}" disabled>
                            </div>
                        </div>

                        <div id="load_address"></div>


                    </div>


                    <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="text-right">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="margin:0">
                                    Thêm địa chỉ
                                </button>
                                <button type="button" id="submit" name="submit" class="btn btn-secondary">Cancel</button>
                                <button type="button" id="submit" name="submit" class="btn btn-primary" style="margin:0">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->
    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="margin-top: 100px;">


                <div class="card-body">
                    <h4 style="text-align:center; color:#007ae1; magin-top:20px; text-decoration:underline">ĐỊA CHỈ CỦA BẠN</h4>

                    <form>
                        <div class="card-body">

                            <div class="form-group">
                                <label for="menu">Chọn thành phố <span class="text-danger">(*)</span></label>
                                <select name="tinh_thanhpho" id="tinh_thanhpho" class="form-control m-bot15 choose tinh_thanhpho" style="height: 34px;">
                                    <option value="0">---Chọn tỉnh thành phố---</option>
                                    @foreach ($tinh_thanhpho as $key => $tp)
                                    <option value="{{$tp->id}}"> {{$tp->tp_ten}} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="menu">Chọn quận huyện <span class="text-danger">(*)</span></label>
                                <select name="quan_huyen" id="quan_huyen" class="form-control m-bot15 choose quan_huyen" style="height: 34px;">
                                    <option value="">---Chọn quận huyện----</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="menu">Chọn xã phường <span class="text-danger">(*)</span></label>
                                <select name="xa_phuong_thitran" id="xa_phuong_thitran" class="form-control m-bot15 xa_phuong_thitran" style="height: 34px;">
                                    <option value="">---Chọn xã phường----</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <textarea name="dc_diachi" id="dc_diachi" class="dc_diachi"></textarea>
                            </div>
                            <div id="load_address"></div>
                            <!-- <button type="button" name="add_delivery" class="btn btn-primary add_delivery">Thêm</button> -->

                            <!-- <div class="form-group">
                <label>Kích Hoạt <span class="text-danger">(*)</span></label>
                <div class="custom-control custom-radio">
                    <input class="form-check-input" value="1" type="radio" id="active" name="macdinh" checked="">
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="form-check-input" value="0" type="radio" id="no_active" name="macdinh" >
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div> -->
                            
                            <!-- <label for="menu">Mặc định <span class="text-danger">(*)</span></label>
                            <div class="form-check">
                                <input class="form-check-input" value="1" type="radio" name="macdinh" id="active">
                                <label class="form-check-label" for="active">
                                   Có 
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" value="0" type="radio" name="macdinh" id="no_active" checked>
                                <label class="form-check-label" for="no_active">
                                    Không
                                </label>
                            </div> -->

                            @csrf
                            <!-- </form> -->
                        </div>
                    </form>
                    <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="text-right">
                                <button type="button" id="submit" name="submit" class="btn btn-secondary">Cancel</button>
                                <button name="add_address" type="button" id="submit" name="submit" class="add_address btn btn-primary" style="margin:0">Thêm</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // THÊM PHÍ VẬN CHUYỂN
        $('.add_address').click(function() {
            var tinh_thanhpho = $('.tinh_thanhpho').val();
            var quan_huyen = $('.quan_huyen').val();
            var xa_phuong_thitran = $('.xa_phuong_thitran').val();
            var dc_diachi = $('.dc_diachi').val();
            var _token = $('input[name="_token"]').val();
            // alert (tinh_thanhpho);
            // alert (quan_huyen);
            // alert (xa_phuong_thitran);
            // alert (phivanchuyen);

            $.ajax({
                url: "{{url('/user/insert_address')}}",
                method: "POST",
                data: {
                    tinh_thanhpho: tinh_thanhpho,
                    quan_huyen: quan_huyen,
                    xa_phuong_thitran: xa_phuong_thitran,
                    dc_diachi: dc_diachi,
                    _token: _token
                },
                success: function(data) {
                    alert('Thêm phí địa chỉ thành công!')
                    fecth_delivery();
                }
            });
        });

        //Lấy dữ liệu địa chỉ
        fecth_delivery();

        function fecth_delivery() {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{url('/user/load_address')}}",
                method: "POST",
                data: {
                    _token: _token
                },
                success: function(data) {
                    $('#load_address').html(data);
                }
            });
        }
    });
</script>

@endsection