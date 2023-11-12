<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin" class="brand-link">
        <img src="/template/admin/dist/img/logoadmin.png" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminMaiShop</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/template/admin/dist/img/logoadmin.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Phuong Mai</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                
                <li class="nav-item">
                    <a href="/admin" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p> Trang Chủ </p>
                    </a>
                </li>

                <!-- Slider -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-images"></i>
                        <p> Slider
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/sliders/add" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm Slider</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/sliders/list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh Sách Slider</p>
                            </a>
                        </li>
                    </ul>
                </li>

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
                                <i class="nav-icon fas fa-cart-plus"></i>
                                <p>Đơn hàng
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/admin/customers" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh Sách Đơn Hàng</p>
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
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-cart-plus"></i>
                                <p>Vận Chuyển
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
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-bars"></i>
                                <p> Danh Mục
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/admin/menus/add" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Thêm Danh Mục</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/menus/list" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh Sách Danh Mục</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <!-- Thương Hiệu -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-images"></i>
                                <p> Thương Hiệu
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/admin/brands/add" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Thêm Thương Hiệu</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/brands/list" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh Sách Thương Hiệu</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Sản Phẩm -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-store-alt"></i>
                                <p> Sản Phẩm
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/admin/products/add" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Thêm Sản Phẩm</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/products/list" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh Sách Sản Phẩm</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        

                        @elseif ($permission->tenchucvu == 'Quyền nhân sự')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon 	fas fa-user-circle"></i>
                                <p> Quản lí nhân viên
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
                                        <p>Danh Sách Thành Viên</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/staffs/permission" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Phân Quyền Nhân Viên</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        @elseif ($permission->tenchucvu == 'Quyền bài viết')
                            

                        @elseif ($permission->tenchucvu == 'Quyền kho hàng')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-arrows-alt-v"></i>
                                <p> Phiếu Nhập
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
                                <i class="nav-icon fas fa-images"></i>
                                <p> Nhà Cung Cấp
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