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

    /* TIM KIEM */

    /* .form-search .form-group {
        width: 100%;
        position: relative;
    }

    .form-search .form-group .form-control {
        width: 100%;
    }

    .form-search #search_ajax {
        position: absolute;
        background-color: #fff;
        padding: 10px;
        z-index: 1000;
        width: 200px;
    }

    .form-search #search_ajax h4 {
        font-size: 14px;
    }

    .form-search #search_ajax p {
        margin: 0;
        font-size: 11px;
        font-style: italic;
    } */
</style>

@section('content')
<form action="/admin/warehouses/add" method="POST">
    <div class="card-body">

        <div class="box">
            <div style=" border:1px solid #999;  border-radius: 5px;">
                <div style="padding: 10px; background-color: #87CEFA; font-weight:700">
                    Thông tin
                </div>
                <div style="padding: 10px;">
                    <div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-4 col-form-label">Người lập phiếu<span class="text-danger">(*)</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputPassword" value="{{Auth::user()->hoten}}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-4 col-form-label">Chọn nhà cung cấp<span class="text-danger">(*)</span></label>
                            <div class="col-sm-8">
                                <select class="form-control" name="nhacungcap_id">
                                    @foreach($nhacungcap as $ncc)
                                    <option value="{{ $ncc->id }}">{{ $ncc->ncc_ten }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
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
                            <textarea name="ctpn_ghichu" value="{{ old('ctpn_ghichu') }}" type="text" class="form-control" id="inputPassword"></textarea>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="mt-4">
            <div style=" border:1px solid #999;">
                <div style="border:1px solid #999; font-weight:700">

                    <div class="card" style="margin: 0;">
                        <div class="card-body" style="padding: 0; margin-left:5px">
                            <div class="row">
                                <div style="display: flex; justify-content: flex-start; align-items: center;">
                                    <div style="display: flex; align-items: center;">
                                        <button class="text-success" type="button"><b>Sản phẩm</b></button>
                                        <input autocomplete="off" type="text" style="width: 290px" placeholder="Tìm kiếm sản phẩm" id="keywords">
                                        <button type="button" id="clear-input"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="display: flex; align-items: center;">
                            <div id="search-ajax"></div>
                        </div>
                    </div>
                    
                    <!-- <div class="row">
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
                            <div class="card" style="margin: 0;">
                                <div class="card-body" style="padding: 0;">
                                    <div class="row">
                                        <div style="display: flex; justify-content: flex-start; align-items: center;">
                                            <div style="display: flex; align-items: center;">
                                                <button class="text-success" type="button"><b>Sản phẩm</b></button>
                                                <input autocomplete="off" type="text" style="width: 290px" placeholder="Tìm kiếm sản phẩm" id="keywords">
                                                <button type="button" id="clear-input"><i class="fa fa-times"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div style="display: flex; align-items: center;">
                                    <div id="search-ajax"></div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
                <div style="padding: 10px;">
                    <!-- <table>
                        <tr>
                            <th style="text-align:center">Mã SP</th>
                            <th style="text-align:center">Hình ảnh</th>
                            <th style="text-align:center">Tên sản phẩm</th>
                            <th style="text-align:center">Giá nhập</th>
                            <th style="text-align:center">Số lượng</th>
                            <th style="text-align:center">Xóa</th>
                        </tr>
                        <tr>

                            <td class="idsp" name='product_id' id="idsp" value="{{ old('product_id') }}" style="text-align:center; font-weight:600; font-size:larger; color:blue"> </td>
                            <td class="hasp" name='hasp' id="hasp" style="text-align:center; font-weight:600; font-size:larger; color:blue"> </td>
                            <td class="tensp" name='tensp' id="tensp" style="text-align:center; font-weight:600; font-size:larger; color:blue"> </td>

                            <td style="text-align:center">
                                <input type="number" id="ctpn_gianhap" name="ctpn_gianhap" value="{{ old('ctpn_gianhap') }}" style="width: 150px;">
                            </td>

                            <td style="text-align:center">
                                <input type="number" id="ctpn_soluong" name="ctpn_soluong" value="{{ old('ctpn_soluong') }}" style="width: 80px;">
                            </td>
                            <td style="text-align:center">
                                <a href="#" class="btn btn-danger btn-sm" onclick="removeRow( )">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" style="text-align: end; color:red; font-weight:700">Tổng tiền: </td>
                            <td style="text-align: center">Tổng số lượng</td>
                            <td></td>
                        </tr>

                    </table> -->



                    <div class="card">
                        <table class="table table-bordered" id="product-table">
                            <thead style="text-align: center;">
                                <tr role="row" style="background-color: #1E90FF; color: white">
                                    <th>Mã sản phẩm</th>
                                    <th>Tên sản phẩm</th>
                                    <!-- <th>Hình ảnh</th> -->
                                    <th>Giá nhập</th>
                                    <th>Số lượng</th>
                                    <th>Tùy biến</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                        <!-- Tổng số lượng -->
                        <div style="text-align: right; font-weight: bold;">
                            Tổng số lượng:
                            <span id="total-quantity">0</span>
                            <input type="hidden" name="ctpn_soluong" id="ctpn_soluong">
                        </div>

                        <!-- Tổng tiền -->
                        <div style="text-align: right; font-weight: bold;">
                            Tổng tiền:
                            <span id="total-price">0</span>
                            <input type="hidden" name="pn_tongtiennhap" id="pn_tongtiennhap">
                        </div>
                    </div>




                </div>
            </div>
        </div>
    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Thêm phiếu nhập</button>
    </div>
    @csrf
</form>
@endsection

@section('footer')
<script>
    CKEDITOR.replace('content');
</script>


<!--********************TÌM KIẾM AUTOCOMPLETE**********************-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<!-- <script type="text/javascript">
    $('#keywords').keyup(function() {
        var query = $(this).val();
        if (query != '') {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{url('admin/warehouses/autocomplete_ajax')}}",
                method: "POST",
                data: {
                    query: query,
                    token: _token
                },
                success: function(data) {
                    $('#search_ajax').fadeIn();
                    $('#search_ajax').html(data);
                }
            });
        } else {
            $('#search_ajax').fadeOut();
        }

    });
    $(document).on('click', 'li', function() {
        $('#keywords').val($(this).text());
        $('#search_ajax').fadeOut();
    });
