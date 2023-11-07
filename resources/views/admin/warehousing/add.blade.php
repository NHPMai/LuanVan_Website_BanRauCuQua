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
                        <label for="user_id">Nội Dung Phiếu Nhập</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control"  placeholder="Nhập tên nhà cung cấp">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nhân Viên Nhập</label>
                        <select class="form-control" name="user_id">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="user_id">Số lượng</label>
                        <input type="number" name="soluong" value="{{ old('soluong') }}" class="form-control"  placeholder="Nhập số lượng">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Đơn Vị</label>
                        <input type="text" name="donvi" value="{{ old('donvi') }}" class="form-control"  placeholder="Nhập đơn vị">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Giá Nhập Hàng</label>
                        <input type="number" name="gianhaphang" value="{{ old('gianhaphang') }}" class="form-control"  placeholder="Nhập giá">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="user_id">Ngày sản xuất</label>
                        <input type="date" name="ngaysanxuat" value="{{ old('ngaysanxuat') }}" class="form-control"  placeholder="Nhập ngay san xuat">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Ngày hết hạn</label>
                        <input type="date" name="ngayhethan" value="{{ old('ngayhethan') }}" class="form-control"  placeholder="Nhập ngay het han">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="user_id">Ghi Chú</label>
                <textarea name="note" class="form-control">{{ old('note') }}</textarea>
            </div>
            

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Thêm Dữ liệu Nhập</button>
        </div>
        @csrf
    </form>
@endsection

@section('footer')
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection