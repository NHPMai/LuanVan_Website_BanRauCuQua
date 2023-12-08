<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Chitietdonhang;
use App\Models\Diachi;
use App\Models\Donhang;
use App\Models\khachhang;
use App\Models\Product;
use App\Models\Magiamgia;
use App\Models\Tinh_thanhpho;
use App\Models\Quan_huyen;
use App\Models\Xa_phuong_thitran;
use App\Models\Phivanchuyen;
use App\Models\Phuongthucthanhtoan;
use App\Models\Thongke;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use PhpParser\Node\Stmt\Echo_;
use Carbon\Carbon;
use Illuminate\Console\View\Components\Alert;

class DonhangController extends Controller
{

    public function index(Request $request)
    {
        $result = $this->create($request);

        if ($result === false) {
            return redirect()->back();
        }
        return redirect('user/order-detail');
    }

    public function create($request)
    {
        $qty = (int)$request->input('num_product'); //số lượng sản phẩm add
        $product_id = (int)$request->input('product_id');
        $sp_id = Product::find($product_id);
        $sp_number = $sp_id->soluongsp;

        if ($qty < 1 || $product_id <= 0) {
            Session::flash('error', 'Số lượng sản phẩm phải lớn hơn 0');
            return false;
        }

        if ($sp_number < $qty || $product_id <= 0) {
            Session::flash('error', 'Số lượng vượt quá số lượng sản phẩm trong kho');
            return false;
        }

        $chitietdonhangs = Session::get('chitietdonhangs');
        if (is_null($chitietdonhangs)) {
            Session::put('chitietdonhangs', [
                $product_id => $qty //qty: so luong 
            ]);
            return true;
        }

        $exists = Arr::exists($chitietdonhangs, $product_id);
        if ($exists) {
            $chitietdonhangs[$product_id] = $chitietdonhangs[$product_id] + $qty;
            // dd( $chitietdonhangs[$product_id]);
            if ($chitietdonhangs[$product_id] > $sp_number) {
                Session::flash('error', 'Số lượng vượt quá số lượng sản phẩm trong kho');
                return false;
            }
            Session::put('chitietdonhangs', $chitietdonhangs);
            return true;
        }

        $chitietdonhangs[$product_id] = $qty;
        Session::put('chitietdonhangs', $chitietdonhangs);

        return true;
    }

    // public function update(Request $request)
    // {

    //    $qty = (int)$request->input('num_product');

    //     $ctdh = Session::get('chitietdonhangs');
    //     $ctdh_id = array_keys($ctdh);

    //     $sp_number = Product::select('soluongsp')
    //     ->where('hoatdong', 1)
    //     ->whereIn('id', $ctdh_id)
    //     ->get();

    //     if ( $qty < 1 ) {
    //         Session::flash('error', 'Số lượng hoặc Sản phẩm không chính xác');
    //         return false;
    //     }

    //     if ( $sp_number < $qty) {
    //         Session::flash('error', 'Số lượng vượt quá số lượng sản phẩm trong kho');
    //         return false;
    //     }

    //     Session::put('chitietdonhangs', $qty);
    //     return redirect('user/order-detail');
    // }


    //Hàm cập nhập số lượng giỏ hàng
    public function update(Request $request)
    {
        $numProductArray = $request->input('num_product');

        // Lấy giỏ hàng hiện tại từ session
        $chitietdonhangs = session()->get('chitietdonhangs');
      

        foreach ($numProductArray as $product_id => $newQuantity) {
            // Lấy thông tin sản phẩm từ cơ sở dữ liệu sử dụng $product_id
            $product = Product::find($product_id);

            $soluong_sp = $product->soluongsp;
            if ($product) {
                if (isset($chitietdonhangs[$product_id])) {
                    //dd($chitietdonhangs[$product_id]);
                    if ($newQuantity > $soluong_sp) {
                        session()->flash('error', 'Số lượng của sản phẩm ' . $product->ten . ' lớn hơn trong kho!');
                        return redirect('user/order-detail');
                        // return false;
                    } elseif ($newQuantity <= 0) {
                        session()->flash('error', 'Số lượng của sản phẩm ' . $product->ten . ' không được nhỏ hơn 0!');
                        return redirect('user/order-detail');
                        // return false;
                    } else {
                        // Cập nhật số lượng sản phẩm trong giỏ hàng
                        $chitietdonhangs[$product_id] = $newQuantity;
                    }
                }
            }
        }
        session()->put('chitietdonhangs', $chitietdonhangs);

        return redirect('user/order-detail');
    }



