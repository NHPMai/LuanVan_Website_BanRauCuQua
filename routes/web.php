<?php

use App\Http\Controllers\Admin\Nhanviens\LoginNhanvienController;
use App\Http\Controllers\Admin\Nhanviens\LogoutController;
use App\Http\Controllers\Admin\Nhanviens\NhanvienController;
use App\Http\Controllers\Users\LogincustomerController;
use App\Http\Controllers\Users\LogoutcustomerController;
use App\Http\Controllers\Users\PaypalController;


use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\CartController;
use App\Http\Controllers\Admin\MagiamgiaController;
use App\Http\Controllers\Admin\VanChuyenController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\Users\KhachhangController;
use App\Http\Controllers\Admin\WarehouseController;


use App\Http\Controllers\Shipper\ShipperController;
use App\Models\Nhanvien;
use App\Models\Product;
use App\Models\Role;

use Illuminate\Support\Facades\Route;



//--------------------ADMIN---------------------//

Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware(['guest:admin'])->group(function () {
        Route::get('/login', [LoginNhanvienController::class, 'index'])->name('login');
        Route::post('/store', [LoginNhanvienController::class, 'store'])->name('store');
    });

    //ADMIN - ĐÃ ĐĂNG NHẬP
    Route::middleware(['auth:admin'])->group(function () {

        Route::get('/', [MainController::class, 'index'])->name('home');
        Route::get('/main', [MainController::class, 'index'])->name('main');

        #TÌM KIẾM GIỌNG NÓI_SẢN PHẨM
        Route::get('/searchProductMicrophone', [ProductController::class, 'searchProductMicrophone']);

        Route::get('/search', [ProductController::class, 'search']);   //Tim kiem spadmin


        #TÌM KIẾM GIỌNG NÓI_ĐƠN HÀNG
        Route::get('/searchProductMicrophonedonhang', [CartController::class, 'searchProductMicrophonedonhang']);
        Route::get('/searchdonhang', [CartController::class, 'searchdonhang']);   //Tim kiem spadmin

        //ĐĂNG XUẤT ADMIN
        Route::get('/logout', [LogoutController::class, 'logout'])->name('logout'); //Dang Xuat


        // # Khách Hàng
        Route::prefix('clients')->group(function () {
            Route::get('add', [KhachhangController::class, 'create']);
            Route::post('add', [KhachhangController::class, 'store']);
            Route::get('list', [KhachhangController::class, 'index']);
            Route::get('edit/{client}', [KhachhangController::class, 'show']);
            Route::post('edit/{client}', [KhachhangController::class, 'update']);
            Route::DELETE('destroy', [KhachhangController::class, 'destroy']);
        });

        #Nhân viên
        Route::prefix('staffs')->group(function () {
            Route::get('add', [NhanvienController::class, 'create']);
            Route::post('add', [NhanvienController::class, 'store']);
            Route::get('list', [NhanvienController::class, 'index']);
            Route::get('edit/{staff}', [NhanvienController::class, 'show']);
            Route::post('edit/{staff}', [NhanvienController::class, 'update']);
            Route::DELETE('destroy', [NhanvienController::class, 'destroy']);

            Route::get('permission', [NhanvienController::class, 'permission']);
            Route::get('edit_permission/{id}', [NhanvienController::class, 'edit_permission'])->name('admin.staffs.edit_permission');
            Route::get('coquyen/{id}', [NhanvienController::class, 'coquyen']);
            Route::get('khongquyen/{id}', [NhanvienController::class, 'khongquyen']);
        });

        // #Menu
        Route::prefix('menus')->group(function () {
            Route::get('add', [MenuController::class, 'create']);
            Route::post('add', [MenuController::class, 'store']);
            Route::get('list', [MenuController::class, 'index']);
            Route::get('edit/{menu}', [MenuController::class, 'show']);
            Route::post('edit/{menu}', [MenuController::class, 'update']);
            Route::DELETE('destroy', [MenuController::class, 'destroy']);
        });

        // #Bài viết
        // Route::prefix('menus')->group(function () {
        //     Route::get('add', [MenuController::class, 'create']);
        //     Route::post('add', [MenuController::class, 'store']);
        //     Route::get('list', [MenuController::class, 'index']);
        //     Route::get('edit/{menu}', [MenuController::class, 'show']);
        //     Route::post('edit/{menu}', [MenuController::class, 'update']);
        //     Route::DELETE('destroy', [MenuController::class, 'destroy']);
        // });

        #Brand
        Route::prefix('brands')->group(function () {
            Route::get('add', [BrandController::class, 'create']);
            Route::post('add', [BrandController::class, 'store']);
            Route::get('list', [BrandController::class, 'index']);
            Route::get('edit/{brand}', [BrandController::class, 'show']);
            Route::post('edit/{brand}', [BrandController::class, 'update']);
            Route::DELETE('destroy', [BrandController::class, 'destroy']);
        });

        #Product
        Route::prefix('products')->group(function () {
            Route::get('add', [ProductController::class, 'create']);
            Route::post('add', [ProductController::class, 'store']);
            Route::get('list', [ProductController::class, 'index']);
            Route::get('edit/{product}', [ProductController::class, 'show']);
            Route::post('edit/{product}', [ProductController::class, 'update']);
            Route::DELETE('destroy', [ProductController::class, 'destroy']);
        });

        // #Nha Cung Cap
        Route::prefix('suppliers')->group(function () {
            Route::get('add', [SupplierController::class, 'create']);
            Route::post('add', [SupplierController::class, 'store']);
            Route::get('list', [SupplierController::class, 'index']);
            Route::get('edit/{supplier}', [SupplierController::class, 'show']);
            Route::post('edit/{supplier}', [SupplierController::class, 'update']);
            Route::DELETE('destroy', [SupplierController::class, 'destroy']);
        });


        #Slider
        Route::prefix('sliders')->group(function () {
            Route::get('add', [SliderController::class, 'create']);
            Route::post('add', [SliderController::class, 'store']);
            Route::get('list', [SliderController::class, 'index']);
            Route::get('edit/{slider}', [SliderController::class, 'show']);
            Route::post('edit/{slider}', [SliderController::class, 'update']);
            Route::DELETE('destroy', [SliderController::class, 'destroy']);
        });

        #Phiếu Nhập
        Route::prefix('warehouses')->group(function () {
            Route::get('getProducts', [WarehouseController::class, 'getProducts']);
            Route::get('add', [WarehouseController::class, 'create']);
            Route::post('add', [WarehouseController::class, 'store']);
            Route::get('list', [WarehouseController::class, 'index']);
            Route::get('view/{phieunhap}', [WarehouseController::class, 'show']);
            Route::get('active/{id}', [WarehouseController::class, 'active']);
            Route::DELETE('destroy', [WarehouseController::class, 'destroy']);

            Route::post('/autocomplete_ajax', [WarehouseController::class, 'autocomplete_ajax']);
            Route::get('/getProductName', [WarehouseController::class, 'getProductName']);
            Route::get('/getProductId', [WarehouseController::class, 'getProductId']);
            Route::get('/getProductImage', [WarehouseController::class, 'getProductImage']);


            Route::get('/search', [App\Http\Controllers\WarehouseController::class, 'search']);
        });


        // ##Upload
        Route::post('upload/services', [\App\Http\Controllers\Admin\UploadController::class, 'store']);

        # QUẢN LÍ ĐƠN HÀNG
        Route::get('customers', [\App\Http\Controllers\Admin\CartController::class, 'index']);
        Route::get('customers/view/{donhang}', [\App\Http\Controllers\Admin\CartController::class, 'show']);
        Route::post('customers/view/{donhang}', [\App\Http\Controllers\Admin\CartController::class, 'update'])->name('donhang.update');
        Route::post('customers/{donhang}', [\App\Http\Controllers\Admin\CartController::class, 'update']);
        Route::DELETE('destroy', [\App\Http\Controllers\Admin\CartController::class, 'destroy']);

        # MÃ GIẢM GIÁ
        Route::prefix('coupons')->group(function () {
            Route::get('list', [MagiamgiaController::class, 'index']);
            Route::get('add', [MagiamgiaController::class, 'create']);
            Route::post('add', [MagiamgiaController::class, 'store']);
            Route::get('edit/{magiamgia}', [MagiamgiaController::class, 'show']);
            Route::post('edit/{magiamgia}', [MagiamgiaController::class, 'update']);
            Route::DELETE('destroy', [MagiamgiaController::class, 'destroy']);
        });

        # PHÍ VẬN CHUYỂN - AJAX
        Route::prefix('deliverys')->group(function () {
            Route::get('list', [VanChuyenController::class, 'index']);
            Route::get('add', [VanChuyenController::class, 'add']);
            Route::post('select_delivery', [VanChuyenController::class, 'select_delivery']); //Chọn thành phố
            Route::post('insert_delivery', [VanChuyenController::class, 'insert_delivery']); //Thêm vào danh sách feeship
            Route::post('select_feeship', [VanChuyenController::class, 'select_feeship']);
            Route::post('update_delivery', [VanChuyenController::class, 'update_delivery']);
            // Route::get('edit/{magiamgia}', [MagiamgiaController::class, 'show']);
            // Route::post('edit/{magiamgia}', [MagiamgiaController::class, 'update']);
            // Route::DELETE('destroy', [MagiamgiaController::class, 'destroy']);
        });

        #THỐNG KÊ
        Route::post('/days-order', [MainController::class, 'days_order']);
        Route::post('/dashboard-filter', [MainController::class, 'dashboard_filter']);
        Route::post('/filter-by-date', [MainController::class, 'filter_by_date']);
    });
});



