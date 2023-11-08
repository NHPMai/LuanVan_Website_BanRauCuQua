@extends('admin.main')

@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
    <form action="" method="POST">
        <div class="card-body">

            <div class="form-group">
                <label for="menu">Tên Thương Hiệu<span class="text-danger">(*)</span></label>
                <input type="text" name="ten" class="form-control"  placeholder="Nhập tên thương hiệu">
            </div>

            <div class="form-group">
                <label>Mô Tả <span class="text-danger">(*)</span></label>
                <textarea name="mota" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label>Kích Hoạt <span class="text-danger">(*)</span></label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="hoatdong" checked="">
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="hoatdong" >
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Tạo Thương Hiệu</button>
        </div>
        @csrf
    </form>
@endsection

@section('footer')
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection