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

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="#" class="fas fa-user"><b>&nbsp ĐĂNG KÍ</b></a>
    </div>

    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Register to start your session</p>

        <form action="{{route('user.create')}}" method="post">
          @if(Session::has('success'))
          <div class="alert alert-success">{{Session::get('success')}}</div>
          @endif
          @if(Session::has('fail'))
          <div class="alert alert-danger">{{Session::get('fail')}}</div>
          @endif
          @csrf
          <div class="input-group mb-3">
            <input type="text" name="hoten" class="form-control" placeholder="Họ và tên">
            <!-- <span class="text-danger">@error('hoten') {{$$message}}  @enderror</span> -->
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

          <!-- <div class="input-group mb-3">
            <input type="text" name="avata" class="form-control" placeholder="Avata">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div> -->

          <div class="input-group mb-3">
            <input type="number" name="sodienthoai" class="form-control" placeholder="Số điện thoại">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-phone"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="text" name="gioitinh" class="form-control" placeholder="Giới tính">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="date" name="ngaysinh" class="form-control" placeholder="Ngày sinh">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>

          <!-- <div class="input-group mb-3">
            <input type="text" name="vip" class="form-control" placeholder="Vip">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="text" name="tongtienmua" class="form-control" placeholder="Tổng tiền mua">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="text" name="hoatdong" class="form-control" placeholder="Hoạt động">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div> -->


          <div class="input-group ">

            <form>
              <div class="card-body">

                <div class="form-group">
                  <label for="menu">Chọn thành phố</label>
                  <select name="tinh_thanhpho" id="tinh_thanhpho" class="form-control m-bot15 choose tinh_thanhpho">
                    <option value="0">---Chọn tỉnh thành phố---</option>
                    @foreach ($tinh_thanhpho as $key => $tp)
                    <option value="{{$tp->id}}"> {{$tp->tp_ten}} </option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="menu">Chọn quận huyện</label>
                  <select name="quan_huyen" id="quan_huyen" class="form-control m-bot15 choose quan_huyen">
                    <option value="">---Chọn quận huyện----</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="menu">Chọn xã phường</label>
                  <select name="xa_phuong_thitran" id="xa_phuong_thitran" class="form-control m-bot15 xa_phuong_thitran">
                    <option value="">---Chọn xã phường----</option>
                  </select>
                </div>


                <!-- <div>
                  <input type="botton" value="Tính phí vận chuyển" name="calculate_delivery" class="btn btn-primary btn-sm calculate_delivery">
                </div> -->

                <!-- <button type="button" name="add_delivery" class="btn btn-primary add_delivery">Thêm</button> -->

                @csrf
                <!-- </form> -->
              </div>
            </form>

          </div>

          <div class="input-group mb-3">
            <textarea id="load_diachi" name="diachi" class="form-control" placeholder="Địa chỉ"></textarea>
          </div>

          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Register</button>
            </div>
            <!-- /.col -->
          </div>

          <br>
          <a href="{{route('user.login')}}">Login Here</a>
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