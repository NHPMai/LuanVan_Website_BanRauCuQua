<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ApiController extends Controller
{
    public function search_ajax()
    {
        $data = Product::search()->get();
        // $result = [
        //     'hoatdong' =>true,
        //     'message' => 'Tìm được '.$data->count().'kết quả',
        //     'data' => $data
        // ];
        return $data;
    }
}
