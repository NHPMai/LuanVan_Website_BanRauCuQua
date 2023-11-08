@extends('admin.main')

@section('head')
<script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
<form action="" method="POST">
    <div class="card-body">

        <div>
            <div class="form-group">
                <label for="menu">Tên Sản Phẩm <span class="text-danger">(*)</span></label>
                <input type="text" name="ten" value="{{ $product->ten }}" class="form-control" placeholder="Nhập tên sản phẩm">
            </div>
        </div>


        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Danh Mục <span class="text-danger">(*)</span></label>
                    <select class="form-control" name="menu_id">
                        @foreach($menus as $menu)
                        <option value="{{ $menu->id }}" {{ $product->menu_id == $menu->id ? 'selected' : '' }}>
                            {{ $menu->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Thương Hiệu <span class="text-danger">(*)</span></label>
                    <select class="form-control" name="brand_id">
                        @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                            {{ $brand->ten }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="menu">Giá Gốc <span class="text-danger">(*)</span></label>
                    <input type="number" name="gia" value="{{ $product->gia }}" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="menu">Số Lượng Sản Phẩm <span class="text-danger">(*)</span></label>
                    <input type="number" name="soluongsp" value="{{ $product->soluongsp }}" class="form-control">
                </div>
            </div>

        </div>

        <!-- <div class="form-group">
                <label for="menu">Lượt Xem</label>
                <input type="number" name="luotxem" value="{{ $product->luotxem}}"  class="form-control" >
            </div> -->

        <div class="form-group">
            <label>Mô Tả <span class="text-danger">(*)</span></label>
            <textarea name="mota" class="form-control">{{ $product->mota }}</textarea>
        </div>

        <div class="form-group">
            <label>Mô Tả Chi Tiết <span class="text-danger">(*)</span></label>
            <textarea name="noidung" id="noidung" class="form-control">{{ $product->noidung }}</textarea>
        </div>

        <div class="form-group">
            <label for="menu">Ảnh Sản Phẩm <span class="text-danger">(*)</span></label>
            <input type="file" class="form-control" id="upload">
            <div id="image_show">
                <a href="{{ $product->hinhanh }}" target="_blank">
                    <img src="{{ $product->hinhanh }}" width="100px">
                </a>
            </div>
            <input type="hidden" name="hinhanh" value="{{ $product->hinhanh}}" id="hinhanh">
        </div>

        <div class="form-group">
            <label>Kích Hoạt <span class="text-danger">(*)</span></label>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" value="1" type="radio" id="active" name="hoatdong" {{ $product->hoatdong == 1 ? ' checked=""' : '' }}>
                <label for="active" class="custom-control-label">Có</label>
            </div>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" value="0" type="radio" id="no_active" name="hoatdong" {{ $product->hoatdong == 0 ? ' checked=""' : '' }}>
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
    CKEDITOR.replace('noidung');
</script>
@endsection