@extends('admin.main')

@section('head')
<script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
<form action="" method="POST">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="menu">Họ và tên <span class="text-danger">(*)</span></label>
                    <input type="text" name="hoten" value="{{ $khachhang->hoten }}" class="form-control" placeholder="Nhập tên nhà cung cấp">
                </div>

                <div class="form-group">
                    <label for="menu">Số điện thoai <span class="text-danger">(*)</span></label>
                    <input type="number" name="sodienthoai" value="{{ $khachhang->sodienthoai}}" class="form-control" placeholder="Nhập số điện thoại">
                </div>

                <div class="form-group">
                    <label style="margin-bottom: 10px;">Giới tính<span class="text-danger">(*)</span></label>
                    <select name="gioitinh" class="form-control input-inline" style=" margin-right: 10px;">
                        <option value="">-----Chọn-----</option>
                        <option value="1" {{ $khachhang->gioitinh == '1' ? 'selected' : '' }}>
                            Nam
                        </option>
                        <option value="2" {{ $khachhang->gioitinh == '2' ? 'selected' : '' }}>
                            Nữ
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="menu">Ngày sinh <span class="text-danger">(*)</span></label>
                    <input type="date" name="ngaysinh" value="{{ $khachhang->ngaysinh }}" class="form-control">
                </div>



            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="menu">Địa chỉ email <span class="text-danger">(*)</span></label>
                    <input type="email" name="email" value="{{ $khachhang->email }}" class="form-control" placeholder="Nhập email">
                </div>
                <div class="form-group">
                    <label for="menu">Mật khẩu<span class="text-danger">(*)</span></label>
                    <input type="password" name="password" value="{{ $khachhang->password }}" class="form-control" placeholder="Nhập mật khẩu">
                </div>
                <div class="form-group">
                    <label for="menu">Nhập lại mật khẩu<span class="text-danger">(*)</span></label>
                    <input type="password" name="password_confirmation" value="{{ $khachhang->password }}" class="form-control" placeholder="Nhập lại mật khẩu">
                </div>
                <div class="form-group">
                    <label for="menu">Địa chỉ cụ thể <span class="text-danger">(*)</span></label>
                    <input type="text" name="diachi" value="{{ $khachhang->diachi }}" class="form-control" placeholder="Nhập địa chỉ">
                </div>
            </div>

        </div>

        <div class="form-group">
            <label for="menu">Ảnh khách hàng<span class="text-danger">(*)</span></label>
            <input type="file" class="form-control" id="upload">
            <div id="image_show">
                <a href="{{ $khachhang->avata}}" target="_blank">
                    <img src="{{  $khachhang->avata }}" width="100px">
                </a>
            </div>
            <input type="hidden" name="avata" value="{{  $khachhang->avata }}" id="thumnb">
        </div>



        <div class="form-group">
            <lable>Kích Hoạt <span class="text-danger">(*)</span></lable>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" value="1" type="radio" id="active" name="hoatdong" {{$khachhang->hoatdong == 1 ? 'checked=""' : ''}}>
                <label for="active" class="custom-control-label">Có</label>
            </div>

            <div class="custom-control custom-radio">
                <input class="custom-control-input" value="0" type="radio" id="no_active" name="hoatdong" {{$khachhang->hoatdong == 0 ? 'checked=""' : ''}}>
                <label for="no_active" class="custom-control-label">Không</label>
            </div>
        </div>


    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <button type="submit" class="btn btn-danger">Hủy</button>
    </div>
    @csrf
</form>
@endsection

@section('footer')
<script>
    CKEDITOR.replace('content');
</script>
@endsection