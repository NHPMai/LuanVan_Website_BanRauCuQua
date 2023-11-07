<?php


namespace App\Http\Services\Product;


use App\Models\Product;

class ProductService
{
    const LIMIT = 16;

    public function get($page = null)
    {
        return Product::select('id', 'ten', 'gia', 'hinhanh')
            ->orderByDesc('id')
            ->when($page != null, function ($query) use ($page) {
                $query->offset($page * self::LIMIT);
            })
            ->where('hoatdong',1)
            ->limit(self::LIMIT)
            ->get();
    }

    public function show($id)
    {
        return Product::where('id', $id)
            ->where('hoatdong', 1)
            ->with('menu','brand')
            ->firstOrFail();
    }

    public function more($id)
    {
        return Product::select('id', 'ten', 'gia', 'hinhanh')
            ->where('hoatdong', 1)
            ->where('id', '!=', $id)
            ->orderByDesc('id')
            ->limit(8)
            ->get();
    }

}