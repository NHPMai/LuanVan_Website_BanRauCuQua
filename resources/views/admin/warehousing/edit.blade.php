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
                        <label for="menu">Nội Dung Phiếu Nhập</label>
                        <input type="text" name="name"  value="{{ $warehousing->name }}" class="form-control"  placeholder="Nhập tên phiếu nhập">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Nhân Viên Nhập</label>
                        <input type="text" name="user_id" value="{{ $warehousing->user_id }}" class="form-control"  placeholder="Nhập Email">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="menu">Số Lượng</label>
                        <input type="number" name="soluong"  value="{{ $warehousing->soluong }}" class="form-control"  placeholder="Nhập số lượng">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="menu">Đơn Vị</label>
                        <input type="text" name="donvi" value="{{ $warehousing->donvi }}" class="form-control"  placeholder="Nhập đơn vị">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="menu">Giá Nhập Hàng</label>
                        <input type="number" name="gianhaphang" value="{{ $warehousing->gianhaphang }}" class="form-control"  placeholder="Nhập giá nhập">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Ngày Sản Xuất</label>
                        <input type="date" name="ngaysanxuat"  value="{{ $warehousing->ngaysanxuat }}" class="form-control"  placeholder="Nhập ngày sản xuất">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Ngày Hết Hạn</label>
                        <input type="date" name="ngayhethan" value="{{ $warehousing->ngayhethan }}" class="form-control"  placeholder="Nhập ngày hết hạn">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="menu">Ghi Chú</label>
                <textarea name="note" class="form-control">{{ old('note') }}</textarea>
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