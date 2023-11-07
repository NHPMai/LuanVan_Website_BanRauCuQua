<?php


namespace App\Http\Services\Brand;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrandService
{
    // public function getParent()
    // {
    //     return Menu::where('parent_id',0)->get();
    // }

    public function show()
    {
        return Brand::select('ten','id')
            ->orderbyDesc('id')
            ->get();
    }

    public function getAll()
    {
        return Brand::orderbyDesc('id')->paginate(20);
    }

    public function create($request)
    {
        // dd ($request->input('content'));
        try{
            
            Brand::create([
                'ten' => (string) $request->input('ten'),
                'mota' => (string) $request->input('mota'),
                'hoatdong' => (string) $request->input('hoatdong'),
            ]);

            Session::flash('success','Tạo Thương Hiệu Thành Công');
        }catch (\Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
        }
        return true;
    }


    public function update($request, $brand) : bool
    {    
        $brand->ten = (string) $request->input('ten');
        $brand->mota = (string) $request->input('mota');
        $brand->hoatdong = (string) $request->input('hoatdong');
        $brand->save();

        Session::flash('success', 'Cập nhật thành công Danh Mục');
        return true;
    }

    public function destroy($request)
    {
        $id = (int) $request->input('id');

        $brand = Brand::where('id',$id)->first();
        if ($brand){
            return Brand::where('id',$id)->delete();
        }
        return false;
    }

    public function getId($id)
    {
        return Brand::where('id', $id)->where('active', 1)->firstOrFail();//đưa ID menu nếu có hiện nếu ko thì hiện lỗi 404
    }

    // public function getProduct($menu, $request)
    // {
    //     $query = $menu->products()
    //         ->select('id', 'name', 'price', 'price_sale', 'thumnb')
    //         ->where('active', 1);

    //     if ($request->input('price')) {
    //         $query->orderBy('price', $request->input('price'));
    //     }

    //     return $query
    //         ->orderByDesc('id')
    //         ->paginate(12)
    //         ->withQueryString();
    // }
}