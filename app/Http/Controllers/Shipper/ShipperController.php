<?php

namespace App\Http\Controllers\Shipper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Donhang;
use App\Models\NhanVien;
use App\Models\Chitietdonhang;

class ShipperController extends Controller
{
    public function index()
    {
        return view('shipper.account.login_shipper', [
            'title' => 'Đăng nhập shipper'
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


    public function home ()
    {
        return view('shipper.main',[
            'title' => 'Trang Shipper',
            // 'products' => $this->productService->get(),

        ]);
    }

    public function donhang_shipper()
    {

        $donhang2 = Donhang::where('dh_trangthai', 2)->get();
        // dd($donhang2);
        return view('shipper.donhang_shipper', [
            'title' => 'Danh Sách Đơn Hàng Chờ',
            'donhang2' => $donhang2,
        ]);
    }
    public function donhang_danggiao()
    {
        $donhang3 = Donhang::where('dh_trangthai', 3)->get();
        // dd($donhang3);
        return view('shipper.donhang_dagiao', [
            'title' => 'Danh Sách Đơn Hàng Đang Giao',
            'donhang4' => $donhang3,
        ]);
    }

    public function donhang_dagiao()
    {
        $donhang4 = Donhang::where('dh_trangthai', 4)->get();
        return view('shipper.donhang_dagiao', [
            'title' => 'Danh Sách Giao Hàng Thành Công',
            'donhang4' => $donhang4,
        ]);
    }

    public function show(Donhang $donhang)
    {
        
        $chitietdonhang = Chitietdonhang::where('donhang_id',$donhang->id)->get();
 
        return view('shipper.chitietdonhang_shipper', [
            'title' => 'Chi Tiết Đơn Hàng: ' . $donhang->khachhangs->hoten,
            'donhang' => $donhang,
            'chitietdonhangs' => $chitietdonhang,
        ]);
    }

    // public function update(Request $req, $id)
    // {
    //     $order = Donhang::find($id)
    //         ->update(
    //             ['dh_trangthai' => $req->input('dh_trangthai')],
    //     );
    //     return redirect()->back();
    // }

    public function update(Request $req, $id)
    {
        $order = Donhang::find($id);
        $newStatus = $req->input('dh_trangthai');
        if($newStatus == 3){
            $order->dh_trangthai = $newStatus;
            $order->save();
        }
        elseif($newStatus == 4){
            $order->dh_trangthai = $newStatus;
            $order->save();


        }
        return redirect()->back();
    }
}