//--------------------SHIPPER---------------------//

Route::prefix('shipper')->name('shipper.')->group(function () {

    Route::middleware(['guest:shipper'])->group(function () {
        Route::get('/login', [ShipperController::class, 'index'])->name('login');
        Route::post('/store', [ShipperController::class, 'store'])->name('store');
    });

    //SHIPPER - ĐÃ ĐĂNG NHẬP
    Route::middleware(['auth:shipper'])->group(function () {

        Route::get('/', [ShipperController::class, 'home'])->name('home');
        // Route::get('/main', [ShipperController::class, 'index'])->name('main');
        Route::get('donhang_shipper', [ShipperController::class, 'donhang_shipper']);
        Route::get('donhang_dagiao', [ShipperController::class, 'donhang_dagiao']);
        Route::get('donhang_danggiao', [ShipperController::class, 'donhang_danggiao']);
        Route::get('customers/view/{donhang}', [ShipperController::class, 'show']);
        Route::post('customers/view/{donhang}', [ShipperController::class, 'update'])->name('update');

        #TÌM KIẾM GIỌNG NÓI_SẢN PHẨM
        // Route::get('/searchProductMicrophone', [ProductController::class, 'searchProductMicrophone']);
        // Route::get('/search', [ProductController::class, 'search']);   //Tim kiem spadmin

        //ĐĂNG XUẤT ADMIN
        Route::get('/logout', [ShipperController::class, 'logout'])->name('logout'); //Dang Xuat
    });
});