</script>



<script type="text/javascript">
    document.getElementById("get").onclick = function() {
        getProduct()
    };

    function getProduct() {
        var query = $(".warehouse").val();
        var _token = $('input[name="_token"]').val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{url('admin/warehouses/getProductName')}}",
            method: "GET",
            data: {
                query: query,
                token: _token
            },
            success: function(data) {
                $('#tensp').html(data);
            }
        });

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{url('admin/warehouses/getProductId')}}",
            method: "GET",
            data: {
                query: query,
                token: _token
            },
            success: function(data) {
                $('#idsp').html(data);
            }
        });

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{url('admin/warehouses/getProductImage')}}",
            method: "GET",
            data: {
                query: query,
                token: _token
            },
            success: function(data) {
                $('#hasp').html(data);
            }
        });

    }
</script> -->




<!-- Timf kiếm AJAX -->
<!-- <script>
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
</script> -->


<script type="text/javascript">
    $('#keywords').keyup(function() {
        var query = $(this).val();
        // alert(query);
        if (query != '') {
            var _token = $('input[name="_token"]').val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{url('admin/warehouses/autocomplete_ajax')}}",
                method: "POST",
                data: {
                    query: query,
                    _token: _token
                },
                success: function(data) {
                    $('#search-ajax').fadeIn();
                    $('#search-ajax').html(data);
                }
            });
            // alert(query);
        } else {
            $('#search-ajax').fadeOut();
        }
    });

    $(document).on('click', 'li', function() {
        $('#keywords').val($(this).text());
        $('#search-ajax').fadeOut();
    });

    var inputField = $('#keywords');

    var clearButton = $('#clear-input'); // Nút xóa nội dung
    // Bắt sự kiện khi nút xóa nội dung được bấm
    clearButton.on('click', function() {
        inputField.val(''); // Xóa nội dung trường nhập liệu
    });


    $(document).ready(function() {
        // Biến để lưu trữ tổng số lượng và tổng tiền
        var totalQuantity = 0;
        var totalPrice = 0;

        // Hàm để cập nhật tổng số lượng và tổng tiền
        function updateTotals() {
            totalQuantity = 0;
            //totalPrice = 0;

            // Duyệt qua từng sản phẩm trong bảng và tính tổng
            $('#product-table tbody tr').each(function() {
                var quantity = parseInt($(this).find('.quantity-input').val());
                //alert(quantity);
                if (!isNaN(quantity) && quantity >= 1) {
                    totalQuantity += quantity;
                }
            });

            // Cập nhật giá trị vào bảng
            $('#total-quantity').text(totalQuantity);
            //$('#total-price').text(new Intl.NumberFormat('vi-VN').format(totalPrice));

            // Cập nhật giá trị của các trường ctpn_soluong và pn_tongtiennhap
            $('[name="ctpn_soluong"]').val(totalQuantity);
            $('[name="pn_tongtiennhap"]').val(totalPrice);
        }

        // Bắt sự kiện khi nút "Thêm" được bấm
        $(document).on('click', '.btn-add-product', function() {
            var productId = $(this).data('product-id');
            var productName = $(this).data('product-name');
            // var productImage = $(this).data('product-image');
            // var imageUrl = "{{ url('/storage/images/products/') }}" + '/' + productImage;

            // Kiểm tra xem sản phẩm đã có trong bảng chưa
            var $existingRow = $('#product-table tbody').find('[data-product-id="' + productId + '"]');

            if ($existingRow.length > 0) {
                // Sản phẩm đã có trong bảng, tăng số lượng
                var $quantityInput = $existingRow.find('.quantity-input');
                var currentQuantity = parseInt($quantityInput.val());
                $quantityInput.val(currentQuantity + 1);
            } else {
                // Sản phẩm chưa có trong bảng, thêm dòng mới
                var newRow = '<tr data-product-id="' + productId + '">' +
                    '<td style="text-align: center;">#' + productId + '</td>' +
                    '<td style="text-align: center;">' + productName + '</td>' +
                    // '<td style="text-align: center;">' +
                    // '<a><img src="' + imageUrl + '" height="40px"></a>' +
                    // '</td>' +
                    '<td style="text-align: center;"><input type="text" autocomplete="off" required class="price-input" style="width: 80px" name="product_price[' + productId + ']" value=""></td>' +
                    '<td style="text-align: center;"><input type="number" style="width: 40px" class="quantity-input" name="product_quantity[' + productId + ']" value="1" min="1"></td>' +
                    '<td style="text-align: center;">' +
                    '<button type="button" class="btn btn-primary btn-update-product" data-product-id="' + productId + '">Cập nhật</button>' +
                    '<span style="margin: 0 5px;"></span>' + // Khoảng cách giữa nút
                    '<button class="btn btn-danger btn-remove-product" data-product-id="' + productId + '">Xóa</button>' +
                    '</td>' +
                    '</tr>';

                $('#product-table tbody').append(newRow);
            }

            // Cập nhật tổng số lượng và tổng tiền
            updateTotals();

        });

        // Hàm định dạng số thành tiền tệ Việt Nam (VND)
        function formatCurrency(number) {
            return new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }).format(number);
        }


        // Bắt sự kiện khi người dùng thay đổi giá trị trường nhập liệu
        $(document).on('input', '.price-input', function() {
            // Lấy giá trị nhập liệu từ trường nhập liệu
            var inputValue = $(this).val();

            // Loại bỏ tất cả dấu phẩy và dấu chấm
            var numericValue = inputValue.replace(/[,\.]/g, '');

            // Chuyển đổi giá trị thành số
            var numericPrice = parseFloat(numericValue);

            // Kiểm tra xem số lượng có hợp lệ hay không
            if (!isNaN(numericPrice) && numericPrice >= 0) {
                // Lấy số lượng của sản phẩm
                var $quantityInput = $(this).closest('tr').find('.quantity-input');
                var quantity = parseInt($quantityInput.val());

                // Kiểm tra xem số lượng có hợp lệ hay không
                if (!isNaN(quantity) && quantity >= 1) {
                    // Tính toán tổng tiền cho sản phẩm
                    var totalProductPrice = numericPrice * quantity;

                    // Cập nhật giá trị đã định dạng vào trường giá nhập
                    $(this).val(new Intl.NumberFormat('vi-VN').format(numericPrice));

                    // Cập nhật tổng tiền cho sản phẩm
                    var $totalProductPrice = $(this).closest('tr').find('.total-product-price');
                    $totalProductPrice.text(new Intl.NumberFormat('vi-VN').format(totalProductPrice));
                    //alert(totalProductPrice);
                    //$('#total-price').text(formatCurrency(totalProductPrice));
                    updateTotal();
                    // Cập nhật tổng tiền toàn bộ
                    updateTotal();
                }
            }
        });

        // Hàm để cập nhật tổng tiền và tổng số lượng
        function updateTotal() {
            totalQuantity = 0;
            totalPrice = 0;

            // Duyệt qua từng sản phẩm trong bảng và tính tổng
            $('#product-table tbody tr').each(function() {
                var quantity = parseInt($(this).find('.quantity-input').val());
                var price = parseFloat($(this).find('.price-input').val().replace(/[,\.]/g, '').replace(/[^0-9\.]/g, ''));

                if (!isNaN(quantity) && quantity >= 1 && !isNaN(price) && price >= 0) {
                    totalQuantity += quantity;
                    totalPrice += price * quantity;
                }
            });

            // Cập nhật giá trị vào bảng
            $('#total-quantity').text(totalQuantity);
            $('#total-price').text(new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }).format(totalPrice));
            // $('#total-price').text(new Intl.NumberFormat('vi-VN').format(totalPrice));

            // Cập nhật giá trị của các trường ctpn_soluong và pn_tongtiennhap
            $('[name="ctpn_soluong"]').val(totalQuantity);
            $('[name="pn_tongtiennhap"]').val(totalPrice);
        }

        // Bắt sự kiện khi nút "Xóa" trên bảng sản phẩm được bấm
        $(document).on('click', '.btn-remove-product', function() {
            var productId = $(this).data('product-id');
            // Xóa dòng sản phẩm khỏi bảng
            alert('Bạn có chắc chắn xóa sản phẩm');
            $('#product-table tbody').find('[data-product-id="' + productId + '"]').remove();

            updateTotal();
            // Cập nhật tổng tiền toàn bộ
            updateTotal();
        });

        // Bắt sự kiện khi nút "Cập nhật" trên bảng sản phẩm được bấm
        $(document).on('click', '.btn-update-product', function() {
            var productId = $(this).data('product-id');
            var productName = $(this).data('product-name');
            var $quantityInput = $('[data-product-id="' + productId + '"]').find('input[name^="product_quantity"]');
            // Lấy giá trị số lượng từ trường nhập liệu
            var newQuantity = parseInt($quantityInput.val());

            updateTotal();
            // Cập nhật tổng tiền toàn bộ
            updateTotal();

            // Kiểm tra giá trị số lượng mới và thực hiện các thao tác cập nhật dựa trên nó
            if (!isNaN(newQuantity) && newQuantity >= 1) {
                // Thực hiện các thao tác cập nhật ở đây
                // Ví dụ: có thể gửi dữ liệu cập nhật lên máy chủ thông qua AJAX
                alert('Đã cập nhật số lượng sản phẩm thành công');
            } else {
                alert('Số lượng không hợp lệ.');
            }


        });
    });
</script>

@endsection