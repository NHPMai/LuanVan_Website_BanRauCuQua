<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/template/admin/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="/template/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/template/admin/dist/css/adminlte.min.css">

  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="hold-transition login-page" style="background-image: url('/template/images/bg7.png') ;">
  <div class="login-box">
    <div class="login-logo">
      <i class="fas fa-user" style="color:ivory;"></i>
      <a href="#" style="font-size:45px; font-weight:700; color:ivory; font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif"><b>ĐĂNG KÍ</b></a>
      <!-- <a  style="color:ivory;"><b>&nbsp ĐĂNG KÍ</b></a> -->
    </div>

    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Đăng kí tài khoản để mua sản phẩm!</p>
        @include('admin.alert')

        <form action="{{route('user.create')}}" method="post">

          <div class="input-group mb-3">
            <input type="text" name="hoten" value="{{ old('hoten') }}" class="form-control" placeholder="Họ và tên">

            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="password" name="password" value="{{ old('password') }}" class="form-control" placeholder="Nhập mật khẩu">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="password" name="password_confirmation" class="form-control" placeholder="Nhập lại mật khẩu">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="number" name="sodienthoai" value="{{ old('sodienthoai') }}" class="form-control" placeholder="Số điện thoại">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-phone"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <select name="gioitinh" class="form-control input-inline" style=" margin-right: 10px;">
              <option value="">-----Giới tính-----</option>
              <option value="1">Nam</option>
              <option value="2">Nữ</option>
            </select>

            <!-- <input type="text" name="gioitinh" class="form-control" placeholder="Giới tính">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div> -->
          </div>

          <div class="input-group mb-3">
            <input type="date" name="ngaysinh"  value="{{ old('ngaysinh') }}" class="form-control" placeholder="Ngày sinh">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input id="load_diachi" name="diachi"  value="{{ old('diachi') }}" class="form-control" placeholder="Địa chỉ">
          </div>

          <div class="row">
            <div class="col-8" style="padding-top: 10px;">
              <!-- <div class="icheck-primary">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">
                  Remember Me
                </label>
              </div> -->
              <a href="{{route('user.login')}}">Đăng nhập</a>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Đăng kí</button>
            </div>
            <!-- /.col -->
          </div>

         
          @csrf
        </form>


      </div>
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="/template/admin/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="/template/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="/template/admin/dist/js/adminlte.min.js"></script>

  <script src="/template/admin/js/main.js"></script>

  <!--------------------- ĐỊA CHỈ ---------------------------------->

  <script type="text/javascript">
    // chọn thành phố, huyện, xã
    $(document).ready(function() {
      $('.choose').on('change', function() {
        var action = $(this).attr('id');
        var ma_id = $(this).val();
        var _token = $('input[name="_token"]').val();
        var $result = '';

        if (action == 'tinh_thanhpho') {
          result = 'quan_huyen';
        } else {
          result = 'xa_phuong_thitran';
        }
        $.ajax({
          url: "{{url('/user/diachi')}}",
          method: "POST",
          data: {
            action: action,
            ma_id: ma_id,
            _token: _token
          },
          success: function(data) {
            $('#' + result).html(data);
          }
        });
      });
    });

    //LẤY DỮ LIỆU
    // fecth_delivery();

    // function fecth_delivery() {
    //   var _token = $('input[name="_token"]').val();
    //   $.ajax({
    //     url: "{{url('/user/laydiachi')}}",
    //     method: "POST",
    //     data: {
    //       _token: _token
    //     },
    //     success: function(data) {
    //       $('#load_diachi').html(data);
    //     }
    //   });
    // }
  </script>

</body>

</html>