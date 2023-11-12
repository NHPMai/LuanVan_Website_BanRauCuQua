<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(Request $request, $id, $slug = '')
    {
        $brand = $this->getId($id);
        $products = $this->getProduct($brand, $request);

        return view('brand', [
            'title' => $brand->ten,
            'products' => $products,
            'brand'  => $brand
        ]);
    }

    public function getId($id)
    {
        return Brand::where('id', $id)->where('hoatdong', 1)->firstOrFail();//đưa ID menu nếu có hiện nếu ko thì hiện lỗi 404
    }

    public function getProduct($brand, $request)
    {
        $query = $brand->products()
            ->select('id', 'ten', 'gia', 'hinhanh')
            ->where('hoatdong', 1);

        if ($request->input('gia')) {
            $query->orderBy('gia', $request->input('gia'));
        }

        return $query
            ->orderByDesc('id')
            ->paginate(12)
            ->withQueryString();
    }
}