    public function show()
    {
        $products = $this->getProduct();
        // dd($products);
        return view('chitietdonhangs.danhsach', [
            'title' => 'Giỏ Hàng',
            'products' => $products,
            'chitietdonhangs' => Session::get('chitietdonhangs'),
            'coupons' => Session::get('coupon')
        ]);
    }

    public function getProduct()
    {
        $chitietdonhangs = Session::get('chitietdonhangs');
        // dd($chitietdonhangs);
        if (is_null($chitietdonhangs)) return [];

        $productId = array_keys($chitietdonhangs);
        return Product::select('id', 'ten', 'gia', 'hinhanh')
            ->where('hoatdong', 1)
            ->whereIn('id', $productId)
            ->get();
    }

    public function get()
    {
        $donhangs = Session::get('donhangs');
        if (is_null($donhangs)) return [];

        $chitietdonhangId = array_keys($donhangs);
        return Chitietdonhang::select('id', 'ctdh_soluong', 'ctdh_gia')
            // ->where('hoatdong', 1)
            ->whereIn('id', $chitietdonhangId)
            ->get();
    }

    public function store(Request $request)
    {
    }

    public function edit($id)
    {
        //
    }

    // public function update(Request $request)
    // {
    //     // $product_id = (int)$request->input('product_id');
    //     // dd($product_id);
    //     Session::put('chitietdonhangs', $request->input('num_product'));
    //     return redirect('user/order-detail');
    // }

    public function remove($id = 0)
    {
        $this->xoa($id);

        return redirect('/user/order-detail');
    }

    protected function xoa($id)
    {
        $chitietdonhangs = Session::get('chitietdonhangs');
        unset($chitietdonhangs[$id]);

        Session::put('chitietdonhangs', $chitietdonhangs);
        return true;
    }

    // public function delete_all(){
    //     // return 123;
    //     $chitietdonhangs = Session::get('chitietdonhangs');
    //     dd($chitietdonhangs);
    //     if($chitietdonhangs == true){
    //         Session::forget('chitietdonhangs');
    //         Session::forget('coupon');
    //         Session::flash('success','Xóa tất cả sản phẩm');
    //         return redirect('/user/order-detail');
    //     }
    // }


    public function destroy($request)
    {
        $chitietdonhang = Chitietdonhang::where('id', $request->input('id'))->first();
        if ($chitietdonhang) {
            $path = str_replace('storage', 'public', $chitietdonhang->pty);
            Storage::delete($path);
            $chitietdonhang->delete();
            return true;
        }

        return false;
    }


    //MÃ GIẢM GIÁ

    public function check_coupon(Request $request)
    {
        $now = \Carbon\Carbon::now('Asia/Ho_Chi_Minh');
        $data = $request->all();
        // dd($data);
        $magiamgia = Magiamgia::where('mgg_magiamgia', $data['coupon'])
            ->where(DB::raw('DATE(mgg_ngayketthuc)'), '>=', $now->toDateString())
            ->first();

        // dd($magiamgia);
        if ($magiamgia) {
            $dem_magiamgia = $magiamgia->count(); //Đếm mã giảm giá
            if ($dem_magiamgia > 0) {
                $magiamgia_session = Session::get('coupon');
                if ($magiamgia_session == true) {     //Đã nhập mã
                    $is_avaiable = 0;
                    if ($is_avaiable == 0) {
                        $cou[] = array(
                            'id' => $magiamgia->id,
                            'mgg_magiamgia' => $magiamgia->mgg_magiamgia,
                            'mgg_loaigiamgia' => $magiamgia->mgg_loaigiamgia,
                            'mgg_soluongma' => $magiamgia->mgg_soluongma,
                            'mgg_giatrigiamgia' => $magiamgia->mgg_giatrigiamgia,
                        );
                        Session()->put('coupon', $cou);
                    }
                } else {                   //Chưa có mã
                    $cou[] = array(
                        'id' => $magiamgia->id,
                        'mgg_magiamgia' => $magiamgia->mgg_magiamgia,
                        'mgg_loaigiamgia' => $magiamgia->mgg_loaigiamgia,
                        'mgg_soluongma' => $magiamgia->mgg_soluongma,
                        'mgg_giatrigiamgia' => $magiamgia->mgg_giatrigiamgia,
                    );
                    Session()->put('coupon', $cou);
                }
                Session::save();
                Session::flash('flash_message', 'Thêm mã giảm giá thành công');
                return redirect()->back();
            }
        } else {
            Session::flash('flash_message_error', 'Mã giảm giá không đúng hoặc hết hạn');
            return redirect()->back();
        }
    }


    // XÓA MÃ GIẢM GIÁ

