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
                    <label for="inputNanme4" class="form-label"><strong>Tên mã giảm giá <span class="text-danger">(*)</span></strong></label>
                    <input type="text" name="mgg_tengiamgia" value="{{ old('mgg_tengiamgia', $request->mgg_tengiamgia ?? '') }}" class="form-control" placeholder="Nhập tên giảm giá">
                    @error ('mgg_tengiamgia')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputNanme4" class="form-label"><strong>Mã giảm giá<span class="text-danger">(*)</span></strong></label>
                    <input type="text" name="mgg_magiamgia" value="{{ old('mgg_magiamgia' , $request->mgg_magiamgia ?? '') }}" class="form-control" placeholder="Nhập mã giảm giá">
                    @error ('mgg_magiamgia')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputNanme4" class="form-label"><strong>Số lượng mã <span class="text-danger">(*)</span></strong></label>
                    <input type="number" name="mgg_soluongma" value="{{ old('mgg_soluongma', $request->mgg_soluongma ?? '')  }}" class="form-control" placeholder="Nhập số lượng mã">
                    @error ('mgg_soluongma')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputNanme4" class="form-label"><strong>Loại giảm giá<span class="text-danger">(*)</span></strong></label><label for="exampleFormControlSelect1">Loại giảm giá: </label>
                    <select class="form-control" id="exampleFormControlSelect1"  name="mgg_loaigiamgia">
                        <option value="">----Chọn----</option>
                        <option value="1">Giảm theo phần trăm</option>
                        <option value="2">Giảm theo tiền</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                <label for="inputNanme4" class="form-label"><strong>Ngày bắt đầu <span class="text-danger">(*)</span></strong></label>
                    <input type="datetime-local" id="mgg_ngaybatdau" name="mgg_ngaybatdau" value="{{ old('mgg_ngaybatdau', $request->mgg_ngaybatdau ?? '') }}" class="form-control">
                    @error ('mgg_ngaybatdau')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputNanme4" class="form-label"><strong>Ngày kết thúc <span class="text-danger">(*)</span></strong></label>
                    <input type="datetime-local" class="form-control" id="mgg_ngayketthuc" name="mgg_ngayketthuc" placeholder="Chọn ngày hết hạn" value="{{ old('mgg_ngayketthuc', $request->mgg_ngayketthuc?? '') }}">
                        @error ('mgg_ngayketthuc')
                        <span style="color: red;">{{ $message }}</span>
                        @enderror
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="inputNanme4" class="form-label"><strong>Giá trị giảm<span class="text-danger">(*)</span></strong></label>
            <input type="number" name="mgg_giatrigiamgia" class="form-control" value="{{ old('mgg_giatrigiamgia', $request->mgg_giatrigiamgia ?? '') }}" placeholder="Nhập số tiền hoặc phần trăm giảm">
        </div>
    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Tạo Mã Giảm</button>
    </div>
    @csrf
</form>

@endsection

@section('footer');
<script>
    CKEDITOR.replace('content');
</script>
@endsection