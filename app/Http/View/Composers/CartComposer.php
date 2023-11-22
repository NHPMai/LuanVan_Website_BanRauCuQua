<?php


namespace App\Http\View\Composers;

use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CartComposer
{
    protected $users;

    public function __construct()
    {
    }

   

    // public function compose(View $view)
    // {
    //     $carts = Session::get('carts');
    //    if(is_null($carts)) {
    //         $products =[];
    //     }
    //     else{
    //     $productId = array_keys($carts);
    //    $products = Product::select('id', 'name', 'price', 'price_sale', 'thumnb')
    //         ->where('active', 1)
    //         ->whereIn('id', $productId)
    //         ->get();

    // }
    //     $view->with('products',$products);

    // }

    public function compose(View $view)
    {
        $chitietdonhangs = Session::get('chitietdonhangs');
       if(is_null($chitietdonhangs)) {
            $products =[];
        }
        else{
        $productId = array_keys($chitietdonhangs);
       $products = Product::select('id', 'ten', 'gia', 'hinhanh')
            ->where('hoatdong', 1)
            ->whereIn('id', $productId)
            ->get();

    }
        $view->with('products',$products);

    }

}