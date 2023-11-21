<?php

namespace App\Http\Controllers\users;

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
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalController extends Controller
{
    public function createTransaction()
    {
        return view('paypal.test');
    }


    // THANH TOÁN
    public function processTransaction(Request $request)
    {
        $total = Session::get('total_paypal');

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('user.successTransaction'),
                "cancel_url" => route('user.cancelTransaction'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $total
                    ]
                ]
            ]
        ]);
        if (isset($response['id']) && $response['id'] != null) {

            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }

            return redirect()
                ->route('user.createTransaction')
                ->with('error', 'Lỗi thanh toán.');
        } else {
            return redirect()
                ->route('user.createTransaction')
                ->with('error', $response['message'] ?? 'Lỗi thanh toán.');
        }
    }





    // public function successTransaction(Request $request)
    // {
    //     $provider = new PayPalClient;
    //     $provider->setApiCredentials(config('paypal'));
    //     $provider->getAccessToken();
    //     $response = $provider->capturePaymentOrder($request['token']);

    //     if (isset($response['status']) && $response['status'] == 'COMPLETED') {

    //         Session::put('success_paypal',true);

    //         return redirect()
    //             ->route('user.showcheckout')
    //             ->with('success', 'Thanh toán thành công');
    //     } else {
    //         return redirect()
    //             ->route('user.showcheckout')
    //             ->with('error', $response['message'] ?? 'Lỗi thanh toán');
    //     }
    // }




    // THANH TOÁN THÀNH CÔNG
    public function successTransaction(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        // dd($response);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            try {
                DB::beginTransaction();
                $total = 0;
                $chitietdonhangs = Session::get('chitietdonhangs');
                $coupons = Session::get('coupon');
                // dd($coupons);
                $productId = array_keys($chitietdonhangs);
                // dd($productId);
                $data = $request->input();
                //dd($data);
                $data_input = session()->put('data', $data);

                // Lấy giá trị từ session với key là 'data'
                $data_get = session('data');

                // Lấy thông tin sản phẩm từ giỏ hàng
                foreach ($chitietdonhangs as $product_id => $quantity_purchased) {
                    // Bước 1: Truy xuất thông tin sản phẩm từ cơ sở dữ liệu
                    $product = Product::find($product_id);
                    if ($product) {
                        // Bước 2: Cập nhật số lượng sản phẩm
                        $new_quantity_in_stock = max(0, $product->soluongsp - $quantity_purchased);
                        $new_quantity_sold = $product->sp_soluongban + $quantity_purchased;
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

                //$id_dc = $request->dc_DiaChi;
                //$dc = DiaChi::find($id_dc);
                //$pdh_DiaChiGiao = $dc->dc_DiaChi;

                //$id_tp = $dc->tinh_thanh_pho_id;
                //$pvc = PhiVanChuyen::where('thanh_pho_id', $id_tp)->get();
                //$phi = $pvc[0]['pvc_PhiVanChuyen'];

                $today = Carbon::now()->toDateString();



                if ($coupons) {
                    foreach ($coupons as $key => $cou)
                        if ($cou['mgg_loaigiamgia'] == 1) {
                            $total_coupon = ($total * $cou['mgg_giatrigiamgia']) / 100;
                            $tien_end = $total - $total_coupon;
                            // dd($tien_end);
                        } elseif ($cou['mgg_loaigiamgia'] == 2) {
                            $tien_end = $total - $cou['mgg_giatrigiamgia'];
                            //dd($tien_end);
                        }

                    $chitietdonhang = new Donhang();
                    $chitietdonhang->khachhang_id = $idkh;
                    $chitietdonhang->magiamgia_id = $coupons[0]['id'];
                    $chitietdonhang->dh_ghichu = $request->dh_ghichu;
                    $chitietdonhang->dh_giamgia = $coupons[0]['mgg_magiamgia'];
                    $chitietdonhang->dh_diachigiaohang = 1;
                    $chitietdonhang->dh_thoigiandathang = $today;
                    $chitietdonhang->dh_thanhtien = $tien_end;
                    $chitietdonhang->dh_trangthai = 1;
                    $chitietdonhang->phuongthucthanhtoan_id = 2;
                    $chitietdonhang->save();



                    // Cập nhật trường mgg_SoLuongMa
                    $newSoLuongMa = $cou['mgg_soluongma'] - 1;

                    MaGiamGia::where('id', $cou['id'])
                        ->update(['mgg_soluongma' => $newSoLuongMa]);
                } else {
                    // $tien_end = $total + $phi ;
                    $tien_end = $total;

                    $chitietdonhang = new Donhang;
                    $chitietdonhang->khachhang_id = $idkh;
                    $chitietdonhang->dh_ghichu = $request->dh_ghichu;
                    $chitietdonhang->dh_diachigiaohang = 1;
                    $chitietdonhang->dh_thoigiandathang = $today;
                    $chitietdonhang->dh_thanhtien = $tien_end;
                    $chitietdonhang->dh_trangthai = 1;
                    $chitietdonhang->phuongthucthanhtoan_id = 2;
                    $chitietdonhang->save();
                    // dd($chitietdonhang);
                }

                //CẬP NHẬT THÔNG TIN KHÁCH HÀNG
                // $kh = KhachHang::find($idkh);
                // $kh->sodienthoai = $request->sodienthoai;
                // $tien = $kh->tongtienmua;
                // $kh->tongtienmua = $tien + $tien_end;
                // $kh->save();

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
            Session::put('success_paypal', true);

            return redirect()
                ->route('user.showcheckout')
                ->with('success', 'Thanh toán thành công');
        } else {
            return redirect()
                ->route('user.showcheckout')
                ->with('error', $response['message'] ?? 'Lỗi thanh toán');
        }
    }

    // HỦY THANH TOÁN

    public function cancelTransaction(Request $request)
    {
        return redirect()
            ->route('user.showcheckout')
            ->with('error', $response['message'] ?? 'Bạn đã hủy giao dịch Paypal');
    }
}
