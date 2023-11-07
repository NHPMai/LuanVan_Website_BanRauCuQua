<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nhanvien;
use App\Models\Phieunhap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use \Illuminate\Support\Facades\Log;

class PhieunhapController extends Controller
{
    public function index()
    {
        $get = Phieunhap::with('nhanvien');
        return view('admin.warehousing.list', [
            'title' => 'Danh Sách Phiếu Nhập',
            'phieunhaps' => $get(),
        ]);
    }

    public function create()
    {  
        $getNhanvien = Nhanvien::where('id');
        return view('admin.warehousing.add', [
            'title' => 'Thêm Phiếu Nhập mới',
            'getnhanviens' => $getNhanvien()
        ]);
        
    }

    public function store(Request $request)
    {
       
        $this->insert($request);
        return redirect()->back();;
    }

    protected function insert($request)
    {
        $isValidPrice = $this->isValidPrice($request);
        if ($isValidPrice === false) return false;

        try {
            $request->except('_token');
            Phieunhap::create($request->all());

            Session::flash('success', 'Thêm Phiếu Nhập thành công!');
        } catch (\Exception $err) {
            Session::flash('error', 'Thêm Phiếu Nhập bị lỗi!');
            Log::info($err->getMessage());
            return  false;
        }

        return  true;
    }

    protected function isValidPrice($request)
    {
        if ($request->input('ngaysanxuat') != 0 && $request->input('ngayhethan') != 0
            && $request->input('ngayhethan') < $request->input('ngaysanxuat')
        ) {
            Session::flash('error', 'Ngày hết hạn phải lớn hơn ngày sản xuất');
            return false;
        }

        if ($request->input('price_sale') != 0 && (int)$request->input('price') == 0) {
            Session::flash('error', 'Vui lòng nhập ngày sản xuất');
            return false;
        }

        return  true;
    }

    public function edit(Phieunhap $phieunhap)
    {
        return view('admin.warehousing.edit',[
            'title' => 'Chỉnh Sửa Phiếu Nhập',
            'phieunhap' => $phieunhap,
        ]);
    }

    public function update(Request $request,Phieunhap $phieunhap)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $result = $this->capnhat($request, $phieunhap);
        if ($result) {
            return redirect('/admin/warehousings/list');
        }

        return redirect()->back();
    }

    protected function capnhat($request, $product)
    {
        $isValidPrice = $this->isValidPrice($request);
        if ($isValidPrice === false) return false;

        try {
            $product->fill($request->input());
            $product->save();
            Session::flash('success', 'Cập nhật phiếu nhập thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Có lỗi vui lòng thử lại');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }

    public function delete($request)
    {
        $product = Phieunhap::where('id', $request->input('id'))->first();
        if ($product) {
            $product->delete();
            return true;
        }

        return false;
    }
}
