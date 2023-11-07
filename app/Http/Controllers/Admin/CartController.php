<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donhang;
use Illuminate\Http\Request;
use App\Http\Services\CartService;
use App\Models\Cart;
use App\Models\Chitietdonhang;
use App\Models\khachhang;
use App\Models\Thongke;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Session\Session;

class CartController extends Controller
{

    public function index()
    {
        return view('admin.carts.customer', [
            'title' => 'Danh Sách Đơn Đặt Hàng',
            'donhangs' => Donhang::orderByDesc('id')->paginate(15),
        ]);
    }


    public function show(Donhang $donhang)
    {
       
        $chitietdonhang = Chitietdonhang::where('donhang_id',$donhang->id)->get();
    //    dd($chitietdonhang);
        // $chitietdonhangs = $this->getProductForCart($donhang);

        return view('admin.carts.detail', [
            'title' => 'Chi Tiết Đơn Hàng: ' . $donhang->khachhangs->hoten,
            'donhang' => $donhang,
            'chitietdonhangs' => $chitietdonhang,
        ]);
    }


    // protected function getProductForCart($donhang)
    // {
    //     // dd($customer);
       
    //     return $donhang->chitietdonhangs()->with(['product' => function ($query) {
    //         $query->select('id', 'ten', 'hinhanh');
    //     }])->get();

    // }

    
    public function update(Request $req, $id)
    {
        $order = Donhang::find($id)
            ->update(
                ['dh_trangthai' => $req->input('dh_trangthai')],
        );
       
            // $order_date = Donhang::where('id',$id)->get('dh_thoigiandathang');
           
            // $thongke = ThongKe::where('tk_Ngay',$order_date)->get();
            // if($thongke){
            //     $thongke_dem = $thongke->count();
            // }else{
            //     $thongke_dem = 0;
            // }
    
            // $total_order = 0; //tong so luong don
            // $sales = 0; //doanh thu
            // $profit = 0; //loi nhuan
            // $quantity = 0; //so luong
    
            // foreach ($order->chitietphieudathang as $detail){
            //     $product = $detail->sanpham;
            //     $quantity += $detail->ctpdh_SoLuong;
            //     $sales += $detail->ctpdh_Gia * $detail->ctpdh_SoLuong;
            //     $profit = $sales - 100000;
            // }
            // $total_order += 1;
    
            // if($thongke_dem > 0){
            //     $thongke_capnhat = ThongKe::where('tk_Ngay',$order_date)->first();
            //     $thongke_capnhat->tk_TongTien = $thongke_capnhat->tk_TogTien + $sales;
            //     $thongke_capnhat->tk_LoiNhuan = $thongke_capnhat->tk_LoiNhuan + $profit;
            //     $thongke_capnhat->tk_SoLuong = $thongke_capnhat->tk_SoLuong + $quantity;
            //     $thongke_capnhat->tk_TongDonHang = $thongke_capnhat->tk_TongDonHang + $total_order;
            //     $thongke_capnhat->save();
            // }else{
            //     $thongke_moi = new ThongKe();
            //     $thongke_moi->tk_Ngay = $order_date;
            //     $thongke_moi->tk_SoLuong = $quantity;
            //     $thongke_moi->tk_TongTien = $sales;
            //     $thongke_moi->tk_LoiNhuan = $profit;
            //     $thongke_moi->tk_TongDonHang = $total_order;
            //     $thongke_moi->save();
            // }
       
        
        
        return redirect()->back();
    }

    //TÌM KIẾM ĐƠN HÀNG

    public function searchdonhang()
    {
       
        $search_text = $_GET['query'];
        $donhangs = Donhang::where('id','LIKE','%'.$search_text.'%')
        ->onwhere('hoten','LIKE','%'.$search_text.'%')
        ->get();
        
        return view('admin.carts.searchdonhang',[
            'title' => 'Danh Sách Đơn Hàng'
        ],compact('donhangs'));
    }

    #TÌM KIẾM BẰNG GIỌNG NÓI
    public function searchProductMicrophonedonhang(Request $request)
    {
        $keyworks = $request->keywork;
        $donhangs = Donhang::where('dh_thanhtien','LIKE','%'.$keyworks.'%')->get();
        return view('admin.carts.searchdonhang',[
            'title' => 'Danh Sách Đơn Hàng'
        ],compact('donhangs'));
    }
}
