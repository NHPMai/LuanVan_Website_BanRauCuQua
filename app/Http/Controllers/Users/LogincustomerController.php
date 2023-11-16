<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Diachi;
// use App\Models\User;
use App\Models\khachhang;
use App\Models\Tinh_thanhpho;
use App\Models\Quan_huyen;
use App\Models\Xa_phuong_thitran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class LogincustomerController extends Controller
{
    public function index()
    {
        //    echo 123;
        return view('user.logincustomer', [
            'title' => 'Đăng nhập hệ thống'
        ]);
    }

    // public function store(Request $request)
    // {
    //     $this->validate($request, [
    //         'email' => 'required|email:filter',
    //         'password' => 'required'
    //     ]);
    //     $check = $request->only('email','password');
    //     if (Auth::guard('web')->attempt($check)){
    //         return redirect()->route('user.home')->with('success',);
    //     } else {
    //         return redirect()->back()->with('error','Đăng nhập không thành công');
    //     }


    //     // if (Auth::attempt([
    //     //     'email' => $request->input('email'),
    //     //     'password' => $request->input('password'),
    //     //     'level' => 0
    //     // ], $request->input('remember'))) {
    //     //     return redirect()->route('admin');
    //     // }


    //     // if (Auth::attempt([
    //     //     'email' => $request->input('email'),
    //     //     'password' => $request->input('password'),

    //     // ], $request->input('remember'))) {
    //     //     return redirect()->route('user');
    //     // }
    //     // Session::flash('error', 'Email hoặc Password không đúng');
    //     // return redirect()->back();
    // }



    public function store(Request $request)
    {
        // dd($request);
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
                'password.min' => 'Mật khẩu ít nhất 5 kí tự',
            ]
        );

        if (Auth::guard('web')->attempt([
            'email' => $request->input(key: 'email'),
            'password' => $request->input(key: 'password'),
        ], $request->input(key: 'remember'))) {
            $user = Auth::guard('web')->user();
            // Kiểm tra giá trị trangthai của người dùng
            if ($user->hoatdong == 0) {
                // Tài khoản bị khóa, hiển thị thông báo và đăng xuất
                Auth::guard('web')->logout();
                session()->flash('error', 'Tài khoản của bạn đã bị khóa');
                return redirect()->back();
            }
            return redirect()->route('user.home');
        }
        session()->flash('error', 'Email hoặc password không đúng !!!');
        return redirect()->back();
    }



    //ĐĂNG KÍ

    public function sign_up(Request $req)
    {
        $req->validate([
            'hoten' => 'required',
            'email' => 'required|email|unique:khachhangs',
            'password' => 'required|min:5|max:12',
            // 'avata'=> 'required',
            'sodienthoai' => 'required',
            'gioitinh' => 'required',
            'ngaysinh' => 'required',
            'diachi' => 'required',
            // 'vip'=>'required',
            // 'tongtienmua'=>'required',
            // 'hoatdong'=>'required',
        ]);
        $khachhang = new khachhang();
        $khachhang->hoten = $req->hoten;
        $khachhang->email = $req->email;
        $khachhang->password = bcrypt($req->password);
        // $khachhang->avata = $req->avata;
        $khachhang->sodienthoai = $req->sodienthoai;
        $khachhang->gioitinh = $req->gioitinh;
        $khachhang->ngaysinh = $req->ngaysinh;
        $khachhang->diachi = $req->diachi;
        // $khachhang->vip = $req->vip;
        // $khachhang->tongtienmua = $req->tongtienmua;
        // $khachhang->hoatdong = $req->hoatdong;
        $khachhang->save();
        if ($req) {
            return back()->with('success', 'Bạn đã đăng kí thành công!!!');
        } else {
            return back()->with('fail', 'Lỗi vui lòng đăng kí lại!');
        }

        // Session::put('khachhang_id',$khachhang);
    }

    public function register()
    {
        $tinh_thanhpho = Tinh_thanhpho::orderby('id', 'ASC')->get();
        return view('user.register', [
            'title' => 'Đăng ký',
            'tinh_thanhpho' => $tinh_thanhpho,
        ]);
    }

    public function diachi(Request $request)
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

    public function laydiachi()
    {
        $diachi = Diachi::orderby('id', 'DESC')->get();
        $output = '';

        foreach ($diachi as $key => $dc) {
            $output .= '
                  
                        <p>' . $dc->tinh_thanhpho->tp_ten . '<p>
                        <p>' . $dc->quan_huyen->qh_ten . '<p>
                        <p>' . $dc->xa_phuong_thitran->xa_ten . '</p>
                        <p>' . $dc->id . '</p>
                  
                ';
        }
        echo $output;
    }

   
}
