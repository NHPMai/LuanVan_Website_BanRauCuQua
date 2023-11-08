@extends('admin.main')

@section('content')

<!-- <form action="" method="POST"> -->
<div style="width:82%;margin-left: 100px;">
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="menu">Chọn thành phố<span class="text-danger">(*)</span></label>
                    <select name="tinh_thanhpho" id="tinh_thanhpho" class="form-control m-bot15 choose tinh_thanhpho">
                        <option value="0">---Chọn tỉnh thành phố---</option>
                        @foreach ($tinh_thanhpho as $key => $tp)
                        <option value="{{$tp->id}}"> {{$tp->tp_ten}} </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="menu">Chọn quận huyện <span class="text-danger">(*)</span></label>
                    <select name="quan_huyen" id="quan_huyen" class="form-control m-bot15 choose quan_huyen">
                        <option value="">---Chọn quận huyện----</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="menu">Chọn xã phường <span class="text-danger">(*)</span></label>
                    <select name="xa_phuong_thitran" id="xa_phuong_thitran" class="form-control m-bot15 xa_phuong_thitran">
                        <option value="">---Chọn xã phường----</option>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="menu">Phí vận chuyển <span class="text-danger">(*)</span></label>
                    <input name="phivanchuyen" class="form-control m-bot15 phivanchuyen" type="text" placeholder="Nhập phí vận chuyển">
                </div>
            </div>
        </div>


        <div style="text-align: right;">
            <button type="button" name="add_delivery" class="btn btn-primary add_delivery">Thêm</button>
        </div>
        @csrf
        <!-- </form> -->
    </div>
</div>

<div id="load_delivery">

</div>
@endsection