//---------------------USER--------------------------//

Route::prefix('user')->name('user.')->group(function () {

    //KHÁCH HÀNG KHÔNG CÓA TÀI KHOẢN
    Route::middleware(['guest:web'])->group(function () {
        //Đăng kí
        // Route::view('/login','user.logincustomer')->name('login');
        Route::get('/register', [LogincustomerController::class, 'register']);
        Route::post('/create', [LogincustomerController::class, 'sign_up'])->name('create');
        // Route::post('/diachi', [LogincustomerController::class, 'diachi'])->name('diachi'); //Chọn nơi vận chuyển
        // Route::post('/laydiachi', [LogincustomerController::class, 'laydiachi'])->name('laydiachi'); //Chọn nơi vận chuyển

        //Đăng nhập
        Route::get('/login', [LogincustomerController::class, 'index'])->name('login');
        Route::post('/store', [LogincustomerController::class, 'store'])->name('store');
    });

    //KHÁCH HÀNG CÓ TÀI KHOẢN
    Route::middleware(['auth:web'])->group(function () {

        Route::get('/', [App\Http\Controllers\MainController::class, 'index'])->name('home'); //Trang Home
        Route::get('/logoutcustomer', [LogoutcustomerController::class, 'logoutcustomer'])->name('logoutcustomer'); //Dang Xuat

        //đơn hàng
        Route::post('add-order-detail', [App\Http\Controllers\Users\DonhangController::class, 'index'])->name('add-order-detail');
        Route::get('order-detail', [App\Http\Controllers\Users\DonhangController::class, 'show'])->name('order-detail');
        Route::post('update-order-detail', [App\Http\Controllers\Users\DonhangController::class, 'update'])->name('update-order-detail');
        Route::get('order-detail/delete/{id}', [App\Http\Controllers\Users\DonhangController::class, 'remove'])->name('remove');
        Route::get('delete_all', [App\Http\Controllers\Users\DonhangController::class, 'delete_all'])->name('delete_all');

        //-------------------------MÃ GIẢM GIÁ------------------------------------\\

        Route::post('check_coupon', [App\Http\Controllers\Users\DonhangController::class, 'check_coupon'])->name('check_coupon');   //Lấy mã giảm giá
        Route::get('delete_coupon', [App\Http\Controllers\Users\DonhangController::class, 'delete_coupon'])->name('delete_coupon'); //Xóa mã giảm giá

        //Phi van chuyen
        Route::post('select_delivery_home', [App\Http\Controllers\Users\DonhangController::class, 'select_delivery_home'])->name('select_delivery_home'); //Chọn nơi vận chuyển
        Route::post('calculate_fee', [App\Http\Controllers\Users\DonhangController::class, 'calculate_fee'])->name('calculate_fee');  //Tính phí vận chuyển

        //---------------------THANH TOÁN KHI NHẬN HÀNG-----------------------------\\

        Route::get('checkout', [App\Http\Controllers\Users\DonhangController::class, 'showcheckout'])->name(name: 'showcheckout');
        Route::post('add_order', [App\Http\Controllers\Users\DonhangController::class, 'add_order'])->name('add_order');

        //------------------------THANH TOAN PAYPAL---------------------------------\\

        Route::get('create-transaction', [PayPalController::class, 'createTransaction'])->name('createTransaction');
        Route::get('process-transaction', [PayPalController::class, 'processTransaction'])->name('processTransaction');
        Route::get('success-transaction', [PayPalController::class, 'successTransaction'])->name('successTransaction');
        Route::get('cancel-transaction', [PaypalController::class, 'cancelTransaction'])->name('cancelTransaction');

        //-----------------------LỊCH SỬ MUA HÀNG------------------------------------\\

        Route::get('order_history', [\App\Http\Controllers\Users\DonhangController::class, 'order_history'])->name('order_history');
        Route::get('order_history_detail/{donhang}', [\App\Http\Controllers\Users\DonhangController::class, 'order_history_detail'])->name('order_history_detail');
        Route::get('order_update/{donhang}', [\App\Http\Controllers\Users\DonhangController::class, 'update_donhang']);

        //Tài khoản
        Route::get('account', [\App\Http\Controllers\Users\TaikhoanController::class, 'account'])->name('account');
        Route::get('diachikhachhang', [\App\Http\Controllers\Users\TaikhoanController::class, 'diachikhachhang'])->name('diachikhachhang'); //Chọn địa chỉ
        Route::post('insert_address', [\App\Http\Controllers\Users\TaikhoanController::class, 'insert_address'])->name('insert_address'); //Thêm địa chỉ
        Route::post('load_address', [\App\Http\Controllers\Users\TaikhoanController::class, 'load_address'])->name('load_address'); // lấy dữ liệu ra
    });
});



