<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\NhanVien;

class WarehouseController extends Controller
{
    
    public function index()
    {
        // $brands = Brand::orderbyDesc('id')->paginate(20);
        return view('admin.warehouse.list',[
            'title' => 'Danh Sách Phiếu Nhập',
            // 'brands' => $brands,
            // 'nhanvien' => $nhanvien
        ]);
    }

   
    public function create()
    {
        if(Auth::check()){
            $id_nv = Auth::user()->id;
            $nhanvien = NhanVien::where( 'id',$id_nv)->first();
            // dd($nhanvien);
        }
        
        return view('admin.warehouse.add',[
        'nhanvien' => $nhanvien,
        'title' => 'Thêm Phiếu Nhập Mới'
        ]);
    }

    
    public function store(Request $request)
    {
        //
    }

   
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }
}
