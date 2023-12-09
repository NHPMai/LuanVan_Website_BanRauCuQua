<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Product\ProductService;
use App\Models\Binhluan;
use App\Models\Chitietdonhang;
use App\Models\Donhang;
use App\Models\Product;
use App\Models\Menu;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
      
        // $idkh = $data['user_id'];
        // $id_sp = Product::get('id');

        // $donhang1 = DB::table('donhangs')
        //     ->where('khachhang_id', $idkh)
        //     ->join('chitietdonhangs', 'donhangs.id', '=', 'chitietdonhangs.donhang_id')
        //     ->select( 'chitietdonhangs.product_id')
        //     ->get();

        $rating = new Rating();
        $rating->product_id = $data['product_id'];
        $rating->khachhang_id = $data['user_id'];
        $rating->rating = $data['index'];
        $rating->save();
        echo 'done';
      

        // $data = $request->all();
        // $rating = new Rating();
        // $rating->product_id = $data['product_id'];
        // $rating->rating = $data['index'];
        // $rating->save();
        // echo 'done';
    }

    public function load_comment(Request $request)
    {
        $product_id = $request->product_id;
        $comment = Binhluan::where('product_id', $product_id)->where('bl_parent', '=', 0)->where('bl_trangthai', 0)->get();

        $comment_rep = Binhluan::where('bl_parent', '>', 0)->orderBy('id', 'DESC')->get();

        $output = '';
        foreach ($comment as $key => $comm) {
            $output .= '
            <div class="flex-w flex-t m-t-20">
            <input type="hidden" name="product_id" class="product_id" value="{{$product->id}}">
            <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                <img src="' . url('/template/images/nhanvien/nhansu.png') . '">
            </div>

            <div style="font-size:16px">
                <div class="flex-w flex-sb-m p-b-5 p-t-5">
                    <span class=" cl2 p-r-20" style="font-weight:700">
                        @' . $comm->bl_ten . '
                    </span>
                </div>

                <p class="cl6">
                    ' . $comm->bl_ngay . '
                </p>

                <p class=" cl6">
                    ' . $comm->binhluan . '
                </p>
            </div>
        </div>
        <p></p>
        ';

            foreach ($comment_rep as $key => $rep_comment) {
                if ($rep_comment->bl_parent == $comm->id) {

                    $output .= ' <div class="flex-w flex-t p-b-20" style="margin:5px 50px;  background-color: #F8F8F8;">
            <input type="hidden" name="product_id" class="product_id" value="{{$product->id}}">
            <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                <img width="60%" src="' . url('/template/images/icons/logocp.png') . '">
            </div>

            <div style="font-size:16px">
                <div class="flex-w flex-sb-m p-b-5 p-t-5">
                    <span class=" cl2 p-r-20" style="font-weight:700">
                        @Admin
                    </span>
                </div>

                <p class=" cl6">
                    ' . $rep_comment->binhluan . '
                </p>

                <p class=" cl6">
                  
                </p>
            </div>
        </div>
        <p></p>';
                }
            }
        }
        echo $output;
    }

    public function send_comment(Request $request)
    {
        $product_id = $request->product_id;
        $comment_name = $request->comment_name;
        $comment_content = $request->comment_content;

        $comment = new Binhluan();
        $comment->product_id = $product_id;
        $comment->binhluan = $comment_content;
        $comment->bl_ten = $comment_name;
        $comment->bl_trangthai = 1;
        $comment->bl_parent = 0;
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