    public function delete_coupon()
    {
        $coupon = Session::get('coupon');
        if ($coupon == true) {
            Session::forget('coupon');
            Session::flash('flash_message', 'Xóa mã giảm giá thành công');
            return redirect()->back();
        }
    }


    //HIỆN THANH TOÁN
    public function showcheckout()
    {       
        // $b = session()->get('chitietdonhangs');
        // dd($b);

        $idkh = Auth::user()->id;
        $khachhang = khachhang::find($idkh);
        $a = $khachhang->id;
        $diachi = Diachi::where('khachhang_id', $a)->get();
        $phuongthucthanhtoan = Phuongthucthanhtoan::orderby('id', 'ASC')->get();
        $products = $this->getProduct();
        // dd($products);
        $tinh_thanhpho = Tinh_thanhpho::orderby('id', 'ASC')->get();
        // dd($tinh_thanhpho);
        // $phivanchuyens = Phivanchuyen::orderby('id', 'ASC')->get();
        return view('chitietdonhangs.donhang', [
            'products' => $products,
            'chitietdonhangs' => session()->get('chitietdonhangs'),
            'khachhang' => $khachhang,
            'coupons' => session()->get('coupon'),
            'tinh_thanhpho' => $tinh_thanhpho,
            'diachi' => $diachi,
            'phuongthucthanhtoan' => $phuongthucthanhtoan,
        ]);
        // return 123;
    }



    // public function add_order(Request $request)
    // {
    //     $this->validate(
    //         $request,
    //         [
    //             'sodienthoai' => 'required',

    //         ],
    //         [
    //             'sodienthoai.required' => 'Vui lòng nhập số điện thoại',
    //         ]
    //     );

    //     //$this->cartService->getCart($request);
    //     // $phuong_thuc_thanh_toan_id = $request->input('payment_select');
    //     // if($phuong_thuc_thanh_toan_id == 1){
    //     //     dd(123);
    //     // }
    //     // else{dd(456);}
    //     // dd($phuong_thuc_thanh_toan_id);
    //     try {
    //         DB::beginTransaction();
    //         $total = 0;
    //         $chitietdonhangs = Session::get('chitietdonhangs');
    //         // dd($chitietdonhangs);
    //         $coupons = Session::get('coupon');
    //         // dd($coupons);
    //         $productId = array_keys($chitietdonhangs);
    //         // dd($productId);
    //         $data = $request->input();
    //         //dd($data);
    //         $data_input = session()->put('data', $data);

    //         // Lấy giá trị từ session với key là 'data'
    //         $data_get = session('data');

    //         // Lấy thông tin sản phẩm từ giỏ hàng
    //         foreach ($chitietdonhangs as $product_id => $quantity_purchased) {
    //             // Bước 1: Truy xuất thông tin sản phẩm từ cơ sở dữ liệu
    //             $product = Product::find($product_id);
    //             if ($product) {
    //                 // Bước 2: Cập nhật số lượng sản phẩm
    //                 $new_quantity_in_stock = max(0, $product->soluongsp - $quantity_purchased);
    //                 $new_quantity_sold = $product->sp_soluongban + $quantity_purchased;
    //                 // Bước 3: Lưu thông tin sản phẩm đã cập nhật trở lại cơ sở dữ liệu
    //                 $product->soluongsp = $new_quantity_in_stock;
    //                 $product->soluongban = $new_quantity_sold;
    //                 $product->save();
    //                 // Cập nhật giỏ hàng với số lượng đã mua (có thể giữ nguyên hoặc xóa sản phẩm khỏi giỏ hàng tùy theo yêu cầu của bạn)
    //                 $chitietdonhangs[$product_id] = $quantity_purchased;
    //             }
    //         }

    //         // Lưu giỏ hàng đã cập nhật vào session
    //         session()->put('chitietdonhangs', $chitietdonhangs);

    //         $products = Product::select('id', 'ten', 'gia', 'hinhanh', 'soluongsp', 'soluongban')
    //             ->where('hoatdong', 1)
    //             ->whereIn('id', $productId)
    //             ->get();
    //         foreach ($products as $product) {
    //             $price = $product->gia;
    //             $priceEnd = $price * $chitietdonhangs[$product->id];
    //             $total += $priceEnd;
    //         }

    //         // Đặt múi giờ
    //         date_default_timezone_set('Asia/Ho_Chi_Minh');

    //         $idkh = Auth('web')->user()->id;

    //         //$id_dc = $request->dc_DiaChi;
    //         //$dc = DiaChi::find($id_dc);
    //         //$pdh_DiaChiGiao = $dc->dc_DiaChi;

