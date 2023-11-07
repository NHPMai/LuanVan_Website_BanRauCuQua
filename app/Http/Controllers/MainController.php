<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Slider\SliderService;
use App\Http\Services\Menu\MenuService;
use App\Http\Services\Brand\BrandService;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Services\Product\ProductService;
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
        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];
            if ($sort_by == 'gia_giam_dan'){
                $products = Product::orderBy('gia','desc')
                    ->where('hoatdong',1)
                    ->paginate(10)->appends(request()->query());
            }
            elseif ($sort_by == 'gia_tang_dan'){
                $products = Product::orderBy('gia','asc')
                    ->where('hoatdong',1)
                    ->paginate(10)->appends(request()->query());
            }
            elseif ($sort_by == 'gia_giam_dan'){
                $products = Product::orderBy('gia','desc')
                    ->where('hoatdong',1)
                    ->paginate(10)->appends(request()->query());
            }
            elseif ($sort_by == 'ten_a_z'){
                $products = Product::orderBy('ten','desc')
                    ->where('hoatdong',1)
                    ->paginate(10)->appends(request()->query());
            }
            elseif ($sort_by == 'ten_z_a'){
                $products = Product::orderBy('gia','asc')
                    ->where('hoatdong',1)
                    ->paginate(10)->appends(request()->query());
            }
            else{
                $products = $this->product->get();
            }

        }

        return view('main', [
            'title' => 'Rau quả Vegetable Family',
            'sliders' => $this->slider->show(),
            'menus' => $this->menu->show(),
            'products' => $this->product->get(),
           
        ])->with('brands',$brand_product);
    }

        

    // public function contact()
    // {
    //     return view('contact',[
    //         'title' => 'Liên Hệ',
    //     ]);
    // }

    public function loadProduct(Request $request)
    {
        $page = $request->input('page', 0);
        $result = $this->product->get($page);
        
        if (count($result) != 0) {
            $html = view('products.list', ['products' => $result ])->render();//truyền vào view 1 biến product, biến chứa data vào render view -> html

            return response()->json([ 'html' => $html ]);
        }

        return response()->json(['html' => '' ]);
    }

    // public function testEmail()
    // {
    //     $name = 'BẠN';
    //     Mail::send('emails.test',compact('name'), function($email) use($name){
    //         $email->subject('Demo test mail');
    //         $email->to('nguyenmai16062001@gmail.com',$name);
    //     });
    // }

   
}