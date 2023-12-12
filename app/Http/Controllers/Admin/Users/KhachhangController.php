<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\khachhang;
use App\Models\Donhang;
use App\Models\Quan_huyen;
use App\Models\Tinh_thanhpho;
use App\Models\Xa_phuong_thitran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\JsonResponse;

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
        return view('admin.client.add', [
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
                'email' => 'required|email|unique:khachhangs,email|max:255',
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
                'email.unique' => 'Vui lòng nhập email khác, do email này đã tồn tại',
                'gioitinh.required' => 'Vui lòng chọn giới tính',
                'ngaysinh.required' => 'Vui lòng nhập ngày tháng năm sinh',
                'diachi.required' => 'Vui lòng nhập địa chỉ',
                'password.required' => 'Vui lòng nhập password',
                'password.min' => 'Mật khẩu ít nhất 6 kí tự',
                'confirmed' => 'Mật khẩu không khớp',
                'hoatdong.required' => 'Vui lòng chọn trạng thái',
            ]
        );

        $khachhang = khachhang::create([
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


        Session::flash('success', 'Thêm khách hàng thành công!');
        return redirect('admin/clients/list');
    }

    public function show($id)
    {
        if (Auth::check()) {
            $id_khachhang = Auth::user()->id;
            $khachhang = khachhang::where('id', $id_khachhang)->first();
        }
        $khachhang = khachhang::find($id);
        return view('admin.client.edit', [
            'khachhang' => $khachhang,
            'title' => 'Chỉnh sửa khách hàng ' . $khachhang->hoten,
        ]);
    }

    public function update(Request $request, $id)
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

        $khachhang = khachhang::find($id);
        $khachhang->hoten = $request->hoten;
        $khachhang->avata = $request->avata;
        $khachhang->sodienthoai = $request->sodienthoai;
        $khachhang->email = $request->email;
        $khachhang->gioitinh = $request->gioitinh;
        $khachhang->ngaysinh = $request->ngaysinh;
        $khachhang->diachi = $request->diachi;
        $khachhang->password = bcrypt($request->password);
        $khachhang->hoatdong = $request->hoatdong;
        $khachhang->save();

        Session::flash('success', 'Cập nhật thành công!');
        return redirect('/admin/clients/list');
    }

    protected function xoaSV($request)
    {
        $id = (int) $request->input('id');

        $khachhang = khachhang::where('id', $id)->first();
        if ($khachhang) {
            return khachhang::where('id', $id)->delete();
        }
        return false;
    }
    public function destroy(Request $request): JsonResponse
    {
        $result = $this->xoaSV($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xoá Khách hàng thành Công!'
            ]);
        }

        return response()->json([
            'error' => true
        ]);
    }

    public function chitiet($id)
    {
       
        $khachhang = khachhang::find($id);
       
        $donhang = Donhang::where('khachhang_id', $id)->orderby('id','DESC')->get();
        // dd($donhang);
        return view('admin.client.chitiet', [
            'khachhang' => $khachhang,
            'donhangs' => $donhang,
            'title' => 'Thông tin khách hàng: ' . $khachhang->hoten,
        ]);
    }

    public function active($id)
    {
        $sp = khachhang::find($id)
            ->update(
                ['hoatdong' => 1],
            );

        Session::flash('success', 'Mở khóa tài khoản khách hàng thành công!');
        // return redirect()->route('admin.staffs.edit_permission',['id' => $nv_id]);
        return redirect()->back();
    }

    public function unactive($id)
    {
        $sp = khachhang::find($id)
            ->update(
                ['hoatdong' => 0],
            );

        Session::flash('success', 'Khóa tài khoản khách hàng thành công!');
        // return redirect()->route('admin.staffs.edit_permission',['id' => $nv_id]);
        return redirect()->back();
    }
}
