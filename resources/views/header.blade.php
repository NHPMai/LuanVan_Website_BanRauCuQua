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
                    <!-- <a href="#" class="flex-c-m trans-04 p-lr-25">
                       Giỏ hàng
                    </a> -->

                    <?php
                    $khachhang_id = Session('khachhang_id');
                    // echo $khachhang_id;
                    $chitietdonhang_id = Session('chitietdonhang_id');
                    if ($khachhang_id != NULL && $donhang_id == NULL) {
                    ?>
                        <li>
                            <a href="{{URL::to('/checkout')}}" class="flex-c-m trans-04 p-lr-25">
                                Giỏ hàng
                            </a>
                        </li>

                    <?php
                    } elseif ($khachhang_id != NULL && $donhang_id != NULL) {
                    ?>
                        <li>
                            <a href="{{URL::to('/adddonhang')}}" class="flex-c-m trans-04 p-lr-25">
                                Giỏ hàng
                            </a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li>
                            <a href="{{URL::to('user/logincustomer')}}" class="flex-c-m trans-04 p-lr-25">
                                Giỏ hàng
                            </a>
                        </li>
                    <?php
                    }
                    ?>

                    <a href="{{URL::to('/user/order_history')}}" class="flex-c-m trans-04 p-lr-25">
                        Lịch sử đặt hàng
                    </a>

                    <a href="{{URL::to('/user/account')}}" class="flex-c-m trans-04 p-lr-25">
                        Tài khoản
                    </a>

                    <a href="#" class="flex-c-m trans-04 p-lr-25">
                        Đăng nhập
                    </a>
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
                            <a href="/">Home</a>
                        </li>

                        <li>
                            <a href="product.html">Shop</a>
                        </li>

                        <li class="label1" data-label1="hot">
                            <a href="shoping-cart.html">Features</a>
                        </li>

                        <li>
                            <a href="blog.html">Blog</a>
                        </li>

                        <li>
                            <a href="about.html">About</a>
                        </li>

                        <li>
                            <a href="contact.html">Contact</a>
                        </li>
                    </ul>
                </div>




                <div class="wrap-icon-header flex-w flex-r-m">

                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="{{ !is_null(\Session::get('chitietdonhangs')) ? count(\Session::get('chitietdonhangs')) : 0 }}">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>
                    <li class="nav-item menu-open">
                        <div class="btn-group">
                            <button type="button" class="btn btn-light btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                                <i class="fas fa-user"></i>
                            </button>

                            <div class="dropdown-menu" role="menu">

                                @if (Auth::check())
                                <a>Xin chào {{ Auth('web')->user()->hoten }}</a>
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