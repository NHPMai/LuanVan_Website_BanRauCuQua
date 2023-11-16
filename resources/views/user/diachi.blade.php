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

        
        <div class="col-xl-10 col-lg-9 col-md-12 col-sm-12 col-12">
            <div class="card h-100">
                <div class="card-body">
                    <h4 style="text-align:center; color:#007ae1; magin-top:20px; text-decoration:underline">ĐỊA CHỈ CỦA BẠN</h4>
                    
                    
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