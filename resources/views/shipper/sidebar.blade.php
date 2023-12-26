<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin" class="brand-link">
        <img src="/template/admin/dist/img/logoadmin.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SHIPPER</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class=" mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <!-- <img src="/template/admin/dist/img/logoadmin.png" class="img-circle elevation-2" alt="User Image"> -->
                <img src="{{ Auth('shipper')->user()->gh_avatar }}" style="border-radius: 50%; border: 2px solid #a1a1a1;" height="100" width="100">
            </div>
            <div class="info" style="vertical-align: middle; margin-left: 20px;">
                <a href="#" class="d-block" style="font-size: 25px; font-weight:700">{{ Auth('shipper')->user()->gh_hoten }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cart-plus"></i>
                        <p>Danh Sách Đơn Hàng
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <!-- <ul class="nav nav-treeview"> -->
                <li class="nav-item">
                    <a href="/shipper/donhang_shipper" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Đơn Hàng Chờ</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/shipper/donhang_danggiao" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Đơn Hàng Đang Giao</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/shipper/donhang_dagiao" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Giao Hàng Thành Công</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/shipper/donhang_thatbai" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Giao Hàng Thất Bại</p>
                    </a>
                </li>

                <!-- </ul> -->
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>