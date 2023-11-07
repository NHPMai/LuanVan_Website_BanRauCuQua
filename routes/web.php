<?php

use App\Http\Controllers\Admin\Nhanviens\LoginNhanvienController;
use App\Http\Controllers\Admin\Nhanviens\LogoutController;

use App\Http\Controllers\Users\LogincustomerController;
use App\Http\Controllers\Users\LogoutcustomerController;

use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\CartController;
use App\Http\Controllers\Admin\MagiamgiaController;
use App\Http\Controllers\Admin\VanChuyenController;
use App\Http\Controllers\Admin\SupplierController;
use App\Models\Product;
use App\Models\Role;

use Illuminate\Support\Facades\Route;



//--------------------ADMIN---------------------//

Route::prefix('admin')->name('admin.')->group(function () {
   
    Route::middleware(['guest:admin'])->group(function(){
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

        // #Menu
        Route::prefix('menus')->group(function () {
            Route::get('add', [MenuController::class, 'create']);
            Route::post('add', [MenuController::class, 'store']);
            Route::get('list', [MenuController::class, 'index']);
            Route::get('edit/{menu}', [MenuController::class, 'show']);
            Route::post('edit/{menu}', [MenuController::class, 'update']);
            Route::DELETE('destroy', [MenuController::class, 'destroy']);
        });

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
        Route::prefix('suppliers')->group(function(){
            Route::get('add',[SupplierController::class, 'create']);
            Route::post('add', [SupplierController::class, 'store']);
            Route::get('list', [SupplierController::class, 'index']);
            Route::get('edit/{supplier}', [SupplierController::class, 'show']);
            Route::post('edit/{supplier}', [SupplierController::class, 'update']);
            Route::DELETE('destroy',[SupplierController::class, 'destroy']);
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
        Route::prefix('brands')->group(function () {
            Route::get('add', [BrandController::class, 'create']);
            Route::post('add', [BrandController::class, 'store']);
            Route::get('list', [BrandController::class, 'index']);
            Route::get('edit/{brand}', [BrandController::class, 'show']);
            Route::post('edit/{brand}', [BrandController::class, 'update']);
            Route::DELETE('destroy', [BrandController::class, 'destroy']);
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



//---------------------USER--------------------------//

Route::prefix('user')->name('user.')->group(function () {

    //KHÁCH HÀNG KHÔNG CÓA TÀI KHOẢN
    Route::middleware(['guest:web'])->group(function () {
        //Đăng kí
        // Route::view('/login','user.logincustomer')->name('login');
        Route::get('/register', [LogincustomerController::class, 'register']);
        Route::post('/create', [LogincustomerController::class, 'sign_up'])->name('create');

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

        //Mã giảm giá
        Route::post('check_coupon', [App\Http\Controllers\Users\DonhangController::class, 'check_coupon'])->name('check_coupon');   //Lấy mã giảm giá
        Route::get('delete_coupon', [App\Http\Controllers\Users\DonhangController::class, 'delete_coupon'])->name('delete_coupon'); //Xóa mã giảm giá

        //Phi van chuyen
        Route::post('select_delivery_home', [App\Http\Controllers\Users\DonhangController::class, 'select_delivery_home'])->name('select_delivery_home'); //Chọn nơi vận chuyển
        Route::post('calculate_fee', [App\Http\Controllers\Users\DonhangController::class, 'calculate_fee'])->name('calculate_fee');  //Tính phí vận chuyển
        
        //thanh toan
        Route::get('checkout', [App\Http\Controllers\Users\DonhangController::class, 'showcheckout'])->name(name: 'showcheckout');
        Route::post('add_order', [App\Http\Controllers\Users\DonhangController::class, 'add_order'])->name('add_order');
        
        //lịch sử đơn hàng
        Route::get('order_history', [\App\Http\Controllers\Users\DonhangController::class, 'order_history'])->name('order_history');
        Route::get('order_history_detail', [\App\Http\Controllers\Users\DonhangController::class, 'order_history_detail'])->name('order_history_detail');

        //Tài khoản
        Route::get('account', [\App\Http\Controllers\Users\TaikhoanController::class, 'account'])->name('account');
    });
});



//----------------KHÁCH HÀNG VÃNG LAI KHÔNG CÓA TÀI KHOẢN--------------//


//home
Route::get('/', [App\Http\Controllers\MainController::class, 'index']);

//trang lien hệ
// Route::get('danh-muc/contact', [App\Http\Controllers\MainController::class, 'contact'])->name('contact'); 

//Hiện thị sản phẩm thêm
Route::post('/services/load-product', [App\Http\Controllers\MainController::class, 'loadProduct']);

Route::get('danh-muc/{id}-{slug}.html', [App\Http\Controllers\MenuController::class, 'index']);
Route::get('san-pham/{id}-{slug}.html', [App\Http\Controllers\ProductController::class, 'index']);


//TÌM KIẾM - KHÁCH HÀNG
Route::get('/search', [App\Http\Controllers\ProductController::class, 'search']);
Route::get('/searchProductMicrophone', [App\Http\Controllers\ProductController::class, 'searchProductMicrophone']);

// //Email
// Route::get('test-email', [App\Http\Controllers\MainController::class, 'testEmail']);
// Route::get('check_orther', [App\Http\Controllers\DonhangControllerController::class, 'checkorther']);
Route::get('/xacnhandonhang/{id}/{token}', [App\Http\Controllers\Users\DonhangController::class, 'xacnhanemail'])->name('xacnhan');
