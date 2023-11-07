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
        // dd($request->input());

        $this->validate($request, [
            'email' => 'required|email:filter',
            'password' => 'required'
        ]);

        $check = $request->only('email','password');
        if (Auth::guard('admin')->attempt($check)){
            return redirect()->route('admin.home')->with('success');
        } else {
            return redirect()->back()->with('error','Đăng nhập không thành công');
        }


        // if (Auth::attempt([
        //     'email' => $request->input('email'),
        //     'password' => $request->input('password'),
        //     // 'level' => 0
        // ], $request->input('remember'))) {
        //     return redirect()->route('admin');
        // }

        // // elseif (Auth::attempt([
        // //     'email' => $request->input('email'),
        // //     'password' => $request->input('password'),
        // //     'level' => 1
        // // ], $request->input('remember'))) {
        // //     return redirect()->route('user');
        // // }
        // Session::flash('error', 'Email hoặc Password không đúng');
        // return redirect()->back();
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
