<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\khachhang;
use App\Models\Quan_huyen;
use App\Models\Tinh_thanhpho;
use App\Models\Xa_phuong_thitran;

class KhachhangController extends Controller
{
    public function index()
    {
        $khachhangs = khachhang::orderbyDesc('id')->get();
        return view('admin.client.list', [
            'title' => 'Danh Sách Khách Hàng',
            'khachhangs' => $khachhangs,
        ]);
    }


    public function create()
    {
        $tinh_thanhpho = Tinh_thanhpho::orderby('id', 'ASC')->get();
        $quan_huyen = Quan_huyen::orderby('id', 'ASC')->get();
        $xa_phuong_thitran = Xa_phuong_thitran::orderby('id', 'ASC')->get();
        return view('admin.staff.add', [
            'title' => 'Thêm Mới Khách Hàng',
            // 'phieunhaps' => $get(),
        ])->with(compact('tinh_thanhpho'))->with(compact('quan_huyen'))->with(compact('xa_phuong_thitran'));;
    }


    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'hoten' => 'required',
                'avata' => 'required',
                'sodienthoai' => 'required',
                'email' => 'required',
                'gioitinh' => 'required',
                'ngaysinh' => 'required',
                'diachi' => 'required',
                'password' => 'required|confirmed|min:6',
                'hoatdong' => 'required',
            ],
            [
                'hoten.required' => 'Vui lòng nhập tên nhân viên',
                'avata.required' => 'Vui lòng chọn ảnh đại diện',
                'sodienthoai.required' => 'Vui lòng sodienthoai',
                'email.required' => 'Vui lòng nhập email',
                'gioitinh.required' => 'Vui lòng chọn giới tính',
                'ngaysinh.required' => 'Vui lòng nhập ngày tháng năm sinh',
                'diachi.required' => 'Vui lòng nhập địa chỉ',
                'password.required' => 'Vui lòng nhập password',
                'password.min' => 'Mật khẩu ít nhất 6 kí tự',
                'confirmed' => 'Mật khẩu không khớp',
                'hoatdong.required' => 'Vui lòng chọn trạng thái',
            ]
        );

        // $nv = new Nhanvien();
        // $nv->hoten = $request->hoten;
        // $nv->avata = $request->avata;
        // $nv->sodienthoai = $request->sodienthoai;
        // $nv->email = $request->email;
        // $nv->gioitinh = $request->gioitinh;
        // $nv->ngaysinh = $request->ngaysinh;
        // $nv->diachi = $request->diachi;
        // $nv->password = bcrypt($request->password);
        // $nv->hoatdong = $request->hoatdong;
        // $nv->save();
        $nhanvien = Nhanvien::create([
            'hoten' => $request->hoten,
            'avata' => $request->avata,
            'sodienthoai' => $request->sodienthoai,
            'email' => $request->email,
            'gioitinh' => $request->gioitinh,
            'ngaysinh' => $request->ngaysinh,
            'diachi' => $request->diachi,
            'password' => bcrypt($request->password),
            'hoatdong' => $request->hoatdong,
        ]);

        for ($quyenId = 1; $quyenId <= 5; $quyenId++) {
            Chitietquyen::create([
                'quyen_id' => $quyenId,
                'nhanvien_id' => $nhanvien->id,
                'coquyen' => 0,
            ]);
        }

        Session::flash('success', 'Thêm nhân viên thành công!');
        return redirect('admin/staffs/list');
    }
}
