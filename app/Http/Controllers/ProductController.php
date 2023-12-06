<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Product\ProductService;
use App\Models\Product;
use App\Models\Menu;
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
        $productsMore = $this->more($id);

        return view('products.content', [
            'title' => $product->ten,
            'product' => $product,
            'products' => $productsMore
        ]);
    }


    public function more($id)
    {
//         $a = Product::select('id', 'ten', 'gia', 'hinhanh')
//             ->where('hoatdong', 1)
//             ->where('an', 1)
//             // ->where('menu_id', $menu)
//             ->where('id', '!=', $id)
//             ->orderByDesc('id')
//             ->limit(8)
//             ->get();

//         $menu = Menu::where('id',$id)->first();
// dd($a);
        return Product::select('id', 'ten', 'gia', 'hinhanh')
        ->where('hoatdong', 1)
        ->where('an', 1)
        // ->where('menu_id', $menu)
        ->where('id', '!=', $id)
        ->orderByDesc('id')
        ->limit(8)
        ->get();
    }


    public function search()
    {
        
        $search_text = $_GET['query'];
        $products = Product::where('ten','LIKE','%'.$search_text.'%')->get();
        
        return view('products.search',[
            'title' => $search_text,
        ],compact('products'));
    }

    #TÌM KIẾM BẰNG GIỌNG NÓI
    public function searchProductMicrophone(Request $request)
    {
        $keyworks = $request->keywork;
        $products = Product::where('ten','LIKE','%'.$keyworks.'%')->get();
        return view('products.search',[
            'title' => $keyworks,
        ],compact('products'));
    }
}