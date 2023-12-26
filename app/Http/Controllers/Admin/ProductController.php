<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Services\Product\ProductAdminService;
use App\Models\Binhluan;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use \Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{

    protected $productService;

    public function __construct(ProductAdminService $productService)
    {
        $this->productService = $productService;
    }


    public function index()
    {
        return view('admin.product.list', [
            'title' => 'Danh Sách Sản Phẩm',
            'products' => $this->productService->get(),
            'brands' => $this->productService->get()
        ]);
    }

    public function create()
    {
        // $brand_product = DB::table('brands')->where('hoatdong','1')->orderBy('id','desc')->get();
        return view('admin.product.add', [
            'title' => 'Thêm Sản Phẩm Mới',
            'menus' => $this->productService->getMenu(),
            'brands' => $this->productService->getBrand()
        ]);
        // return 'tao';
    }

    public function list_destroy()
    {
        return view('admin.product.list_destroy', [
            'title' => 'Danh Sách Sản Phẩm',
            'products' => $this->productService->get_destroy(),
            'brands' => $this->productService->get()
        ]);
    }

    // public function store(ProductRequest $request)
    // {
    //     $this->productService->insert($request);
    //     return redirect()->back();
    // }

    public function store(Request $request)
    {
        $isValidPrice = $this->isValidPrice($request);
        if ($isValidPrice === false) return false;

        try {
            $request->except('_token');
            // Product::create($request->all());
            $this->validate(
                $request,
                [
                    'ten' => 'required',
                    'gia' => 'required',
                    'menu_id' => 'required',
                    'brand_id' => 'required',
                    'noidung' => 'required',
                    'hinhanh' => 'required',
                    'hoatdong' => 'required',
                ],
                [
                    'ten.required' => 'Vui lòng nhập tên sản phẩm',
                    'gia.required' => 'Vui lòng nhập giá sản phẩm',
                    'menu_id.required' => 'Vui lòng chọn danh mục sản phẩm',
                    'brand_id.required' => 'Vui lòng chọn thương hiệu sản phẩm',
                    'hinhanh.required' => 'Vui lòng nhập hình ảnh sản phẩm',
                    'hoatdong.required' => 'Vui lòng chọn trạng thái',
                ]
            );

            $sp = new Product();

            $sp->ten = $request->ten;
            $sp->gia = $request->gia;
            $sp->mota = $request->mota;
            $sp->menu_id = $request->menu_id;
            $sp->brand_id = $request->brand_id;
            $sp->noidung = $request->noidung;
            $sp->soluongsp = 0;
            $sp->an = 1;
            $sp->hinhanh = $request->hinhanh;
            $sp->hoatdong = $request->hoatdong;
            $sp->save();

            Session::flash('success', 'Thêm Sản phẩm thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Thêm Sản phẩm lỗi');
            Log::info($err->getMessage());
            return  false;
        }


        return redirect()->back();
    }

    protected function isValidPrice($request)
    {

        if ($request->input('gia') == 0) {
            Session::flash('error', 'Vui lòng nhập giá sản phẩm');
            return false;
        }

        return  true;
    }


    public function show(Product $product)
    {
        return view('admin.product.edit', [
            'title' => 'Chỉnh Sửa Sản Phẩm',
            'product' => $product,
            'menus' => $this->productService->getMenu(),
            'brands' => $this->productService->getBrand()
        ]);
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, Product $product)
    {
        $result =  $this->productService->update($request, $product);
        if ($result) {
            return redirect('/admin/products/list');
        }
        return redirect()->back();
    }


    // public function destroy(Request $request)
    // {
    //     $result = $this->productService->delete($request);
    //     if($result){
    //         return response()->json([
    //             'error' => false,
    //             'message' => 'Xóa thành công sản phẩm'
    //         ]);
    //     }

    //     return response()->json(['error' => true ]);
    // }

    // public function active($id)
    // {
    //     // $product = Product::find($id);
    //     // dd($sp);
    //     $product = Product::find($id)
    //         ->update(
    //             ['an' => 0,]
    //         );

    //     // $product_status = SanPham::where('thuong_hieu_id', $id)->update(['sp_TrangThai' => 0]);
    //     Session::flash('success', 'Thay đổi trạng thái thành công!');
    //     return redirect('/admin/products/active/{id}');
    // }

    public function active($id)
    {
        $sp = Product::find($id)
            ->update(
                ['an' => 1],
            );

        Session::flash('success', 'Mở khóa sản phẩm thành công!');
        // return redirect()->route('admin.staffs.edit_permission',['id' => $nv_id]);
        return redirect()->back();
    }

    public function unactive($id)
    {
        $sp = Product::find($id)
            ->update(
                ['an' => 0],
            );

        Session::flash('success', 'Xóa sản phẩm thành công!');
        // return redirect()->route('admin.staffs.edit_permission',['id' => $nv_id]);
        return redirect()->back();
    }


    public function list_comment(){
        $comment = Binhluan::where('bl_parent','=',0)->orderBy('id','DESC')->get();
        $comment_rep = Binhluan::where('bl_parent','>',0)->orderBy('id','DESC')->get();
        // dd($comment);
        return view('admin.comment.list_comment',[
            'title' => 'Danh sách bình luận',
            'comment' => $comment,
            'comment_rep' => $comment_rep,
        ]);
    }

    public function allow_comment(Request $request){
        $data = $request->all();
        $comment = Binhluan::find( $data['comment_id']);
        $comment->bl_trangthai = $data['comment_status'];
        $comment->save();
    }

    public function reply_comment(Request $request){
        $data = $request->all();
        $comment = new Binhluan();
        $comment->binhluan = $data['comment'];
        $comment->product_id = $data['comment_product_id'];
        $comment->bl_parent = $data['comment_id'];
        $comment->bl_trangthai = 0;
        $comment->bl_ten = 'Vegetables Family';
        $comment->save();
    }

    public function destroy($request)
    {
        $id = (int) $request->input('id');

        $binhluan = Binhluan::where('id',$id)->first();
        if ($binhluan){
            return Binhluan::where('id',$id)->delete();
        }
        return false;
    }

    public function xoa_comment(Request $request): JsonResponse
    {
        $result = $this->destroy($request);
        if($result){
            return response()->json([
                'error' =>false,
                'message' =>'Xoá Bình Luận Thành Công!'
            ]);
        }

        return response()->json([
            'error' =>true
        ]);
    }




    public function search()
    {

        $search_text = $_GET['query'];
        $products = Product::where('ten', 'LIKE', '%' . $search_text . '%')->get();

        return view('admin.product.search', [
            'title' => 'Danh Sách Sản Phẩm'
        ], compact('products'));
    }

    #TÌM KIẾM BẰNG GIỌNG NÓI
    public function searchProductMicrophone(Request $request)
    {
        $keyworks = $request->keywork;
        $products = Product::where('ten', 'LIKE', '%' . $keyworks . '%')->get();
        return view('admin.product.search', [
            'title' => 'Danh Sách Sản Phẩm'
        ], compact('products'));
    }

}
