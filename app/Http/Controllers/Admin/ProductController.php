<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Services\Product\ProductAdminService;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;

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

    
    public function store(ProductRequest $request)
    {
        $this->productService->insert($request);

        return redirect()->back();
    }

    
    public function show(Product $product)
    {
        return view('admin.product.edit',[
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
        if($result){
            return redirect('/admin/products/list');
        }
        return redirect()->back();
    }

    
    public function destroy(Request $request)
    {
        $result = $this->productService->delete($request);
        if($result){
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công sản phẩm'
            ]);
        }

        return response()->json(['error' => true ]);
    }

    public function search()
    {
        
        $search_text = $_GET['query'];
        $products = Product::where('ten','LIKE','%'.$search_text.'%')->get();
        
        return view('admin.product.search',[
            'title' => 'Danh Sách Sản Phẩm'
        ],compact('products'));
    }

    #TÌM KIẾM BẰNG GIỌNG NÓI
    public function searchProductMicrophone(Request $request)
    {
        $keyworks = $request->keywork;
        $products = Product::where('ten','LIKE','%'.$keyworks.'%')->get();
        return view('admin.product.search',[
            'title' => 'Danh Sách Sản Phẩm'
        ],compact('products'));
    }
}
