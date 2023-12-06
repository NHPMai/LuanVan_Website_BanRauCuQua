<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Product\ProductService;
use App\Models\Binhluan;
use App\Models\Product;
use App\Models\Menu;
use App\Models\Rating;

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

        $rating = Rating::where('product_id', $id)->avg('rating');
        $rating = round($rating);

        return view('products.content', [
            'title' => $product->ten,
            'product' => $product,
            'products' => $productsMore
        ])->with('rating', $rating);
    }

    public function insert_rating(Request $request)
    {
        $data = $request->all();
        $rating = new Rating();
        $rating->product_id = $data['product_id'];
        $rating->rating = $data['index'];
        $rating->save();
        echo 'done';
    }

    public function load_comment(Request $request)
    {
        $product_id = $request->product_id;
        $comment = Binhluan::where('product_id', $product_id)->where('bl_trangthai', 0)->get();
        $output = '';
        foreach ($comment as $key => $comm) {
            $output.= '
            <div class="flex-w flex-t p-b-30">
            <input type="hidden" name="product_id" class="product_id" value="{{$product->id}}">
            <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                <img src="'.url('/template/images/icons/logocp.png').'">
            </div>

            <div style="font-size:16px">
                <div class="flex-w flex-sb-m p-b-5 p-t-5">
                    <span class=" cl2 p-r-20" style="font-weight:700">
                        @'.$comm->bl_ten.'
                    </span>
                </div>

                <p class=" cl6">
                    '.$comm->bl_ngay.'
                </p>

                <p class=" cl6">
                    '.$comm->binhluan.'
                </p>
            </div>
        </div>
        <p></p>
        ';
        }
        echo $output;
    }

    public function send_comment (Request $request){
        $product_id = $request->product_id;
        $comment_name = $request->comment_name;
        $comment_content = $request->comment_content;

        $comment = new Binhluan();
        $comment->product_id = $product_id;
        $comment->binhluan = $comment_content;
        $comment->bl_ten = $comment_name;
        $comment->bl_trangthai = 1;
        $comment->save();

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
        $products = Product::where('ten', 'LIKE', '%' . $search_text . '%')->get();

        return view('products.search', [
            'title' => $search_text,
        ], compact('products'));
    }

    #TÌM KIẾM BẰNG GIỌNG NÓI
    public function searchProductMicrophone(Request $request)
    {
        $keyworks = $request->keywork;
        $products = Product::where('ten', 'LIKE', '%' . $keyworks . '%')->get();
        return view('products.search', [
            'title' => $keyworks,
        ], compact('products'));
    }
}
