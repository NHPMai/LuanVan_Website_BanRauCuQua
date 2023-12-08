<style>
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

<header class="header-v2">
    @php $menusHtml = \App\Helpers\Helper::menus($menus); @endphp
    <!-- Header desktop -->
    <div class="container-menu-desktop trans-03">

        <div class="top-bar">
            <div class="content-topbar flex-sb-m h-full container">
                <div class="left-top-bar">

                    <div class=" flex-w h-full">
                        <a class="flex-c-m trans-04 p-lr-25">
                            SĐt +84012345678
                        </a>

                        <a class="flex-c-m  p-lr-25">
                            Vegetablefamily@gmail.com
                        </a>

                    </div>
                </div>

                <div class="right-top-bar flex-w h-full p-l-280">
                    <a href="{{URL::to('/user/order-detail')}}" class="flex-c-m trans-04 p-lr-25">
                        Giỏ hàng
                    </a>


                    <a href="{{URL::to('/user/order_history')}}" class="flex-c-m trans-04 p-lr-25">
                        Lịch sử đặt hàng
                    </a>

                    @if (Auth::check())
                    <a href="{{URL::to('/user/account')}}" class="flex-c-m trans-04 p-lr-25">
                        Tài khoản
                    </a>
                    @else
                    <a href="{{asset('user/login')}}" class="flex-c-m trans-04 p-lr-25">
                        Đăng nhập
                    </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="wrap-menu-desktop">

            <nav class="limiter-menu-desktop container">
                <a href="#" class="logo">
                    <img src="/template/images/icons/logo2.png" alt="IMG-LOGO">
                </a>

                <!-- <div class="menu-desktop">
                    <ul class="main-menu">
                        <li class="active-menu"><a href="/">Trang Chủ</a> </li>

                        {!! $menusHtml !!}

                        <li class="active-menu"><a href="#">Giới Thiệu</a> </li>

                        <li>
                            <a href="{{asset('danh-muc/contact')}}" class="nav-link">Liên Hệ</a>
                        </li>
                    </ul>
                </div> -->


                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li class="active-menu">
                            <a href="/">Trang chủ</a>
                        </li>

                        <li class="label1" data-label1="hot">
                            @if(Auth::check())
                            <a href="shop">Sản phẩm</a>
                            @else
                            <a href="user/shop">Sản phẩm</a>
                            @endif
                        </li>

                        <li>
                            @if(Auth::check())
                            <a href="about">Giới thiệu</a>
                            @else
                            <a href="user/about">Giới thiệu</a>
                            @endif
                        </li>

                        <li>
                            <a href="about.html">Tin tức</a>
                        </li>

                        <li>
                            <a href="contact.html">Liên hệ</a>
                        </li>
                    </ul>
                </div>


                <!-- Search product -->

                <div class="wrap-icon-header flex-w flex-r-m">
                    <!-- <form id="search-form" action="{{ url('/searchProductMicrophone')}}" class="d-flex" method="get">
                        <div class="btn btn-white input-group-text border-0" type="submit" id="">
                            <span class="microphone">
                                <i class="fas fa-microphone"></i>
                                <span class="recording-icon"></span>
                            </span>
                            <div style="display:none">
                                <input id="search-input" name="keywork" type="text">

                            </div>

                        </div>
                    </form>
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 ">

                        <form class="form-inline" action="{{ url('search') }}" method="get" style="width: 250px;">
                            <input id="keywords" class="mtext-110 cl2 size-114 plh2 p-r-15" type="search" name="query"  placeholder="Tìm Kiếm Sản Phâm">
                            <div id="search-ajax"></div>
                            <button type="submit" class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                                <i class="zmdi zmdi-search"></i>
                            </button>
                        </form>

                    </div> -->

                    <form id="search-form" action="{{ url('/searchProductMicrophone')}}" class="d-flex" method="get">
                        <div class="btn btn-white input-group-text border-0" type="submit" id="">
                            <span class="microphone">
                                <i class="fas fa-microphone"></i>
                                <span class="recording-icon"></span>
                            </span>
                            <div style="display:none">
                                <input id="search-input" name="keywork" type="text">

                            </div>

                        </div>
                    </form>

                    <!-- <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 ">
                        <form class="form-inline" action="{{ url('search') }}" autocomplete="off" method="get" style="width: 250px;">
                            <div class="search_box">
                                <input type="text" id="keywords" class="mtext-110 cl2 size-114 plh2 p-r-15"  name="query" placeholder="Tìm Kiếm Sản Phâm">
                                <div id="search_ajax"></div>
                            </div>

                            <button type="submit" class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                                <i class="zmdi zmdi-search"></i>
                            </button>
                        </form>
                    </div> -->



                    <form class="navbar-form navbar-left form-search">
                        <div class="form-group">
                            <input type="text" class="form-control input-search-ajax" placeholder="Search">

                            <div class="search_ajax_result">

                            </div>
                        </div>
                    </form>

                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="{{ !is_null(\Session::get('chitietdonhangs')) ? count(\Session::get('chitietdonhangs')) : 0 }}">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>
                    <li class="nav-item menu-open">
                        <div class="btn-group">
                            <button type="button" class="btn btn-light btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                                <i class="fas fa-user"></i>
                            </button>

                            <div style="weight:215px" class="dropdown-menu" role="menu">

                                @if (Auth::check())
                                <a>{{ Auth('web')->user()->hoten }}</a>
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('user.logoutcustomer') }}" class="dropdown-item">
                                    Log Out
                                </a>

                                @else

                                <a href="{{asset('user/register')}}" class="dropdown-item">Đăng ký</a>
                                <a href="{{asset('user/login')}}" class="dropdown-item">Đăng nhập</a>

                                @endif

                            </div>
                        </div>
                    </li>
                </div>

            </nav>
        </div>
    </div>




    <!-- Modal Search -->
    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <div class="container-search-header">


            <form action="{{ url('search') }}" class="wrap-search-header flex-w p-l-15">
                <button type="submit" class="flex-c-m trans-04">
                    <i class="zmdi zmdi-search"></i>
                </button>
                <input class="plh3" type="search" name="query" placeholder="Search...">
            </form>
        </div>
    </div>

</header>


<!--********************TÌM KIẾM AJAX**********************-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
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


<!--********************TÌM KIẾM AUTOCOMPLETE**********************-->

<!-- <script type="text/javascript">
    $('#keywords').keyup(function() {
        var query = $(this).val();
        if (query != '') {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{url('/autocomplete_ajax')}}",
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
    })
</script> -->