    //         //$id_tp = $dc->tinh_thanh_pho_id;
    //         //$pvc = PhiVanChuyen::where('thanh_pho_id', $id_tp)->get();
    //         //$phi = $pvc[0]['pvc_PhiVanChuyen'];

    //         $today = Carbon::now()->toDateString();

    //         // $phuong_thuc_thanh_toan_id = $request->input('phuongthucthanhtoan_id');
    //         //$submitButtonName = '';

    //         // switch ($phuong_thuc_thanh_toan_id) {
    //         //     case 1:
    //         //         $submitButtonName = 'cod';
    //         //         break;
    //         //     case 2:
    //         //         $submitButtonName = 'paypal';
    //         //         break;
    //         //     case 3:
    //         //         $submitButtonName = 'redirect';
    //         //        break;
    //         //     case 4:
    //         //         $submitButtonName = 'onepay';
    //         //         break;
    //         //     default:
    //         //         // Xử lý mặc định nếu không khớp với bất kỳ giá trị nào
    //         //      break;
    //         // }
    //         // Kiểm tra xem nút `submit` có tên là 'cod' đã được bấm hay không
    //         // if ($submitButtonName === 'cod') {
    //         //dd('cod');

    //         if ($coupons) {
    //             foreach ($coupons as $key => $cou)
    //                 if ($cou['mgg_loaigiamgia'] == 1) {
    //                     $total_coupon = ($total * $cou['mgg_giatrigiamgia']) / 100;
    //                     $tien_end = $total - $total_coupon;
    //                     // dd($tien_end);
    //                 } elseif ($cou['mgg_loaigiamgia'] == 2) {
    //                     $tien_end = $total - $cou['mgg_giatrigiamgia'];
    //                     //dd($tien_end);
    //                 }

    //             $chitietdonhang = new Donhang();
    //             $chitietdonhang->khachhang_id = $idkh;
    //             $chitietdonhang->magiamgia_id = $coupons[0]['id'];
    //             $chitietdonhang->dh_ghichu = $request->dh_ghichu;
    //             $chitietdonhang->dh_giamgia = $coupons[0]['mgg_magiamgia'];
    //             $chitietdonhang->dh_diachigiaohang = 1;
    //             $chitietdonhang->dh_thoigiandathang = $today;
    //             $chitietdonhang->dh_thanhtien = $tien_end;
    //             $chitietdonhang->dh_trangthai = 1;
    //             // $cart->phuong_thuc_thanh_toan_id = $request->phuong_thuc_thanh_toan_id;
    //             $chitietdonhang->save();



    //             // Cập nhật trường mgg_SoLuongMa
    //             $newSoLuongMa = $cou['mgg_soluongma'] - 1;

    //             MaGiamGia::where('id', $cou['id'])
    //                 ->update(['mgg_soluongma' => $newSoLuongMa]);
    //         } else {
    //             // $tien_end = $total + $phi ;
    //             $tien_end = $total;

    //             $chitietdonhang = new Donhang;
    //             $chitietdonhang->khachhang_id = $idkh;
    //             $chitietdonhang->dh_ghichu = $request->dh_ghichu;
    //             $chitietdonhang->dh_diachigiaohang = 1;
    //             $chitietdonhang->dh_thoigiandathang = $today;
    //             $chitietdonhang->dh_thanhtien = $tien_end;
    //             $chitietdonhang->dh_trangthai = 1;
    //             // $chitietdonhang->phuong_thuc_thanh_toan_id = $request->phuong_thuc_thanh_toan_id;

    //             $chitietdonhang->save();
    //             // dd($chitietdonhang);
    //         }

    //         //CẬP NHẬT THÔNG TIN KHÁCH HÀNG
    //         $kh = KhachHang::find($idkh);
    //         $kh->sodienthoai = $request->sodienthoai;
    //         $tien = $kh->tongtienmua;
    //         $kh->tongtienmua = $tien + $tien_end;
    //         $kh->save();

    //         foreach ($products as $product) {
    //             DB::table('chitietdonhangs')->insert([
    //                 'donhang_id' => $chitietdonhang->id,
    //                 'product_id' => $product->id,
    //                 'ctdh_soluong' => $chitietdonhangs[$product->id],
    //                 'ctdh_gia' => $product->gia
    //             ]);
    //         }

    //         $name = Auth::user();
    //         Mail::send('emails.test', compact('chitietdonhang', 'name'), function ($email) use ($name) {
    //             $email->subject('Cửa Hàng Vegetable Family - Xác Nhận Đơn Hàng');
    //             $email->to($name->email, $name->hoten);
    //         });


    //         if ($coupons == true) {
    //             Session::forget('coupon');
    //         }

