@extends('admin.main')

@section('head')
<script src="/ckeditor/ckeditor.js"></script>
@endsection




<style>
    .box {
        display: grid;
        grid-template-columns: 1fr 1fr;
        /* chia làm 4 cột */
        grid-column-gap: 20px;
        /* khoảng cách giữa các cột */
        grid-row-gap: 20px;
        /* khoảng cách giữa các hàng cột */
    }

    /* size màn hình dưới 700px sẽ về 2 cột */
    @media (max-width: 700px) {
        .box {
            grid-template-columns: 1fr 1fr;
        }

        /* thành 2 cột */
    }

    /* size màn hình dưới 300px sẽ về 1 cột */
    @media (max-width: 300px) {
        .box {
            grid-template-columns: 1fr;
        }

        /* thành 1 cột */
    }

    table,
    td,
    th {
        border: 1px solid #ddd;
        text-align: left;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        padding: 15px;
    }

    /* Timf kiếm */
    .form-search .form-group {
        width: 100%;
        position: relative;
    }

    .form-search .form-group .form-control {
        width: 100%;
    }

    .form-search .search_ajax_result {
        position: absolute;
        background-color: #fff;
        padding: 10px;
        z-index: 1000;
        width: 200px;
    }

    .form-search .search_ajax_result h4 {
        font-size: 14px;
    }

    .form-search .search_ajax_result p {
        margin: 0;
        font-size: 11px;
        font-style: italic;
    }
</style>

@section('content')
<form action="" method="POST">
    <div class="card-body">

        <div class="box">
            <div style=" border:1px solid #999;  border-radius: 5px;">
                <div style="padding: 10px; background-color: #87CEFA; font-weight:700">
                    Thông tin
                </div>
                <div style="padding: 10px;">
                    <form>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-4 col-form-label">Người lập phiếu<span class="text-danger">(*)</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputPassword" value="{{Auth::user()->hoten}}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-4 col-form-label">Chọn nhà cung cấp<span class="text-danger">(*)</span></label>
                            <div class="col-sm-8">
                                <select class="form-control" name="menu_id">
                                    @foreach($warehouse as $warehouse)
                                    <option value="{{ $warehouse->id }}">{{ $warehouse->ncc_ten }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div style=" border:1px solid #999;  border-radius: 5px;">
                <div style="padding: 10px; background-color: #87CEFA; font-weight:700">
                    Thông tin
                </div>
                <div style="padding: 10px;">
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-4 col-form-label">Ghi chú</label>
                        <div class="col-sm-8">
                            <textarea type="text" class="form-control" id="inputPassword"></textarea>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="mt-4">
            <div style=" border:1px solid #999;">
                <div style="border:1px solid #999; font-weight:700">
                    <div class="row">
                        <div class="col-1">
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Dropdown
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    <a class="dropdown-item" href="#">Dropdown link</a>
                                    <a class="dropdown-item" href="#">Dropdown link</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-11">
                            <!-- <form action="{{ url('admin/search')}}" method="GET" class="form-inline" style="margin-bottom:0">
                                <div class="form-group">
                                    <input style="width: 1086px;" class="form-control form-control-sidebar" name="query" type="search" placeholder="Search" aria-label="Search">
                                    
                                </div>

                                <button type="submit" class="btn btn-light" style=" height: 34px; width: 61px;">
                                    <i class="fas fa-search fa-fw"></i>
                                </button>
                            </form> -->

                            <form class="navbar-form navbar-left form-search">
                                <div class="form-group">
                                    <input type="text" class="form-control input-search-ajax"   placeholder="Search">

                                    <div class="search_ajax_result">

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div style="padding: 10px;">
                    <table>
                        <tr>
                            <th style="text-align:center">Mã SP</th>
                            <th style="text-align:center">Hình ảnh</th>
                            <th style="text-align:center">Tên sản phẩm</th>
                            <th style="text-align:center">Giá nhập</th>
                            <th style="text-align:center">Số lượng</th>
                            <th style="text-align:center">Xóa</th>
                        </tr>
                        <tr>
                            <td style="text-align:center">Peter</td>
                            <td style="text-align:center">Griffin</td>
                            <td style="text-align:center">$100</td>
                            <td style="text-align:center">
                                <input type="number" id="fname" name="fname" style="width: 150px;">
                            </td>
                            <td style="text-align:center">
                                <input type="number" id="fname" name="fname" style="width: 80px;">
                            </td>
                            <td style="text-align:center">$100</td>
                        </tr>
                        <tr>
                            <td colspan="4" style="text-align: end; color:red; font-weight:700">Tổng tiền: </td>
                            <td style="text-align: center">Tổng số lượng</td>
                            <td></td>
                        </tr>

                    </table>
                </div>
            </div>
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

<!-- Timf kiếm  -->
<script>
    $('.search_ajax_result').hide()

    $('.input-search-ajax').keyup(function() {
        var _text = $(this).val();
        var _url = "{{url('')}}"

        if (_text != '') {
            $.ajax({
                url: "{{route('search_ajax')}}?key=" + _text,
                type: 'GET',
                success: function(res) {

                    var _html = '';

                    for (var pro of res) {
                        var slug = convertToSlug(pro.ten);
                        _html += '<div class="media">';
                        _html += '<a class="pull-left" href="#">';
                        _html += '<img class="media-object" width="50" style="margin-right: 15px;" src="' + _url + '/' + pro.hinhanh + '">';
                        _html += '</a>';
                        _html += '<div class="media-body">';
                        _html += '<h4 class="media-heading"><a href="http://phuongmai.localhost/san-pham/' +
                            pro.id + '-' + slug + '.html' + '">' +
                            pro.ten + '</a></h4>';
                        _html += '<p>' + pro.mota + '</p>';
                        _html += '</div>';
                        _html += '</div>';
                    }

                    $('.search_ajax_result').show();
                    $('.search_ajax_result').html(_html)

                }
            });
        } else {
            $('.search_ajax_result').html('');
            $('.search_ajax_result').hide()
        }

    });

    function convertToSlug(Text) {
        return Text
            .toLowerCase()
            .replace(/ /g, '-')
            .replace(/[^\w-]+/g, '');
    }
</script>
@endsection