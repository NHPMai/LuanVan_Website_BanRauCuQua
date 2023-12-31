<?php

namespace App\Http\Controllers\Admin\Nhanviens;

use App\Http\Controllers\Controller;
use App\Models\Chitietquyen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\JsonResponse;
use App\Models\Quan_huyen;
use App\Models\Tinh_thanhpho;
use App\Models\Xa_phuong_thitran;
use App\Models\Nhanvien;
use App\Models\Quyen;

class NhanvienController extends Controller
{

    public function index()
    {
        $nhanviens = Nhanvien::orderbyDesc('id')->get();
        return view('admin.staff.list', [
            'title' => 'Danh Sách Nhân Viên',
            'nhanviens' => $nhanviens,
        ]);
    }


    public function create()
    {
        $tinh_thanhpho = Tinh_thanhpho::orderby('id', 'ASC')->get();
        $quan_huyen = Quan_huyen::orderby('id', 'ASC')->get();
        $xa_phuong_thitran = Xa_phuong_thitran::orderby('id', 'ASC')->get();
        return view('admin.staff.add', [
            'title' => 'Thêm Mới Nhân Viên',
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
                'email' => 'required|email|unique:nhanviens,email|max:255',
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



    public function show($id)
    {
        if (Auth::check()) {
            $id_nv = Auth::user()->id;
            $nhanvien = NhanVien::where('id', $id_nv)->first();
        }
        $nhanvien = Nhanvien::find($id);
        return view('admin.staff.edit', [
            'nhanvien' => $nhanvien,
            'title' => 'Chỉnh Sửa nhân viên ' . $nhanvien->hoten,
        ]);
    }


    public function edit($id)
    {
        //
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

        $nv = Nhanvien::find($id);
        $nv->hoten = $request->hoten;
        $nv->avata = $request->avata;
        $nv->sodienthoai = $request->sodienthoai;
        $nv->email = $request->email;
        $nv->gioitinh = $request->gioitinh;
        $nv->ngaysinh = $request->ngaysinh;
        $nv->diachi = $request->diachi;
        $nv->password = bcrypt($request->password);
        $nv->hoatdong = $request->hoatdong;
        $nv->save();

        Session::flash('success', 'Cập nhật thành công!');
        return redirect('/admin/staffs/list');
    }


    protected function xoaSV($request)
    {
        $id = (int) $request->input('id');

        $nhanvien = Nhanvien::where('id', $id)->first();
        if ($nhanvien) {
            return Nhanvien::where('id', $id)->delete();
        }
        return false;
    }
    public function destroy(Request $request): JsonResponse
    {
        $result = $this->xoaSV($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xoá Nhà Cung Cấp Thành Công!'
            ]);
        }

        return response()->json([
            'error' => true
        ]);
    }

    public function permission()
    {

        $nhanvien = Nhanvien::all()->sortByDesc("id");
        $chitietquyen = Chitietquyen::get();
        // dd($chitietquyen);
        return view('admin.staff.permission', [
            'title' => 'Danh Sách Phân Quyền Nhân Viên',
            'nhanvien' => $nhanvien,
            'chitietquyen' => $chitietquyen,
        ]);
    }

    public function edit_permission($id)
    {
        $nhanvien1 = Nhanvien::join('chitietquyens', 'nhanviens.id', '=', 'chitietquyens.nhanvien_id')
            ->where('nhanvien_id', $id)
            ->where('quyen_id', 1)->first();

        $nhanvien2 = Nhanvien::join('chitietquyens', 'nhanviens.id', '=', 'chitietquyens.nhanvien_id')
            ->where('nhanvien_id', $id)
            ->where('quyen_id', 2)->first();

        $nhanvien3 = Nhanvien::join('chitietquyens', 'nhanviens.id', '=', 'chitietquyens.nhanvien_id')
            ->where('nhanvien_id', $id)
            ->where('quyen_id', 3)->first();

        $nhanvien4 = Nhanvien::join('chitietquyens', 'nhanviens.id', '=', 'chitietquyens.nhanvien_id')
            ->where('nhanvien_id', $id)
            ->where('quyen_id', 4)->first();

        $nhanvien5 = Nhanvien::join('chitietquyens', 'nhanviens.id', '=', 'chitietquyens.nhanvien_id')
            ->where('nhanvien_id', $id)
            ->where('quyen_id', 5)->first();

        $nhanvien = Nhanvien::where('id',$id)->first();

        // dd($nhanvien1);
        $ctq = Chitietquyen::where('nhanvien_id', $id)->first();
        // dd($ctq);

        return view('admin.staff.edit_permission', [
            'title' => 'Phân Quyền Nhân Viên',
            'nhanvien' => $nhanvien,
            'nhanvien1' => $nhanvien1,
            'nhanvien2' => $nhanvien2,
            'nhanvien3' => $nhanvien3,
            'nhanvien4' => $nhanvien4,
            'nhanvien5' => $nhanvien5,
            'ctq' => $ctq,
        ]);
    }

    public function coquyen($id)
    {
        $chitietquyen = Chitietquyen::find($id);
        $nv_id = $chitietquyen->nhanvien_id;
        $chitietquyen = Chitietquyen::find($id)
            ->update(
                ['coquyen' => 0],
            );

        Session::flash('success', 'Thay đổi quyền thành công!');
        // return redirect()->route('admin.staffs.edit_permission',['id' => $nv_id]);
        return redirect()->back();
    }

    public function khongquyen($id)
    {
        $chitietquyen = Chitietquyen::find($id);
        $nv_id = $chitietquyen->nhanvien_id;
        $chitietquyen = Chitietquyen::find($id)
            ->update(
                ['coquyen' => 1],
            );

        Session::flash('success', 'Thay đổi quyền thành công!');
        // return redirect()->route('admin.staffs.edit_permission',['id' => $nv_id]);
        return redirect()->back();
    }


    
    public function active($id)
    {
        $sp = Nhanvien::find($id)
            ->update(
                ['hoatdong' => 1],
            );

        Session::flash('success', 'Mở khóa tài khoản khách hàng thành công!');
        return redirect()->back();
    }

    public function unactive($id)
    {
        $sp = Nhanvien::find($id)
            ->update(
                ['hoatdong' => 0],
            );

        Session::flash('success', 'Khóa tài khoản khách hàng thành công!');
        return redirect()->back();
    }
}
