<!-- jQuery -->
<script src="/template/admin/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/template/admin/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="/template/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="/template/admin/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="/template/admin/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="/template/admin/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="/template/admin/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="/template/admin/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="/template/admin/plugins/moment/moment.min.js"></script>
<script src="/template/admin/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/template/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="/template/admin/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="/template/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/template/admin/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/template/admin/dist/js/pages/dashboard.js"></script>
<!-- select2 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>


<script src="/template/admin/js/main.js"></script>

<!-- DIACHI -->
<script type="text/javascript">
    $(document).ready(function(){

        //LẤY DỮ LIỆU
        fecth_delivery();
        function fecth_delivery(){
            var _token = $('input[name="_token"]').val(); 
            $.ajax({
                url:"{{url('/admin/deliverys/select_feeship')}}",
                method: "POST",
                data:{_token:_token},
                success:function(data){
                    $('#load_delivery').html(data);
                }
            });
        }

        //UPDATE
        $(document).on('blur','.fee_feeship_edit',function(){

            var feeship_id = $(this).data('feeship_id');
            var fee_value = $(this).text();
            var _token = $('input[name="_token"]').val(); 
            // alert(feeship_id);
            // alert(fee_value);
            $.ajax({
                url:"{{url('/admin/deliverys/update_delivery')}}",
                method: "POST",
                data:{feeship_id:feeship_id,fee_value:fee_value,_token:_token},
                success:function(data){
                    alert ('Đã chỉnh sửa phí vân chuyển thành công!')
                    fecth_delivery();
                }
            });
        });

        // THÊM PHÍ VẬN CHUYỂN
        $('.add_delivery').click(function(){
            var tinh_thanhpho = $('.tinh_thanhpho').val();
            var quan_huyen = $('.quan_huyen').val();
            var xa_phuong_thitran = $('.xa_phuong_thitran').val();
            var phivanchuyen = $('.phivanchuyen').val();
            var _token = $('input[name="_token"]').val();
            // alert (tinh_thanhpho);
            // alert (quan_huyen);
            // alert (xa_phuong_thitran);
            // alert (phivanchuyen);

            $.ajax({
                url:"{{url('/admin/deliverys/insert_delivery')}}",
                method: "POST",
                data:{tinh_thanhpho:tinh_thanhpho, quan_huyen:quan_huyen, xa_phuong_thitran:xa_phuong_thitran, phivanchuyen:phivanchuyen,_token:_token},
                success:function(data){
                    alert ('Thêm phí vân chuyển thành công!')
                    fecth_delivery();
                }
            });

        });

        $('.choose').on('change',function(){
            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var $result = '';
            // alert(action);
            //     alert(ma_id);
            //         alert(_token);
            if (action == 'tinh_thanhpho'){
                result = 'quan_huyen';
            } else {
                result = 'xa_phuong_thitran';
            }
            $.ajax({
                url:"{{url('/admin/deliverys/select_delivery')}}",
                method: "POST",
                data:{action:action, ma_id:ma_id,_token:_token},
                success:function(data){
                    $('#'+ result).html(data);
                }
            });
        });
    })
</script>

<!-- THONGKE -->
<!-- <script src="//code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>


<script type="text/javascript">
    $(document).ready(function (){
        chart30daysorder();
        var chart = new Morris.Bar({
            element: 'chart',
            lineColor: ['#819C79', '#FC8710','#FF6541','#A4ADD3','#766B56'],
            parseTime: false,
            hideHover:"auto",
            xkey: 'period',
            ykeys: ['order','sales','profit','quantity'],
            labels: ['đơn hàng','doanh số','lợi nhuận','số lượng']
        });

        function chart30daysorder(){
            var _token = $('input[name="_token"]').val();
            //alert('hi');
            //alert(_token);
            $.ajax({
                url:"{{url('/admin/days-order')}}",
                method: "POST",
                dataType:"JSON",
                data:{_token:_token},

                success:function (data) {
                    //console.log(data);
                    chart.setData(data);
                }
            });
        };

        $('.dashboard-filter').change(function () {
            var dashboard_value = $(this).val();
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: "{{url('/admin/dashboard-filter')}}",
                method: "POST",
                dataType: "JSON",
                data: { dashboard_value: dashboard_value, _token: _token },

                success: function (data) {
                    chart.setData(data);
                }
            });
        });

        $('#btn-dashboard-filter').click(function () {
            var _token = $('input[name="_token"]').val();
            // var from_date = $('#datepicker').val();
            // var to_date = $('#datepicker2').val();
            // Chuyển đổi ngày tháng từ MM/DD/YYYY sang YYYY-MM-DD
            var from_date = moment($('#datepicker').val(), 'MM/DD/YYYY').format('YYYY-MM-DD');
            var to_date = moment($('#datepicker2').val(), 'MM/DD/YYYY').format('YYYY-MM-DD');
            //alert(from_date);

            $.ajax({
                url: "{{url('/admin/filter-by-date')}}",
                method: "POST",
                dataType: "JSON",
                data: { from_date: from_date, to_date: to_date, _token: _token },

                success: function (data) {
                    chart.setData(data);
                }
            });
        });

    });
