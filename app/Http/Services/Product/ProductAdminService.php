<?php


namespace App\Http\Services\Product;


use \Illuminate\Support\Facades\Log;
use App\Models\Menu;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class ProductAdminService
{
    public function getMenu()
    {
        return Menu::where('active', 1)->get();
    }

    public function getBrand()
    {
        return Brand::where('hoatdong', 1)->get();
    }

    protected function isValidPrice($request)
    {
        if ($request->input('gia') == 0) {
            Session::flash('error', 'Vui lòng nhập giá sản phẩm');
            return false;
        }
        return  true;
    }

    // public function insert($request)
    // {
    //     // dd($request);
    //     $isValidPrice = $this->isValidPrice($request);
    //     if ($isValidPrice === false) return false;

    //     try {
    //         $request->except('_token');
    //         Product::create($request->all());
           
    //         Session::flash('success', 'Thêm Sản phẩm thành công');
    //     } catch (\Exception $err) {
    //         Session::flash('error', 'Thêm Sản phẩm lỗi');
    //         Log::info($err->getMessage());
    //         return  false;
    //     }
    //     return  true;
    // }

    public function get()
    {
        return Product::with('menu','brand')
        ->orderBy('id', 'desc')->where('hoatdong',1)->where('an',1)->paginate(10);
    }

    public function get_destroy()
    {
        return Product::with('menu','brand')
        ->orderBy('id', 'desc')->where('hoatdong',1)->where('an',0)->paginate(10);
    }

    public function update($request, $product)
    {
        $isValidPrice = $this->isValidPrice($request);
        if ($isValidPrice === false) return false;

        try {
            $product->fill($request->input());
            $product->save();
            Session::flash('success', 'Cập nhật thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Có lỗi vui lòng thử lại');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }

    public function delete($request)
    {
        $product = Product::where('id', $request->input('id'))->first();
        if ($product) {
            $product->delete();
            return true;
        }

        return false;
    }
    
}