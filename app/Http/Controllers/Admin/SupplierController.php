<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Exception;
use App\Models\NhanVien;
use App\Models\Nhacungcap;

class SupplierController extends Controller
{
    
    public function index()
    {
        $nhacungcaps = Nhacungcap::orderbyDesc('id')->paginate(20);
        return view('admin.supplier.list',[
            'title' => 'Danh Sách Thương Hiệu Mới Nhất',
            'nhacungcaps' => $nhacungcaps,
        ]);
    }

    
    public function create()
    {
        if(Auth::check()){
            $id_nv = Auth::user()->id;
            $nhanvien = NhanVien::where( 'id',$id_nv)->first();
            // dd($nhanvien);
        }
        
        return view('admin.supplier.add',[
        'nhanvien' => $nhanvien,
        'title' => 'Thêm Nhà Cung Cấp Mới'
        ]);
    }

   
    public function store(Request $request)
    {
        $this -> validate($request, [
            'ncc_ten' => 'required',
            'ncc_email' => 'required',
            'ncc_sodienthoai' => 'required',
            'ncc_website' => 'required',
            'ncc_diachi' => 'required',
            'ncc_trangthai' => 'required',
        ],
        [
            'ncc_ten.required' => 'Vui lòng nhập tên nhà cung cấp',
            'ncc_email.required' => 'Vui lòng nhập email',
            'ncc_sodienthoai.required' => 'Vui lòng nhập số điện thoại',
            'ncc_website.required' => 'Vui lòng nhập website',
            'ncc_diachi.required' => 'Vui lòng nhập địa chỉ nhà cung cấp',
            'ncc_trangthai.required' => 'Vui lòng chọn trạng thái',
        ]);

        $ncc = new Nhacungcap();
        $ncc->ncc_ten = $request->ncc_ten;
        $ncc->ncc_email = $request->ncc_email;
        $ncc->ncc_sodienthoai = $request->ncc_sodienthoai;
        $ncc->ncc_website = $request->ncc_website;
        $ncc->ncc_diachi = $request->ncc_diachi;
        $ncc->ncc_trangthai = $request->ncc_trangthai;
        $ncc->save();

        Session::flash('success', 'Thêm nhà cung cấp thành công!');
        return redirect()->back();
    }

    
    public function show($id)
    {
        if(Auth::check()){
            $id_nv = Auth::user()->id;
            $nhanvien = NhanVien::where( 'id',$id_nv)->first();
        }
        $ncc = Nhacungcap::find($id);
        // dd($brand);
        return view('admin.supplier.edit',[
            'nhacungcap' => $ncc,
            'nhanvien' => $nhanvien,
            'title' => 'Chỉnh Sửa Nhà Cung Cấp: ' . $ncc->ncc_ten,
        ]);
    }

    
    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        $this -> validate($request, [
            'ncc_ten' => 'required',
            'ncc_email' => 'required',
            'ncc_sodienthoai' => 'required',
            'ncc_website' => 'required',
            'ncc_diachi' => 'required',
            'ncc_trangthai' => 'required',
        ],
        [
            'ncc_ten.required' => 'Vui lòng nhập tên nhà cung cấp',
            'ncc_email.required' => 'Vui lòng nhập email',
            'ncc_sodienthoai.required' => 'Vui lòng nhập số điện thoại',
            'ncc_website.required' => 'Vui lòng nhập website',
            'ncc_diachi.required' => 'Vui lòng nhập địa chỉ nhà cung cấp',
            'ncc_trangthai.required' => 'Vui lòng chọn trạng thái',
        ]);


        $ncc = Nhacungcap::find($id);

        $ncc->ncc_ten = $request->ncc_ten;
        $ncc->ncc_email = $request->ncc_email;
        $ncc->ncc_sodienthoai = $request->ncc_sodienthoai;
        $ncc->ncc_website = $request->ncc_website;
        $ncc->ncc_diachi = $request->ncc_diachi;
        $ncc->ncc_trangthai = $request->ncc_trangthai;
        $ncc->save();

        Session::flash('success', 'Cập nhật thương hiệu thành công!');
        return redirect('/admin/suppliers/list');
    }

    
    // public function destroy($id)
    // {
    //     $ncc = Nhacungcap::find($id);
    //     // dd($categoty_product);
    //     try {
    //         DB::beginTransaction();

    //         // if (count($brand->products) > 0) {
    //         //     Session::flash('error', 'Xóa thương hiệu thất bại! Thương hiệu '.$brand->ten.' đang có sản phẩm.');
    //         //     return redirect()->back();
    //         // }

    //         $ncc->destroy($ncc->id);

    //         DB::commit();
    //         Session::flash('success', 'Xóa thương hiệu thành công!');
    //         return redirect('/admin/suppliers/list');
        
    //     } catch (Exception $e) {
    //         DB::rollback();
    //         Session::flash('error', 'Xóa thương hiệu thất bại !');
    //         return redirect()->back();
    //     }
    // }

    protected function xoaSV($request)
    {
        $id = (int) $request->input('id');

        $ncc = Nhacungcap::where('id',$id)->first();
        if ($ncc){
            return Nhacungcap::where('id',$id)->delete();
        }
        return false;
    }
    public function destroy(Request $request): JsonResponse
    {
        $result = $this->xoaSV($request);
        if($result){
            return response()->json([
                'error' =>false,
                'message' =>'Xoá Nhà Cung Cấp Thành Công!'
            ]);
        }

        return response()->json([
            'error' =>true
        ]);
    }
}
