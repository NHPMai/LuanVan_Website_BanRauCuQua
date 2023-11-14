<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\CreateFormRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Services\Brand\BrandService;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\NhanVien;

use Exception;

class BrandController extends Controller
{
    protected $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }



    public function destroy(Request $request): JsonResponse
    {
        $result = $this->brandService->destroy($request);
        if($result){
            return response()->json([
                'error' =>false,
                'message' =>'Xoá Thương Thiệu Thành Công!'
            ]);
        }

        return response()->json([
            'error' =>true
        ]);
    }

    public function index()
    {
        // if(Auth::check()){
        //     $id_nv = Auth::user()->id;
        //     $nhanvien = NhanVien::where('id', $id_nv)->first();
        //     // dd($nhanvien);
        // }
        // $brands = Brand::all()->sortByDesc("id")->paginate(20);
        $brands = Brand::orderbyDesc('id')->get();
        return view('admin.brand.list',[
            'title' => 'Danh Sách Thương Hiệu Mới Nhất',
            'brands' => $brands,
            // 'nhanvien' => $nhanvien
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::check()){
            $id_nv = Auth::user()->id;
            $nhanvien = NhanVien::where( 'id',$id_nv)->first();
            // dd($nhanvien);
        }
        
        return view('admin.brand.add',[
        'nhanvien' => $nhanvien,
        'title' => 'Thêm Thương Hiệu Mới'
        ]);
    }

   
    public function store(Request $request)
    {
        
        $this -> validate($request, [
            'ten' => 'required',
            'mota' => 'required',
            'hoatdong' => 'required',
        ],
        [
            'ten.required' => 'Vui lòng nhập tên thương hiệu',
            'mota.required' => 'Vui lòng nhập mô tả',
            'hoatdong.required' => 'Vui lòng chọn trạng thái',
        ]);

        $thsp = new Brand();
        $thsp->ten = $request->ten;
        $thsp->mota = $request->mota;
        $thsp->hoatdong = $request->hoatdong;
        $thsp->save();

        Session::flash('success', 'Thêm thương hiệu thành công!');
        return redirect()->back();
    }

   
    public function show($id)
    {
        if(Auth::check()){
            $id_nv = Auth::user()->id;
            $nhanvien = NhanVien::where( 'id',$id_nv)->first();
        }
        $brand = Brand::find($id);
        // dd($brand);
        return view('admin.brand.edit',[
            'brand' => $brand,
            'nhanvien' => $nhanvien,
            'title' => 'Chỉnh Sửa Thương Hiệu ' . $brand->ten,
        ]);
    }

   
    public function update(Request $request, $id)
    {
        $this -> validate($request, [
            'ten' => 'required',
            'mota' => 'required',
            'hoatdong' => 'required',
        ],
            [
                'ten.required' => 'Vui lòng nhập tên thương hiệu',
                'mota.required' => 'Vui lòng nhập mô tả',
                'hoatdong.required' => 'Vui lòng chọn trạng thái',
            ]);


        $brand = Brand::find($id);

        $brand->ten = $request->ten;
        $brand->mota = $request->mota;
        $brand->hoatdong = $request->hoatdong;
        $brand->save();

        Session::flash('success', 'Cập nhật thương hiệu thành công!');
        return redirect('/admin/brands/list');
    }

    
    // public function destroy($id)
    // {
    //     $brand = Brand::find($id);
    //     // dd($categoty_product);
    //     try {
    //         DB::beginTransaction();

    //         if (count($brand->products) > 0) {
    //             Session::flash('error', 'Xóa thương hiệu thất bại! Thương hiệu '.$brand->ten.' đang có sản phẩm.');
    //             return redirect()->back();
    //         }

    //         $brand->destroy($brand->id);

    //         DB::commit();
    //         Session::flash('success', 'Xóa thương hiệu thành công!');
    //         return redirect('admin.brand.list');
        
    //     } catch (Exception $e) {
    //         DB::rollback();
    //         Session::flash('error', 'Xóa thương hiệu thất bại !');
    //         return redirect()->back();
    //     }
    // }

    public function active($id)
    {
        $brand = Brand::find($id)
            ->update(
                ['hoatdong' => 0],
        );
        // $product_status = SanPham::where('thuong_hieu_id', $id)->update(['sp_TrangThai' => 0]);
        Session::flash('success', 'Thay đổi trạng thái thành công!');
        return redirect('edit/{brand}');
    }

    public function unactive($id)
    {
        $brand = Brand::find($id)
            ->update(
                ['hoatdong' => 1],
        );
        // $product_status = SanPham::where('thuong_hieu_id', $id)->update(['sp_TrangThai' => 1]);
        Session::flash('success', 'Thay đổi trạng thái thành công!');
        return redirect('edit/{brand}');
    }

   
}