//----------------KHÁCH HÀNG VÃNG LAI KHÔNG CÓA TÀI KHOẢN--------------//

//home
Route::get('/', [App\Http\Controllers\MainController::class, 'index']);
Route::get('shop', [App\Http\Controllers\MainController::class, 'shop']);

//trang lien hệ
// Route::get('danh-muc/contact', [App\Http\Controllers\MainController::class, 'contact'])->name('contact'); 

//Hiện thị sản phẩm thêm
Route::post('/services/load-product', [App\Http\Controllers\MainController::class, 'loadProduct']);

Route::get('danh-muc/{id}-{slug}.html', [App\Http\Controllers\MenuController::class, 'index']);
Route::get('thuong-hieu/{id}-{slug}.html', [App\Http\Controllers\BrandController::class, 'index']);
Route::get('san-pham/{id}-{slug}.html', [App\Http\Controllers\ProductController::class, 'index']);


//TÌM KIẾM - KHÁCH HÀNG
Route::get('/search', [App\Http\Controllers\ProductController::class, 'search']);
Route::get('/searchProductMicrophone', [App\Http\Controllers\ProductController::class, 'searchProductMicrophone']);
Route::post('/autocomplete_ajax', [App\Http\Controllers\MainController::class, 'autocomplete_ajax']);

// //Email
// Route::get('test-email', [App\Http\Controllers\MainController::class, 'testEmail']);
// Route::get('check_orther', [App\Http\Controllers\DonhangControllerController::class, 'checkorther']);
Route::get('/xacnhandonhang/{id}/{token}', [App\Http\Controllers\Users\DonhangController::class, 'xacnhanemail'])->name('xacnhan');
