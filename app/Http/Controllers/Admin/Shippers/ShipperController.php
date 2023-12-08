<?php

namespace App\Http\Controllers\Admin\Shippers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Giaohang;
use App\Models\Donhang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\JsonResponse;

class ShipperController extends Controller
{
    public function index()
    {
        $giaohangs = Giaohang::orderbyDesc('id')->get();
        return view('admin.shipper.list', [
            'title' => 'Danh Sách Người Giao Hàng',
            'giaohangs' => $giaohangs,
        ]);
    }

    public function create()
    {
        return view('admin.shipper.add', [
            'title' => 'Thêm Mới Giao Hàng',
            // 'phieunhaps' => $get(),
        ]);
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'gh_hoten' => 'required',
                'gh_avatar' => 'required',
                'gh_sodienthoai' => 'required',
                'email' => 'required|email|unique:giaohangs,email|max:255',
                'gh_gioitinh' => 'required',
                'gh_ngaysinh' => 'required',
                'gh_diachi' => 'required',
                'password' => 'required|confirmed|min:6',
                'gh_trangthai' => 'required',
            ],
            [
                'gh_hoten.required' => 'Vui lòng nhập tên giaohang',
                'gh_avatar.required' => 'Vui lòng chọn ảnh đại diện',
                'gh_sodienthoai.required' => 'Vui lòng số điện thoại',
                'email.required' => 'Vui lòng nhập email',
                'email.unique' => 'Vui lòng nhập email khác, do email này đã tồn tại',
                'gh_gioitinh.required' => 'Vui lòng chọn giới tính',
                'gh_ngaysinh.required' => 'Vui lòng nhập ngày tháng năm sinh',
                'gh_diachi.required' => 'Vui lòng nhập địa chỉ',
                'password.required' => 'Vui lòng nhập password',
                'password.min' => 'Mật khẩu ít nhất 6 kí tự',
                'confirmed' => 'Mật khẩu không khớp',
                'gh_trangthai.required' => 'Vui lòng chọn trạng thái',
            ]
        );

        $giaohang = Giaohang::create([
            'gh_hoten' => $request->gh_hoten,
            'gh_avatar' => $request->gh_avatar,
            'gh_sodienthoai' => $request->gh_sodienthoai,
            'email' => $request->email,
            'gh_gioitinh' => $request->gh_gioitinh,
            'gh_ngaysinh' => $request->gh_ngaysinh,
            'gh_diachi' => $request->gh_diachi,
            'password' => bcrypt($request->password),
            'gh_trangthai' => $request->gh_trangthai,
        ]);


        Session::flash('success', 'Thêm người giao hàng thành công!');
        return redirect('admin/shippers/list');
    }


    public function show($id)
    {
        if (Auth::check()) {
            $id_giaohang = Auth::user()->id;
            $giaohang = giaohang::where('id', $id_giaohang)->first();
        }
        $giaohang = giaohang::find($id);
        return view('admin.shipper.edit', [
            'giaohang' => $giaohang,
            'title' => 'Chỉnh sửa khách hàng ' . $giaohang->hoten,
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'gh_hoten' => 'required',
                'gh_avatar' => 'required',
                'gh_sodienthoai' => 'required',
                'email' => 'required',
                'gh_gioitinh' => 'required',
                'gh_ngaysinh' => 'required',
                'gh_diachi' => 'required',
                'password' => 'required|confirmed|min:6',
                'gh_trangthai' => 'required',
            ],
            [
                'gh_hoten.required' => 'Vui lòng nhập tên giao hàng',
                'gh_avatar.required' => 'Vui lòng chọn ảnh đại diện',
                'sodienthoai.required' => 'Vui lòng số điện thoại',
                'email.required' => 'Vui lòng nhập email',
                'gh_gioitinh.required' => 'Vui lòng chọn giới tính',
                'gh_ngaysinh.required' => 'Vui lòng nhập ngày tháng năm sinh',
                'gh_diachi.required' => 'Vui lòng nhập địa chỉ',
                'password.required' => 'Vui lòng nhập password',
                'password.min' => 'Mật khẩu ít nhất 6 kí tự',
                'confirmed' => 'Mật khẩu không khớp',
                'gh_trangthai.required' => 'Vui lòng chọn trạng thái',
            ]
        );

        $giaohang = giaohang::find($id);
        $giaohang->gh_hoten = $request->gh_hoten;
        $giaohang->gh_avatar = $request->gh_avatar;
        $giaohang->gh_sodienthoai = $request->gh_sodienthoai;
        $giaohang->email = $request->email;
        $giaohang->gh_gioitinh = $request->gh_gioitinh;
        $giaohang->gh_ngaysinh = $request->gh_ngaysinh;
        $giaohang->gh_diachi = $request->gh_diachi;
        $giaohang->password = bcrypt($request->password);
        $giaohang->gh_trangthai = $request->gh_trangthai;
        $giaohang->save();

        Session::flash('success', 'Cập nhật thành công!');
        return redirect('/admin/shippers/list');
    }

    protected function xoaSV($request)
    {
        $id = (int) $request->input('id');

        $giaohang = giaohang::where('id', $id)->first();
        if ($giaohang) {
            return giaohang::where('id', $id)->delete();
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
       
        $giaohang = giaohang::find($id);
       
        $donhang = Donhang::where('giaohang_id', $id)->get();
        // dd($donhang);
        return view('admin.shipper.chitiet', [
            'giaohang' => $giaohang,
            'donhangs' => $donhang,
            'title' => 'Thông tin giao hàng: ' . $giaohang->gh_hoten,
        ]);
    }

    public function active($id)
    {
        $sp = giaohang::find($id)
            ->update(
                ['gh_trangthai' => 1],
            );

        Session::flash('success', 'Mở khóa tài khoản giao hàng thành công!');
        return redirect()->back();
    }

    public function unactive($id)
    {
        $sp = giaohang::find($id)
            ->update(
                ['gh_trangthai' => 0],
            );

        Session::flash('success', 'Khóa tài khoản giao hàng thành công!');
        // return redirect()->route('admin.staffs.edit_permission',['id' => $nv_id]);
        return redirect()->back();
    }

}
