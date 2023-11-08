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
                    <label for="menu">Tên Nhà Cung Cấp<span class="text-danger">(*)</span></label>
                    <input type="text" name="ncc_ten" value="{{ $nhacungcap->ncc_ten }}" class="form-control" placeholder="Nhập tên nhà cung cấp">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="menu">Email<span class="text-danger">(*)</span></label>
                    <input type="text" name="ncc_email" value="{{ $nhacungcap->ncc_email }}" class="form-control" placeholder="Nhập Email">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="menu">Số Điện Thoại<span class="text-danger">(*)</span></label>
                    <input type="number" name="ncc_sodienthoai" value="{{ $nhacungcap->ncc_sodienthoai }}" class="form-control" placeholder="Nhập Số Điện Thoại">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="menu">Website<span class="text-danger">(*)</span></label>
                    <input type="text" name="ncc_website" value="{{ $nhacungcap->ncc_website }}" class="form-control" placeholder="Nhập Website">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="menu">Website<span class="text-danger">(*)</span></label>
            <input type="text" name="ncc_diachi" value="{{ $nhacungcap->ncc_diachi }}" class="form-control" placeholder="Nhập địa chỉ">
        </div>


        <div class="form-group">
            <label>Kích Hoạt<span class="text-danger">(*)</span></label>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" value="1" type="radio" id="active" name="ncc_trangthai" {{ $nhacungcap->ncc_trangthai == 1 ? ' checked=""' : '' }}>
                <label for="active" class="custom-control-label">Có</label>
            </div>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" value="0" type="radio" id="no_active" name="ncc_trangthai" {{ $nhacungcap->ncc_trangthai == 0 ? ' checked=""' : '' }}>
                <label for="no_active" class="custom-control-label">Không</label>
            </div>
        </div>

    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Cập Nhật Sản Phẩm</button>
    </div>
    @csrf
</form>
@endsection

@section('footer')
<script>
    CKEDITOR.replace('content');
</script>
@endsection