    //         DB::commit();
    //         session()->forget('chitietdonhangs');
    //         session()->forget('data_get');
    //         session()->forget('total_paypal');
    //     } catch (\Exception $err) {
    //         DB::rollBack();
    //         Session::flash('error', 'Đặt Hàng Lỗi, Vui lòng thử lại sau');
    //         return false;
    //     }
    //     Session::flash('success', 'Đặt hàng thành công!');

    //     return redirect("/")->with('success', 'Thao tác thành công');
    // }



    // THANH TOÁN ĐƠN HÀNG
    public function add_order(Request $request)
    {
        $this->validate(
            $request,
            [
                'sodienthoai' => 'required',
                // 'diachi_id' => 'required',

            ],
            [
                'sodienthoai.required' => 'Vui lòng nhập số điện thoại',
                // 'diachi_id.required' => 'Vui lòng chọn địa chỉ giao hàng',
            ]
        );

        //$this->cartService->getCart($request);
        $phuong_thuc_thanh_toan_id = $request->input('payment_select');
        // dd($phuong_thuc_thanh_toan_id);


        if ($phuong_thuc_thanh_toan_id == 1) {

            try {
                DB::beginTransaction();
                $total = 0;

                $chitietdonhangs = Session::get('chitietdonhangs');
                // dd($chitietdonhangs);
                $coupons = Session::get('coupon');
                // dd($coupons);
                $productId = array_keys($chitietdonhangs);
                // dd($productId);
                $data = $request->input();
                //dd($data);
                $data_input = session()->put('data', $data);
                // dd($data_input);
                // Lấy giá trị từ session với key là 'data'
                $data_get = session('data');

                // Lấy thông tin sản phẩm từ giỏ hàng
                foreach ($chitietdonhangs as $product_id => $quantity_purchased) {
                    // Bước 1: Truy xuất thông tin sản phẩm từ cơ sở dữ liệu
                    $product = Product::find($product_id);

                    if ($product) {
                        // Bước 2: Cập nhật số lượng sản phẩm
                        $new_quantity_in_stock = max(0, $product->soluongsp - $quantity_purchased); //Số lượng sp còn trg kho

                        $new_quantity_sold = $product->soluongban + $quantity_purchased; //Số lượng bán

                        // Bước 3: Lưu thông tin sản phẩm đã cập nhật trở lại cơ sở dữ liệu
                        $product->soluongsp = $new_quantity_in_stock;
                        $product->soluongban = $new_quantity_sold;
                        $product->save();
                        // Cập nhật giỏ hàng với số lượng đã mua (có thể giữ nguyên hoặc xóa sản phẩm khỏi giỏ hàng tùy theo yêu cầu của bạn)
                        $chitietdonhangs[$product_id] = $quantity_purchased;
                    }
                }

                // Lưu giỏ hàng đã cập nhật vào session
                session()->put('chitietdonhangs', $chitietdonhangs);

                $products = Product::select('id', 'ten', 'gia', 'hinhanh', 'soluongsp', 'soluongban')
                    ->where('hoatdong', 1)
                    ->whereIn('id', $productId)
                    ->get();

                foreach ($products as $product) {
                    $price = $product->gia;
                    $priceEnd = $price * $chitietdonhangs[$product->id];
                    $total += $priceEnd;
                }

                // Đặt múi giờ
                date_default_timezone_set('Asia/Ho_Chi_Minh');

                $idkh = Auth('web')->user()->id;


                $id_dc = $request->diachi_id;
                $dc = DiaChi::find($id_dc);
                $dh_diachigiaohang = $dc->dc_diachi;

                $id_xa = $dc->xa_phuong_thitran_id;
                $pvc = PhiVanChuyen::where('xa_phuong_thitran_id', $id_xa)->get();
                $phi = $pvc[0]['pvc_phivanchuyen'];


                $today = Carbon::now()->toDateString();

                // $phuong_thuc_thanh_toan_id = $request->input('phuongthucthanhtoan_id');
                //$submitButtonName = '';

                // switch ($phuong_thuc_thanh_toan_id) {
                //     case 1:
                //         $submitButtonName = 'cod';
                //         break;
                //     case 2:
                //         $submitButtonName = 'paypal';
                //         break;
                //     case 3:
                //         $submitButtonName = 'redirect';
                //        break;
                //     case 4:
                //         $submitButtonName = 'onepay';
                //         break;
                //     default:
                //         // Xử lý mặc định nếu không khớp với bất kỳ giá trị nào
                //      break;
                // }
                // Kiểm tra xem nút `submit` có tên là 'cod' đã được bấm hay không
                // if ($submitButtonName === 'cod') {
                //dd('cod');

                if ($coupons) {
                    foreach ($coupons as $key => $cou)
                        if ($cou['mgg_loaigiamgia'] == 1) {
                            $total_coupon = ($total * $cou['mgg_giatrigiamgia']) / 100;
                            $tien_end = $total - $total_coupon + $phi;
                            // dd($tien_end);
                        } elseif ($cou['mgg_loaigiamgia'] == 2) {
                            $tien_end = $total - $cou['mgg_giatrigiamgia'] + $phi;
                            // dd($tien_end);
                        }


                    $chitietdonhang = new Donhang();
                    $chitietdonhang->khachhang_id = $idkh;
                    $chitietdonhang->magiamgia_id = $coupons[0]['id'];
                    $chitietdonhang->dh_ghichu = $request->dh_ghichu;
                    $chitietdonhang->dh_giamgia = $coupons[0]['mgg_magiamgia'];
                    $chitietdonhang->dh_diachigiaohang = $dh_diachigiaohang;
                    $chitietdonhang->dh_thoigiandathang = $today;
                    $chitietdonhang->dh_thanhtien = $tien_end;
                    $chitietdonhang->dh_trangthai = 1;
                    $chitietdonhang->phuongthucthanhtoan_id = 1;
                    $chitietdonhang->save();



                    // Cập nhật trường mgg_SoLuongMa
                    $newSoLuongMa = $cou['mgg_soluongma'] - 1;

                    MaGiamGia::where('id', $cou['id'])
                        ->update(['mgg_soluongma' => $newSoLuongMa]);
                } else {
                    $tien_end = $total + $phi;


                    $chitietdonhang = new Donhang;
                    $chitietdonhang->khachhang_id = $idkh;
                    $chitietdonhang->dh_ghichu = $request->dh_ghichu;
                    $chitietdonhang->dh_diachigiaohang = $dh_diachigiaohang;
                    $chitietdonhang->dh_thoigiandathang = $today;
                    $chitietdonhang->dh_thanhtien = $tien_end;
                    $chitietdonhang->dh_trangthai = 1;
                    $chitietdonhang->phuongthucthanhtoan_id = 1;

                    $chitietdonhang->save();
                    // dd($chitietdonhang);

                }

                //CẬP NHẬT THÔNG TIN KHÁCH HÀNG
                $kh = KhachHang::find($idkh);
                $kh->sodienthoai = $request->sodienthoai;
                $tien = $kh->tongtienmua;
                $kh->tongtienmua = $tien + $tien_end;
                $kh->save();

                foreach ($products as $product) {
                    DB::table('chitietdonhangs')->insert([
                        'donhang_id' => $chitietdonhang->id,
                        'product_id' => $product->id,
                        'ctdh_soluong' => $chitietdonhangs[$product->id],
                        'ctdh_gia' => $product->gia
                    ]);
                }

                $name = Auth::user();
                Mail::send('emails.test', compact('chitietdonhang', 'name'), function ($email) use ($name) {
                    $email->subject('Cửa Hàng Vegetable Family - Xác Nhận Đơn Hàng');
                    $email->to($name->email, $name->hoten);
                });


                if ($coupons == true) {
                    Session::forget('coupon');
                }

                DB::commit();
                session()->forget('chitietdonhangs');
                session()->forget('data_get');
                session()->forget('total_paypal');
            } catch (\Exception $err) {
                DB::rollBack();
                Session::flash('error', 'Đặt Hàng Lỗi, Vui lòng thử lại sau');
                return false;
            }
            Session::flash('success', 'Đặt hàng thành công!');

            return redirect("/user/order_history");
        } else {
            // $chitietdonhangs = Session::get('chitietdonhangs');
            // dd($chitietdonhangs);

            return redirect()
                ->route('user.processTransaction');
        }
        // dd($phuong_thuc_thanh_toan_id);

    }

