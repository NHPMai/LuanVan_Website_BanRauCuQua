<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chitietphieunhap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\JsonResponse;
use \Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\NhanVien;
use App\Models\Nhacungcap;
use App\Models\Phieunhap;
use App\Models\Product;
use Carbon\Carbon;

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

    public function show(Phieunhap $phieunhap)
    {
        $chitietphieunhap = Chitietphieunhap::where('phieunhap_id',$phieunhap->id)->get();
 
        return view('admin.warehouse.detail', [
            'title' => 'Chi Tiết Phiếu Nhập ' ,
            'phieunhap' => $phieunhap,
            'chitietphieunhap' => $chitietphieunhap,
        ]);
    }

    public function index()
    {
        $phieunhap = Phieunhap::orderby('id', 'DESC')->get();
        // dd($phieunhap);
        return view('admin.warehouse.list', [
            'title' => 'Danh Sách Phiếu Nhập',
            'phieunhap' => $phieunhap

        ]);
    }


    public function create()
    {
        if (Auth::check()) {
            $id_nv = Auth::user()->id;
            $nhanvien = NhanVien::where('id', $id_nv)->first();
            $nhacungcap = Nhacungcap::where('ncc_trangthai', 1)->get();
            // dd($nhanvien);
        }

        return view('admin.warehouse.add', [
            'title' => 'Thêm Phiếu Nhập Mới',
            'nhanvien' => $nhanvien,
            'nhacungcap' => $nhacungcap,
        ]);
    }



    public function store(Request $request)
    {
        // dd($request);
        if (Auth::check()) {
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $this->validate(
                $request,
                [
                    'nhacungcap_id' => 'required',
                ],
                [
                    'nhacungcap_id.required' => 'Vui lòng chọn nhà cung cấp',
                ]
            );

            $now = Carbon::now();
            $formattedDateTime = $now->format('Y-m-d H:i:s');


            $id_nguoidung = Auth::user()->id;
            $nhanvien = NhanVien::find($id_nguoidung);
            $id_nv = $nhanvien->id;

            $pn = new Phieunhap();

            $pn->nhanvien_id = $id_nv;
            $pn->nhacungcap_id = $request->nhacungcap_id;
            $pn->pn_ngaylapphieu = $formattedDateTime;
            $pn->pn_tongtiennhap = $request->pn_tongtiennhap;
            $pn->pn_ghichu = $request->pn_ghichu;
            $pn->pn_trangthai = 0;
            // dd($pnh);
            $pn->save();

            // Lấy id của phiếu nhập hàng mới tạo
            $phieuNhapHangId = $pn->id;

            // Lấy danh sách sản phẩm từ request
            $productPrices = $request->product_price;
            //dd($productPrices);
            $productQuantities = $request->product_quantity;

            // Duyệt qua danh sách sản phẩm và tạo chi tiết phiếu nhập hàng
            foreach ($productPrices as $productId => $price) {
                $quantity = $productQuantities[$productId];
                // Loại bỏ dấu phẩy và chuyển đổi thành số nguyên
                $price = $productPrices[$productId];
                //dd($price);
                $priceWithoutComma = str_replace('.', '', $price);

                // Tạo chi tiết phiếu nhập hàng và lưu vào cơ sở dữ liệu
                $chiTietPhieuNhap = new Chitietphieunhap();
                $chiTietPhieuNhap->phieunhap_id = $phieuNhapHangId;
                $chiTietPhieuNhap->product_id = $productId;
                $chiTietPhieuNhap->ctpn_soluong = $quantity;
                //dd($chiTietPhieuNhap);
                $chiTietPhieuNhap->ctpn_gianhap = $priceWithoutComma;
                //dd($chiTietPhieuNhap);
                $chiTietPhieuNhap->save();
            }

            Session::flash('success', 'Thêm phiếu nhập thành công!');
            return redirect('/admin/warehouses/list');
        }
    }

   

   
    public function destroy(Request $request): JsonResponse
    {
        $result = $this->xoa($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xoá Phiếu Nhập Thành Công!'
            ]);
        }

        return response()->json([
            'error' => true
        ]);
    }
    public function xoa($request)
    {
        $id = (int) $request->input('id');

        $pn = Phieunhap::where('id', $id)->first();
        if ($pn) {
            return Phieunhap::where('id', $id)->delete();
        }
        return false;
    }



    
    public function active($id)
    {
        // dd($id);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $now = Carbon::now();
        $formattedDateTime = $now->format('Y-m-d H:i:s');
        //dd($formattedDateTime);
        $warehouse = Phieunhap::find($id)
            ->update([
                'pn_trangthai' => 1,
                'pn_ngayxacnhan' => $formattedDateTime,
            ]);
        // dd($warehouse);
        // $w = Phieunhap::find($id);
        // dd($w);

        $detail_warehouses = Chitietphieunhap::with('products')
            ->where('phieunhap_id', $id)
            ->get();
        // dd($detail_warehouses);

        // Cập nhật số lượng hàng trong bảng san_phams
        foreach ($detail_warehouses as $detail_warehouse) {
            $sp = $detail_warehouse->products;
            $sp->soluongsp += $detail_warehouse->ctpn_soluong;
            $sp->save();
        }

        Session::flash('success', 'Thay đổi trạng thái thành công!');
        return redirect('/admin/warehouses/list');
    }


    public function autocomplete_ajax(Request $request)
    {
        $data = $request->all();

        if ($data['query']) {
            $product = Product::where('hoatdong', 1)
                ->where('ten', 'LIKE', '%' . $data['query'] . '%')->get();
            $output = '<ul class="dropdown-menu search-results" style="display:block; width: 50%;">';
            foreach ($product as $key => $val) {
                $imagePath = asset('' . $val->hinhanh);
                $formattedPrice = number_format($val->gia, 0, '', '.');

                $output .= '
                    <li style="display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center;">
                        <img src="' . $imagePath . '" width="50px" height="50px" style="margin-right: 10px;">
                        <div>
                            <span style="font-weight: bold;color: black">' . $val->ten . '</span><br>
                            <span style="color: red;font-weight: bold;">' . $formattedPrice . ' đ</span>
                        </div>
                        </div>
                        <button type="button" class="btn btn-primary btn-add-product"
                                data-product-id="' . $val->id . '"
                                data-product-name="' . $val->ten . '"
                              
                        >
                            Thêm
                        </button>
                    </li>
                ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    // public function autocomplete_ajax(Request $request)
    // {
    //     $data = $request->all();

    //     if ($data['query']) {
    //         $product = Product::where('hoatdong', 1)->where('ten', 'LIKE', '%' . $data['query'] . '%')->get();

    //         $output = '<ul class="dropdown-menu" style="display:block; position:relative">';

    //         foreach ($product as $key => $val) {
    //             $output .= '
    //             <li class="li_search_ajax"><a href="#">' . $val->ten . '</a></li>';
    //         }
    //         $output .= '</ul>';
    //         echo $output;
    //     }
    // }


    // public function getProductName(Request $request)
    // {
    //     $data = $request->all();
    //     $products = Product::where('hoatdong', 1)->where('ten', '=', $data['query'])->first();
    //     //    $output = '  <input  type="text" name="tensp" value="'.$products->ten.'" style="width: 150px;">';
    //     $output = $products->ten;
    //     echo $output;
    // }
    // public function getProductId(Request $request)
    // {
    //     $data = $request->all();
    //     $products = Product::where('hoatdong', 1)->where('ten', '=', $data['query'])->first();
    //     $output = $products->id;
    //     echo $output;
    // }
    // public function getProductImage(Request $request)
    // {
    //     $data = $request->all();
    //     $products = Product::where('hoatdong', 1)->where('ten', '=', $data['query'])->first();
    //     $output =  '<img class="media-object" width="80" style="margin-right: 15px" src="' . $products->hinhanh . '">';
    //     echo $output;
    // }
}
