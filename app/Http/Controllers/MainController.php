<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Slider\SliderService;
use App\Http\Services\Menu\MenuService;
use App\Http\Services\Brand\BrandService;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Services\Product\ProductService;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use tidy;

class MainController extends Controller
{
    protected $slider;
    protected $menu;
    protected $product;
    protected $brand;

    public function __construct(SliderService $slider , MenuService $menu, ProductService $product)
    {
        $this->slider = $slider;
        $this->menu = $menu;
        $this->product = $product;

        // $user = Auth::Users(); 
    }

    public function index()
    {
        $brand_product = DB::table('brands')->where('hoatdong','1')->orderBy('id','desc')->get();
        
        return view('main', [
            'title' => 'Rau quả Vegetable Family',
            'sliders' => $this->slider->show(),
            'menus' => $this->menu->show(),
            'products' => $this->product->get(),
           
        ])->with('brands',$brand_product);
    }

    const LIMIT = 16;
    public function shop( $page = null)
    { 
       
        $brand_product = DB::table('brands')->where('hoatdong','1')->orderBy('id','desc')->get();
        // $min_price = Product::min('gia');
        // $max_price = Product::max('gia');
        // $min_price_range = $min_price - 10000;
        // $max_price_range = $max_price + 20000;


        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];
            if ($sort_by == 'gia_giam_dan'){
                $products = Product::orderBy('gia','desc')
                    ->where('hoatdong',1)
                    ->where('an',1)
                    ->where('soluongsp','!=',0)
                    ->paginate(20);
            }
            elseif ($sort_by == 'gia_tang_dan'){
                $products = Product::orderBy('gia','asc')
                    ->where('hoatdong',1)
                    ->where('an',1)
                    ->where('soluongsp','!=',0)
                    ->paginate(20);
            }
            elseif ($sort_by == 'ten_a_z'){
                $products = Product::orderBy('ten','asc')
                    ->where('hoatdong',1)
                    ->where('an',1)
                    ->where('soluongsp','!=',0)
                    ->paginate(20);
            }
            elseif ($sort_by == 'ten_z_a'){
                $products = Product::orderBy('ten','desc')
                    ->where('hoatdong',1)
                    ->where('an',1)
                    ->where('soluongsp','!=',0)
                    ->paginate(20);
            }
           

        // }elseif(isset($_GET['start_price']) &&  $_GET['end_price']){
        //     $min_price = $_GET['start_price'];
        //     $max_price = $_GET['end_price'];

        //     $products = Product::whereBetween('gia',[$min_price,$max_price])->orderBy('id','ASC')->paginate(6);
        } else{
            $products = Product::select('id', 'ten', 'gia', 'hinhanh')
                ->orderByDesc('id')
                ->when($page != null, function ($query) use ($page) {
                    $query->offset($page * self::LIMIT);
                })
                ->where('hoatdong',1)
                ->where('an',1)
                ->where('soluongsp','!=',0)
                ->limit(self::LIMIT)
                ->get();
        }


        return view('shop', [
            'title' => 'Rau quả Vegetable Family',
            'sliders' => $this->slider->show(),
            'menus' => $this->menu->show(),
            // 'products' => $this->product->get(),
           
        ])->with('brands',$brand_product)
        // ->with('min_price',$min_price)->with('max_price',$max_price)
        // ->with('max_price_range', $max_price_range)
        // ->with('min_price_range', $min_price_range)
        ->with('products', $products);
    }

    public function about()
    {
        return view('about',[
            'title' => 'Giới thiệu',
        ]);
    }
        

    public function contact()
    {
        return view('contact',[
            'title' => 'Liên Hệ',
        ]);
    }

    public function loadProduct(Request $request)
    {
        // dd($request);
        $page = $request->input('page', 0);
        $result = $this->product->get($page);
        
        if (count($result) != 0) {
            $html = view('products.list', ['products' => $result ])->render();//truyền vào view 1 biến product, biến chứa data vào render view -> html

            return response()->json([ 'html' => $html ]);
        }

        return response()->json(['html' => '' ]);
    }


    public function autocomplete_ajax(Request $request){
        $data = $request->all();

        if($data['query']){
            $product = Product::where('hoatdong',1)->where('ten','LIKE','%'.$data['query'].'%')->get();

            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';

            foreach($product as $key => $val){
                $output.='
                <li class="li_search_ajax"><a href="#">'.$val->ten.'</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

   
}