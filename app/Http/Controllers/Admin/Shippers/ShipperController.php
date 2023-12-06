<?php

namespace App\Http\Controllers\Admin\Shippers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Giaohang;

class ShipperController extends Controller
{
    public function index()
    {
        $giaohangs = Giaohang::orderbyDesc('id')->get();
        return view('admin.shipper.list', [
            'title' => 'Danh Sách Người Giao Hàng',
            'giaohangs' => $giaohangs,
        ]);
    }
}
