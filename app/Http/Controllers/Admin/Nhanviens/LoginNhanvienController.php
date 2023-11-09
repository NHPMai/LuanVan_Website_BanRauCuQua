<?php

namespace App\Http\Controllers\Admin\Nhanviens;

use App\Http\Controllers\Controller;
use App\Models\Nhanvien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginNhanvienController extends Controller
{

    public function index()
    {
        return view('admin.account.login', [
            'title' => 'Đăng nhập hệ thống'
        ]);
    }

    public function store(Request $request)
    {
        
        // $this->validate($request, [
        //     'email' => 'required|email:filter',
        //     'password' => 'required'
        // ]);

        // $check = $request->only('email','password');
        // if (Auth::guard('admin')->attempt($check)){
        //     return redirect()->route('admin.home')->with('success');
        // } else {
        //     return redirect()->back()->with('error','Đăng nhập không thành công');
        // }

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

        if (Auth::guard('admin')->attempt([
            'email' => $request->input(key: 'email'),
            'password' => $request->input(key: 'password'),
        ], $request->input(key: 'remember'))) {
            $user = Auth::guard('admin')->user();
            // Kiểm tra giá trị trangthai của người dùng
            if ($user->hoatdong == 0) {
                // Tài khoản bị khóa, hiển thị thông báo và đăng xuất
                Auth::guard('admin')->logout();
                session()->flash('error', 'Tài khoản của bạn đã bị khóa');
                return redirect()->back();
            }
            return redirect()->route('admin.home');
        }
        session()->flash('error', 'Email hoặc password không đúng !!!');
        return redirect()->back();

    }

    


    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        // $request->session()->invalidate();

        // $request->session()->regenerateToken();

        return redirect('admin.account.login');
    }


    public function sign_up(Request $req)
    {

        $nhanvien = new Nhanvien();
        $nhanvien->hoten = $req->hoten;
        $nhanvien->avata = $req->avata;
        $nhanvien->sodienthoai = $req->sodienthoai;
        $nhanvien->email = $req->email;
        $nhanvien->password = bcrypt($req->password);
        $nhanvien->gioitinh = $req->gioitinh;
        $nhanvien->ngaysinh = $req->ngaysinh;
        $nhanvien->diachi = $req->diachi;
        $nhanvien->hoatdong = $req->hoatdong;
        $nhanvien->save();
        if ($nhanvien->id) {
            return redirect('admin/users/login');
        }
        return redirect()->back();
    }
};
