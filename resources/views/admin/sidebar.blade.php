<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin" class="brand-link">
        <img src="/template/admin/dist/img/logoadmin.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Vegetables Family</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class=" mt-3 pb-3 mb-3 d-flex">
            <div class="image" >
                <!-- <img src="/template/admin/dist/img/logoadmin.png" class="img-circle elevation-2" alt="User Image"> -->
                <img src="{{ Auth('admin')->user()->avata }}" style="border-radius: 50%; border: 2px solid #a1a1a1;" height="100" width="100">
            </div>
            <div class="info" style="vertical-align: middle;margin-top: 40px; margin-left: 20px;">
                <a href="#" class="d-block" style="font-size: 25px; font-weight:700">{{ Auth('admin')->user()->hoten }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            @if (Auth('admin')->user()->email == 'admin@gmail.com')
                <li class="nav-item">
                    <a href="/admin" class="nav-link">
                        <i class="nav-icon fas fa-home" style="color:wheat;"></i>
                        <p> Trang Chủ </p>
                    </a>
                </li>

                <!-- Slider -->
                <li class="nav-item user-panel" style="border-bottom-width: 2px; border-bottom: 2px solid  #9a9ea3; margin-bottom:5px">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-images" style="color:white"></i>
                        <p> Quản Lý Slider
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/sliders/add" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm slider</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/sliders/list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách slider</p>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

                @php
                if (Auth::check()){

                //Lấy id của người dùng đăng nhập
                $id_nv = Auth('admin')->user()->id;

                //Tìm nhân viên tương ứng với id người dùng đăng nhập
                $nhanvien = App\Models\Nhanvien::find($id_nv);

                //Kiểm tra người dùng có tương ứng với nhân viên không
                if($nhanvien){
                //Nếu có lấy id của nhân viên để lấy quyền từ bảng chitietquyens
                $nhanvienId = $nhanvien->id;

                $permissions = DB::table('chitietquyens')
                ->join('quyens','chitietquyens.quyen_id', '=' , 'quyens.id')
                ->where('chitietquyens.nhanvien_id', $nhanvienId)
                ->where('chitietquyens.coquyen',1)
                ->select('quyens.tenchucvu')
                ->get();
                } else {

                }
                } else {

                }
                @endphp

                @foreach ($permissions as $permission)

                @if ($permission->tenchucvu =='Quyền đơn hàng')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cart-plus" style="color:chartreuse;"></i>
                        <p>Quản Lý Đơn Hàng
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/customers" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách đơn hàng</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/admin/coupons/list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Mã giảm giá</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <!-- Phí vận chuyển -->
                <li class="nav-item user-panel" style="border-bottom-width: 2px; border-bottom: 2px solid  #9a9ea3; margin-bottom:5px">
                    <a href="#" class="nav-link">
                        <i class="nav-icon 	fa fa-bus" style="color:yellow;"></i>
                        <p>Quản Lý Vận Chuyển
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/deliverys/add" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm phí vận chuyển</p>
                            </a>
                        </li>

                        <!-- <li class="nav-item">
                                    <a href="/admin/deliverys/list" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Phí vận chuyển</p>
                                    </a>
                                </li> -->

                    </ul>
                </li>

                @elseif ($permission->tenchucvu == 'Quyền sản phẩm')
                <!-- Danh Mục -->
                <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-bars" style="color:coral;"></i>
                        <p> Danh Mục Sản Phẩm
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/menus/add" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm danh mục</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/menus/list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách danh mục</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <!-- Thương Hiệu -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book-open" style="color:hotpink;"></i>
                        <p>Quản Lý Thương Hiệu
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/brands/add" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm thương hiệu</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/brands/list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách thương tiệu</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Sản Phẩm -->
                <li class="nav-item " >
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-carrot" style="color:orange;"></i>
                        <p>Quản Lý Sản Phẩm
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/products/add" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm sản phẩm</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/products/list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách sản phẩm</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Quản lí bình luận -->
                <li class="nav-item user-panel" style="border-bottom-width: 2px; border-bottom: 2px solid  #9a9ea3; margin-bottom:5px">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-carrot" style="color:orange;"></i>
                        <p>Quản Lý Bình Luận
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/products/list_comment" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Liệt kê bình luận</p>
                            </a>
                        </li>
                    </ul>
                </li>



                @elseif ($permission->tenchucvu == 'Quyền nhân sự')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon 	fas fa-user-cog" style="color:deepskyblue;"></i>
                        <p> Quản Lý Nhân Viên
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/staffs/add" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm nhân viên</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/staffs/list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách thành viên</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/staffs/permission" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Phân quyền nhân viên</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon 	fas fa-user-friends" style="color:dodgerblue;"></i>
                        <p> Quản Lý Khách Hàng
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/clients/add" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm khách hàng</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/clients/list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách khách hàng</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item user-panel" style="border-bottom-width: 2px; border-bottom: 2px solid  #9a9ea3; margin-bottom:5px">
                    <a href="#" class="nav-link">
                        <i class="nav-icon 		fas fa-biking" style="color:red;"></i>
                        <p> Quản Lý Giao Hàng
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/shippers/add" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm giao hàng</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/shippers/list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh Sách giao hàng</p>
                            </a>
                        </li>
                    </ul>
                </li>

                @elseif ($permission->tenchucvu == 'Quyền bài viết')


                @elseif ($permission->tenchucvu == 'Quyền kho hàng')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-arrows-alt-v" style="color: greenyellow;"></i>
                        <p>Quản Lý Phiếu Nhập
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/warehouses/add" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm Phiếu Nhập</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/warehouses/list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh Sách Phiếu Nhập</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <!-- NHÀ CUNG CẤP -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-building" style="color:gold"></i>
                        <p>Quản Lý Nhà Cung Cấp
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/suppliers/add" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm Nhà Cung Cấp</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/suppliers/list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh Sách Nhà Cung Cấp</p>
                            </a>
                        </li>
                    </ul>
                </li>


                @endif

                @endforeach












                <!-- Phiếu Nhập -->







                <!-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p> Báo Cáo Thống Kê
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/products/add" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thống Kê Doanh Thu</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/products/list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thống Kê Số Lượng Hàng Hóa</p>
                            </a>
                        </li>

                    </ul>
                </li> -->

                <!-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p> Khách Hàng
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/customers" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh Sách Người Dùng</p>
                            </a>
                        </li>

                    </ul>
                </li> -->



            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>