    //PHI VAN CHUYEN
    public function select_delivery_home(Request $request)
    {
        $data = $request->all();
        if ($data['action']) {
            $output = '';
            if ($data['action'] == "tinh_thanhpho") {
                $select_quanhuyen = Quan_huyen::where('tinh_thanhpho_id', $data['ma_id'])->orderby('id', 'ASC')->get();
                $output .= '<option>----Chọn quận huyện----</option>';
                foreach ($select_quanhuyen as $key => $quan_huyen) {
                    $output .= '<option value="' . $quan_huyen->id . '">' . $quan_huyen->qh_ten . '</option>';
                }
            } else {
                $select_xa = Xa_phuong_thitran::where('quan_huyen_id', $data['ma_id'])->orderby('id', 'ASC')->get();
                $output .= '<option>----Chọn xã phường----</option>';
                foreach ($select_xa as $key => $xa) {
                    $output .= '<option value="' . $xa->id . '">' . $xa->xa_ten . '</option>';
                }
            }
        }
        echo $output;
    }

    //Tinh phi van chuyen
    public function calculate_fee(Request $request)
    {
        $data = $request->all();

        $diachi = Diachi::where('id', $data['calculate_delivery'])->first();
        // dd($request);
        // if($data['tinh_thanhpho_id']){
        $feeship = Phivanchuyen::where('tinh_thanhpho_id', $diachi['tinh_thanhpho_id'])
            ->where('quan_huyen_id', $diachi['quan_huyen_id'])
            ->where('xa_phuong_thitran_id', $diachi['xa_phuong_thitran_id'])->first();
        // foreach($feeship as $key => $fee){
        //     Session::put('fee',$fee->pvc_phivanchuyen);
        //     Session::save();
        // }
        $output = '';
        $output .= '<li value="">' . $feeship->pvc_phivanchuyen . '</li>';
        echo $output;
        // }
    }