</script>

<script type="text/javascript">
    $(function() {
        $("#datepicker").datepicker({
            prevText: "Tháng trước",
            nextText: "Tháng sau",
            dataFormat: "yy-mm-dd",
            dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
            duration: "slow"
        });
        $("#datepicker2").datepicker({
            prevText: "Tháng trước",
            nextText: "Tháng sau",
            dataFormat: "yy-mm-dd",
            dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
            duration: "slow"
        });
    });
</script>

<!-- TIM KIEM GIONG NOIS -->
    <script type="text/javascript">
        var message = document.querySelector('#message');

        var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition;
        var SpeechGrammarList = SpeechGrammarList || webkitSpeechGrammarList;

        var grammar = '#JSGF V1.0;'

        var recognition = new SpeechRecognition();
        var speechRecognitionList = new SpeechGrammarList();
        speechRecognitionList.addFromString(grammar, 1);
        recognition.grammars = speechRecognitionList;
        recognition.lang = 'vi-VN';
        recognition.interimResult = false;

        recognition.continuous = true;
        recognition.onresult = function(event) {
            var lastResult = event.results.length - 1;
            var content = event.results[lastResult][0].transcript
            // console.log(content);
            document.getElementById('search-input').value = content;
            document.getElementById('search-form').submit();
        }

        recognition.onspeeched = function() {
            recognition.stop();
        }

        recognition.onerror = function() {
            console.log(event.error);
            const microphone = document.querySelector('.microphone');
            microphone.classList.remove('recording')
        }

        document.querySelector('.microphone').addEventListener('click', function() {
            recognition.start();
            const microphone = document.querySelector('.microphone');
            microphone.classList.add('recording');
        })
    </script>

<!-- SELECT2 -->
<script type="text/javascript">
    $('#productSelect').select2({
        templateResult: function(data){
            if(!data.id){
                return data.text;
            }
            var $template = $('<div class"product-option"></div>');
            $template.append(data.text);
            return $template;
        }
    });

    //khi người dùng mở custom select box
    $('#productSelect').on('select2:opening', function(e){
        $.ajax({
            url: "{{url('/admin/warehouses/getProducts')}}",
            method: "GET",
            success:function (data){
                //Xóa tất cả các tùy chọn hiện có trong select2
                $('#productSelect').empty();

                //Thêm tùy chọn mới vào selet2
                $('#productSelect').append(data);
            }
        })
    });

    $(document).ready(function(){
        //biến để lưu trữ tổng số lượng và tổng tiền
        var totalQuantity = 0;
        var totalPrice = 0;

        //Hàm để cập nhật tổng số lượng và tổng tiền
        function updateTotals(){
            totalQuantity = 0;

            //Duyệt qua từng sản phẩm trong bản và tính tổng
            $('#product-table tbody tr').each(function(){
                var quantity = parseInt($(this).find('.quantity-input').val());

                if(!isNaN(quantity) && quantity>=1){
                    totalQuantity +=quantity;
                }
            });

            //Cập nhật giá trị vào bảng
            $('#total-quantity').text(totalQuantity);

            //Cập nhật giá trị của các trường ctpn_soluongnhap và pnn_tongtien
            $('[name="ctpn_soluong"]').val(totalQuantity);
            $('[name="pn_tongtiennhap"]').val(totalPrice);
        }
    })

    var selectProductPrice;
    $('#productSelect').on('select2.select', function(e){
        var selectProduct = e.params.data;
        //Lấy giá sản phẩm
        selectProductPrice = parseFloat(selectProduct.element.getAttribute('data-price'));
        //Lấy tên sản phẩm 
        var productName = selectProduct.text.split(' - ')[1].trim();

        var productImage = selectProduct.element.getAttribute('data-image');

        //kiểm tra xem sản phẩm có trg bảng chưa
        var $existingRow = $('#product-table tbody').find('[data-product-id]');

        if($existingRow, length >0){
            //sản phẩm đã có trong bảng, tăng số lượng
            var $quantityInput = $existingRow.find('.quantity-input');
        } else{
            //dữ liệu chưa có trong bảng, thêm dòng mới
            var newRow = 'tr data-product-id="' +selectProduct.id + '">'
                '<td style="text-align: center;">#' +selectProduct.id
        }
    })
</script>
@yield('footer')