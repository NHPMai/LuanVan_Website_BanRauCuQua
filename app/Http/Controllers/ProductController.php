<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Product\ProductService;
use App\Models\Product;
class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index($id = '', $slug = '')
    {
        $product = $this->productService->show($id);
        $productsMore = $this->productService->more($id);

        return view('products.content', [
            'title' => $product->ten,
            'product' => $product,
            'products' => $productsMore
        ]);
    }

    public function search()
    {
        
        $search_text = $_GET['query'];
        $products = Product::where('ten','LIKE','%'.$search_text.'%')->get();
        
        return view('products.search',[
            'title' => 'Danh Sách Sản Phẩm'
        ],compact('products'));
    }

    #TÌM KIẾM BẰNG GIỌNG NÓI
    public function searchProductMicrophone(Request $request)
    {
        $keyworks = $request->keywork;
        $products = Product::where('ten','LIKE','%'.$keyworks.'%')->get();
        return view('products.search',[
            'title' => 'Danh Sách Sản Phẩm'
        ],compact('products'));
    }
}