    //GỬI MAIL
    public function xacnhanemail($id, $token)
    {
        dd($id, $token);
    }

    //LỊCH SỬ ĐƠN HÀNG
    public function order_history()
    {
        $idkh = Auth::user()->id;
        $b = Donhang::where('khachhang_id', $idkh)->orderByDesc('id')->paginate(15);
        // dd($b);
        return view('lichsudathangs.danhsach', [
            'title' => 'Lịch Sử Đặt Hàng Của Bạn',
            'b' => $b
        ]);
    }

    public function order_history_detail(Donhang $donhang)
    {

        // $idkh = Auth::user()->id;
        // $id_sp = Product::get('id');

        // $donhang1 = DB::table('donhangs')
        //     ->where('khachhang_id', $idkh)
        //     ->join('chitietdonhangs', 'donhangs.id', '=', 'chitietdonhangs.donhang_id')
        //     ->select( 'chitietdonhangs.product_id')
        //     ->get();
    //    dd($donhang1);
        

        $idkh = Auth::user()->id;

        $chitietlichsu = Donhang::where('khachhang_id', $idkh)->get();
        $chitietdonhang = Chitietdonhang::where('donhang_id', $donhang->id)->get();
        return view('lichsudathangs.chitiet', [
            'title' => 'Lịch Sử Đặt Hàng Của Bạn',
            'chitietlichsu' => $chitietlichsu,
            'donhang' => $donhang,
            'chitietdonhangs' => $chitietdonhang,
        ]);
    }

    // public function update_donhang(Request $req, $id)
    // {
    //     $order = Donhang::find($id);

    //     $id_kh = $order->khachhang_id;
    //     $kh = khachhang::where('id', $id_kh)->get();
    //     // dd($kh);
    //     $newStatus = $req->input('dh_trangthai');
    //     if ($newStatus == 3) {
    //         $order->dh_trangthai = $newStatus;
    //         $order->save();
    //     } elseif ($newStatus == 4) {
    //         $order->dh_trangthai = $newStatus;
    //         $order->save();

    //         // $kh = khachhang::where('id', $id_kh)->get();
    //         // Mail::send('emails.giaohangthanhcong', compact('kh'), function ($email) use ($kh) {
    //         //     $email->subject('Cửa Hàng Vegetable Family - Giao Hàng Thành Công');
    //         //     $email->to($kh->email, $kh->hoten);
    //         // });

    //         // $name = Auth::user();
    //         // Mail::send('emails.test', compact('chitietdonhang', 'name'), function ($email) use ($name) {
    //         //     $email->subject('Cửa Hàng Vegetable Family - Xác Nhận Đơn Hàng');
    //         //     $email->to($name->email, $name->hoten);
    //         // });




    //         $order_date = $order->dh_thoigiandathang;

    //         $thongke = ThongKe::where('tk_Ngay',$order_date)->get();

    //         if($thongke){
    //             $thongke_dem = $thongke->count();
    //         }else{
    //             $thongke_dem = 0;
    //         }

    //         $total_order = 0; //tong so luong don
    //         $sales = 0; //doanh thu
    //         $profit = 0; //loi nhuan
    //         $quantity = 0; //so luong

    //         $a =$order->id;
    //         $ctdh = Chitietdonhang::where('donhang_id',$a)->get();


    //         foreach ($ctdh as $detail){
    //             $product = $detail->product;
    //             $quantity += $detail->ctdh_soluong;
    //             $sales += $detail->ctdh_gia * $detail->ctdh_soluong;
    //             // dd($sales);
    //             $profit = $sales - 100000;
    //             // dd($profit);
    //         }
    //         $total_order += 1;

