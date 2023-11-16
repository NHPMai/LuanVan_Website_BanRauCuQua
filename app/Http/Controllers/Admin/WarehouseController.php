<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\NhanVien;
use App\Models\Nhacungcap;
use App\Models\Phieunhap;
use App\Models\Product;

class WarehouseController extends Controller
{
    public function getProducts()
    {
        $products = Product::where('hoatdong', 1)->get();

        $output = '<option value=""> Sản Phẩm </option>';

        foreach ($products as $key => $val) {
            $imagePath = asset('/storage/uploads/' . $val->hinhanh);
            $formattedPrice = number_format($val->gia, 0, ',', '.');
            $output .= '
            <option value="' . $val->id . '" data-image="' . $imagePath . '" data-price="' . $formattedPrice . '" >
            </option>';
        }
    }

    public function index()
    {
        $warehouse = Phieunhap::orderbyDesc('id')->get();
        return view('admin.warehouse.list', [
            'title' => 'Danh Sách Phiếu Nhập',
            'warehouse' => $warehouse
            // 'brands' => $brands,
            // 'nhanvien' => $nhanvien
        ]);
    }


    public function create()
    {
        if (Auth::check()) {
            $id_nv = Auth::user()->id;
            $nhanvien = NhanVien::where('id', $id_nv)->first();
            // dd($nhanvien);
        }

        return view('admin.warehouse.add', [
            'title' => 'Thêm Phiếu Nhập Mới',
            'nhanvien' => $nhanvien,
            'warehouse' => $this->getWarehouse(),
        ]);
    }

    public function getWarehouse()
    {
        return Nhacungcap::where('ncc_trangthai', 1)->get();
    }

    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
    }


    public function destroy($id)
    {
        //
    }

    public function autocomplete_ajax(Request $request)
    {
        $data = $request->all();

        if ($data['query']) {
            $product = Product::where('hoatdong', 1)->where('ten', 'LIKE', '%' . $data['query'] . '%')->get();

            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';

            foreach ($product as $key => $val) {
                $output .= '
                <li class="li_search_ajax"><a href="#">' . $val->ten . '</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    public function getProductName(Request $request)
    {
        $data = $request->all();
        $products = Product::where('hoatdong', 1)->where('ten', '=', $data['query'])->first();
        //    $output = '  <input  type="text" name="tensp" value="'.$products->ten.'" style="width: 150px;">';
        $output = $products->ten;
        echo $output;
    }
    public function getProductId(Request $request)
    {
        $data = $request->all();
        $products = Product::where('hoatdong', 1)->where('ten', '=', $data['query'])->first();
        $output = $products->id;
        echo $output;
    }
    public function getProductImage(Request $request)
    {
        $data = $request->all();
        $products = Product::where('hoatdong', 1)->where('ten', '=', $data['query'])->first();
        $output =  '<img class="media-object" width="50" style="margin-right: 15px" src="' . $products->hinhanh . '">';
        echo $output;
    }
}
