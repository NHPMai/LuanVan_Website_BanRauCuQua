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
                    <input type="text" name="mgg_tengiamgia" value="{{ old('mgg_tengiamgia',$magiamgia->mgg_tengiamgia ??'') }}" class="form-control" placeholder="Nhập tên giảm giá">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputNanme4" class="form-label"><strong>Mã giảm giá<span class="text-danger">(*)</span></strong></label>
                    <input type="text" name="mgg_magiamgia" value="{{ old('mgg_magiamgia',$magiamgia->mgg_magiamgia ??'') }}" class="form-control" placeholder="Nhập mã giảm giá">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputNanme4" class="form-label"><strong>Số lượng mã <span class="text-danger">(*)</span></strong></label>
                    <input type="number" class="form-control" id="mgg_soluongma" name="mgg_soluongma" placeholder="Nhập số lượng mã giảm giá" value="{{ old('mgg_soluongma', $magiamgia->mgg_soluongma ?? '') }}">
                        @error ('mgg_soluongma')
                        <span style="color: red;">{{ $message }}</span>
                        @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputNanme4" class="form-label"><strong>Loại giảm giá<span class="text-danger">(*)</span></strong></label>
                    <select class="form-control" name="mgg_loaigiamgia" id="mgg_loaigiamgia">
                            <option selected disabled value="">Chọn Loại Giảm Giá </option>
                            <option value="1" {{ $magiamgia->mgg_loaigiamgia == '1' ? 'selected' : '' }}>
                                Giảm theo phần trăm
                            </option>
                            <option value="2" {{ $magiamgia->mgg_loaigiamgia == '2' ? 'selected' : '' }}>
                                Giảm theo tiền
                            </option>
                        </select>
                        @error ('mgg_loaigiamgia')
                        <span style="color: red;">{{ $message }}</span>
                        @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputNanme4" class="form-label"><strong>Ngày bắt đầu <span class="text-danger">(*)</span></strong></label>
                    <input type="datetime-local" class="form-control" id="mgg_ngaybatdau" name="mgg_ngaybatdau" placeholder="Chọn ngày hết hạn" value="{{ old('mgg_ngaybatdau', $magiamgia->mgg_ngaybatdau?? '') }}">
                        @error ('mgg_ngaybatdau')
                        <span style="color: red;">{{ $message }}</span>
                        @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputNanme4" class="form-label"><strong>Ngày kết thúc <span class="text-danger">(*)</span></strong></label>
                    <input type="datetime-local" class="form-control" id="mgg_ngayketthuc" name="mgg_ngayketthuc" placeholder="Chọn ngày hết hạn" value="{{ old('mgg_ngayketthuc', $magiamgia->mgg_ngayketthuc?? '') }}">
                        @error ('mgg_ngayketthuc')
                        <span style="color: red;">{{ $message }}</span>
                        @enderror
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="inputNanme4" class="form-label"><strong>Giá trị giảm<span class="text-danger">(*)</span></strong></label>
            <input type="number" name="mgg_giatrigiamgia" class="form-control" value="{{ old('mgg_giatrigiamgia',$magiamgia->mgg_giatrigiamgia ??'') }}" placeholder="Nhập số tiền hoặc phần trăm giảm">
        </div>
    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Cập Nhật Mã Giảm</button>
    </div>
    @csrf
</form>

@endsection

@section('footer');
<script>
    CKEDITOR.replace('content');
</script>
@endsection