    //         if($thongke_dem > 0){
    //             $thongke_capnhat = ThongKe::where('tk_Ngay',$order_date)->first();
    //             $thongke_capnhat->tk_TongTien = $thongke_capnhat->tk_TogTien + $sales;
    //             $thongke_capnhat->tk_LoiNhuan = $thongke_capnhat->tk_LoiNhuan + $profit;
    //             $thongke_capnhat->tk_SoLuong = $thongke_capnhat->tk_SoLuong + $quantity;
    //             $thongke_capnhat->tk_TongDonHang = $thongke_capnhat->tk_TongDonHang + $total_order;
    //             // dd($thongke_capnhat);
    //             $thongke_capnhat->save();
    //         }else{
    //             $thongke_moi = new ThongKe();
    //             // dd($thongke);
    //             $thongke_moi->tk_Ngay = $order_date;
    //             $thongke_moi->tk_SoLuong = $quantity;
    //             $thongke_moi->tk_TongTien = $sales;
    //             $thongke_moi->tk_LoiNhuan = $profit;
    //             $thongke_moi->tk_TongDonHang = $total_order;
    //             $thongke_moi->save();
    //         }


    //     }
    //     return redirect()->back();
    // }

    public function update_donhang($id)
    {
        $trangthaidonhang = Donhang::find($id)
            ->update(
                ['dh_trangthai' => 4],
            );
        // if( $trangthaidonhang = true){
        //     $order = Donhang::find($id);
        //     $order_date = $order->dh_thoigiandathang;

        //     $thongke = ThongKe::where('tk_Ngay',$order_date)->get();

        //     if($thongke){
        //         $thongke_dem = $thongke->count();
        //     }else{
        //         $thongke_dem = 0;
        //     }

        //     $total_order = 0; //tong so luong don
        //     $sales = 0; //doanh thu
        //     $profit = 0; //loi nhuan
        //     $quantity = 0; //so luong

        //     $a =$order->id;
        //     $ctdh = Chitietdonhang::where('donhang_id',$a)->get();


        //     foreach ($ctdh as $detail){
        //         $product = $detail->product;
        //         $quantity += $detail->ctdh_soluong;
        //         $sales += $detail->ctdh_gia * $detail->ctdh_soluong;
        //         // dd($sales);
        //         $profit = $sales - 100000;
        //         // dd($profit);
        //     }
        //     $total_order += 1;

        //     if($thongke_dem > 0){
        //         $thongke_capnhat = ThongKe::where('tk_Ngay',$order_date)->first();
        //         $thongke_capnhat->tk_TongTien = $thongke_capnhat->tk_TogTien + $sales;
        //         $thongke_capnhat->tk_LoiNhuan = $thongke_capnhat->tk_LoiNhuan + $profit;
        //         $thongke_capnhat->tk_SoLuong = $thongke_capnhat->tk_SoLuong + $quantity;
        //         $thongke_capnhat->tk_TongDonHang = $thongke_capnhat->tk_TongDonHang + $total_order;
        //         // dd($thongke_capnhat);
        //         $thongke_capnhat->save();
        //     }else{
        //         $thongke_moi = new ThongKe();
        //         // dd($thongke);
        //         $thongke_moi->tk_Ngay = $order_date;
        //         $thongke_moi->tk_SoLuong = $quantity;
        //         $thongke_moi->tk_TongTien = $sales;
        //         $thongke_moi->tk_LoiNhuan = $profit;
        //         $thongke_moi->tk_TongDonHang = $total_order;
        //         $thongke_moi->save();
        //     }
        // }


        Session::flash('success', 'Bạn đã nhận đơn hàng thành công!');
        return redirect('user/order_history');
    }


    public function huydonhang(Request $req, $id)
    {
        // $data = $req->all();

        $detail_order = Chitietdonhang::with('product')
            ->where('donhang_id', $id)
            ->get();
        // dd($detail_order);
        // Cập nhật số lượng hàng trong bảng san_phams
        foreach ($detail_order as $detail) {
            $sp = $detail->product;
            $sp->soluongsp += $detail->ctdh_soluong;
            $sp->save();
        }

        $order = Donhang::where('id', $id)->first();
        $order->dh_huy = $req->dh_huy;
        $order->dh_trangthai = 5;
        $order->save();


        // Session::flash('success', 'Hủy đơn hàng thành công!');
        return redirect('user/order_history');
    }


    public function binhluandonhang(Request $req)
    {
        $data = $req->all();

        $order = Donhang::where('id', $data['id'])->first();
        $order->dh_binhluan = $data['binhluandonhang'];
        $order->save();
    }
}
