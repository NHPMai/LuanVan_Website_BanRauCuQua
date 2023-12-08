<?php

namespace App\Http\Controllers\Shipper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Models\Donhang;
use App\Models\Thongke;
use App\Models\NhanVien;
use App\Models\Chitietdonhang;
use App\Models\khachhang;

class ShipperController extends Controller
{
    public function index()
    {
        return view('shipper.account.login_shipper', [
            'title' => 'Đăng Nhập Shipper'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required|min:6|max:15'
            ],
            [
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Không đúng định dạng email',
                'email.unique' => 'Email đã được đăng kí',
                'password.required' => 'Vui lòng nhập passwod',
                'password.min' => 'Mật khẩu ít nhất 6 kí tự',
            ]
        );

        if (Auth::guard('shipper')->attempt([
            'email' => $request->input(key: 'email'),
            'password' => $request->input(key: 'password'),

        ], $request->input(key: 'remember'))) {

            $user = Auth::guard('shipper')->user();

            // Kiểm tra giá trị trangthai của người dùng
            if ($user->gh_trangthai == 0) {
                // Tài khoản bị khóa, hiển thị thông báo và đăng xuất
                Auth::guard('shipper')->logout();
                session()->flash('error', 'Tài khoản của bạn đã bị khóa');
                return redirect()->back();
            }

            return redirect()->route('shipper.home');
        }
        session()->flash('error', 'Email hoặc password không đúng !!!');
        return redirect()->back();
    }

    public function logout(Request $request)
    {
        Auth::guard('shipper')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/shipper/login');
    }


    public function home()
    {
        return view('shipper.main', [
            'title' => 'Trang Shipper',
            // 'products' => $this->productService->get(),

        ]);
    }

    public function donhang_shipper()
    {
        $id_gh = Auth::user()->id;
              
        $donhang2 = Donhang::where('dh_trangthai', 2)->where('giaohang_id',$id_gh)->orderBy('id', 'desc')->get();
        // dd($donhang2);
        return view('shipper.donhang_shipper', [
            'title' => 'Danh Sách Đơn Hàng Chờ',
            'donhang2' => $donhang2,
        ]);
    }
    public function donhang_danggiao()
    {
        $id_gh = Auth::user()->id;
        $donhang3 = Donhang::where('dh_trangthai', 3)->where('giaohang_id',$id_gh)->orderBy('id', 'desc')->get();
        // dd($donhang3);
        return view('shipper.donhang_dagiao', [
            'title' => 'Danh Sách Đơn Hàng Đang Giao',
            'donhang4' => $donhang3,
        ]);
    }

    public function donhang_dagiao()
    {
        $id_gh = Auth::user()->id;
        $donhang4 = Donhang::where('dh_trangthai', 4)->where('giaohang_id',$id_gh)->orderBy('id', 'desc')->get();
        return view('shipper.donhang_dagiao', [
            'title' => 'Danh Sách Giao Hàng Thành Công',
            'donhang4' => $donhang4,
        ]);
    }

    public function show(Donhang $donhang)
    {

        $chitietdonhang = Chitietdonhang::where('donhang_id', $donhang->id)->get();

        return view('shipper.chitietdonhang_shipper', [
            'title' => 'Chi Tiết Đơn Hàng: ' . $donhang->khachhangs->hoten,
            'donhang' => $donhang,
            'chitietdonhangs' => $chitietdonhang,
        ]);
    }

    public function update(Request $req, $id)
    {
        $order = Donhang::find($id);
       
        $id_kh = $order->khachhang_id;
        $kh = khachhang::where('id', $id_kh)->get();
        // dd($kh);
        $newStatus = $req->input('dh_trangthai');
        if ($newStatus == 3) {
            $order->dh_trangthai = $newStatus;
            $order->save();
        } elseif ($newStatus == 4) {
            $order->dh_trangthai = $newStatus;
            $order->save();


            // $name = Auth::user();
            // Mail::send('emails.test', compact('chitietdonhang', 'name'), function ($email) use ($name) {
            //     $email->subject('Cửa Hàng Vegetable Family - Xác Nhận Đơn Hàng Được Giao Thành Công');
            //     $email->to($name->email, $name->hoten);
            // });

            

            // $kh = khachhang::where('id', $id_kh)->get();
            // Mail::send('emails.giaohangthanhcong', compact('kh'), function ($email) use ($kh) {
            //     $email->subject('Cửa Hàng Vegetable Family - Giao Hàng Thành Công');
            //     $email->to($kh->email, $kh->hoten);
            // });

            // $name = Auth::user();
            // Mail::send('emails.test', compact('chitietdonhang', 'name'), function ($email) use ($name) {
            //     $email->subject('Cửa Hàng Vegetable Family - Xác Nhận Đơn Hàng');
            //     $email->to($name->email, $name->hoten);
            // });

        

            $order = Donhang::find($id);
            $order_date = $order->dh_thoigiandathang;
           
            $thongke = ThongKe::where('tk_Ngay',$order_date)->get();

            if($thongke){
                $thongke_dem = $thongke->count();
            }else{
                $thongke_dem = 0;
            }
    
            $total_order = 0; //tong so luong don
            $sales = 0; //doanh thu
            $profit = 0; //loi nhuan
            $quantity = 0; //so luong
    
            $a =$order->id;
            $ctdh = Chitietdonhang::where('donhang_id',$a)->get();
          
           
            foreach ($ctdh as $detail){
                $product = $detail->product;
                $quantity += $detail->ctdh_soluong;
                $sales += $detail->ctdh_gia * $detail->ctdh_soluong;
                // dd($sales);
                $profit = $sales - 100000;
                // dd($profit);
            }
            $total_order += 1;
    
            if($thongke_dem > 0){
                $thongke_capnhat = ThongKe::where('tk_Ngay',$order_date)->first();
                $thongke_capnhat->tk_TongTien = $thongke_capnhat->tk_TogTien + $sales;
                $thongke_capnhat->tk_LoiNhuan = $thongke_capnhat->tk_LoiNhuan + $profit;
                $thongke_capnhat->tk_SoLuong = $thongke_capnhat->tk_SoLuong + $quantity;
                $thongke_capnhat->tk_TongDonHang = $thongke_capnhat->tk_TongDonHang + $total_order;
                // dd($thongke_capnhat);
                $thongke_capnhat->save();
            }else{
                $thongke_moi = new ThongKe();
                // dd($thongke);
                $thongke_moi->tk_Ngay = $order_date;
                $thongke_moi->tk_SoLuong = $quantity;
                $thongke_moi->tk_TongTien = $sales;
                $thongke_moi->tk_LoiNhuan = $profit;
                $thongke_moi->tk_TongDonHang = $total_order;
                $thongke_moi->save();
            }


        }
        return redirect()->back();
    }

    public function huydonhang(Request $req, $id)
    {

        $detail_order = Chitietdonhang::with('product')
            ->where('donhang_id', $id)
            ->get();
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
        return redirect('shipper/donhang_danggiao');
    }
}
