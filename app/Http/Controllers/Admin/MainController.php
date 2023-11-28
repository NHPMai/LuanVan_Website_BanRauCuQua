<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Admin\DB;
use App\Http\Services\Product\ProductService;
use Illuminate\Support\Facades\Auth;

use App\Models\Donhang;
use App\Models\Nhacungcap;
use App\Models\Phieunhap;
use Carbon\Carbon;
use App\Models\Thongke;

class MainController extends Controller
{
    public function index()
    {
        return view('admin.home',[
            'title' => 'Vegetables Family',
            'donhangs' => Donhang::orderByDesc('id')->get(),
            'products' => Product::orderByDesc('id')->get(),
            'suppliers' => Nhacungcap::orderByDesc('id')->get(),
            'warehouses' => Phieunhap::orderByDesc('id')->get(),
        ]);
    }



   //THỐNG KÊ
    public function days_order(Request $request){
        $sub30days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(30)->toDateString();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $get =ThongKe::whereBetween('tk_Ngay',[$sub30days,$now])->orderBy('tk_Ngay','asc')->get();

        foreach ($get as $key => $val){
            $chart_data[] = array(
                'period' => $val->tk_Ngay,
                'order' => $val->tk_TongDonHang,
                'sales' => $val->tk_TongTien,
                'profit' => $val->tk_LoiNhuan,
                'quantity' => $val->tk_SoLuong
            );
        }
        return response()->json($chart_data);
    //    echo $data = json_encode($chart_data);
    }

    public function dashboard_filter(Request $request){
        $data = $request->all();
        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dauthangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoithangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
        $quy1_start = Carbon::now('Asia/Ho_Chi_Minh')->month(1)->startOfMonth()->toDateString();
        $quy1_end = Carbon::now('Asia/Ho_Chi_Minh')->month(3)->endOfMonth()->toDateString();

        $quy2_start = Carbon::now('Asia/Ho_Chi_Minh')->month(4)->startOfMonth()->toDateString();
        $quy2_end = Carbon::now('Asia/Ho_Chi_Minh')->month(6)->endOfMonth()->toDateString();

        $quy3_start = Carbon::now('Asia/Ho_Chi_Minh')->month(7)->startOfMonth()->toDateString();
        $quy3_end = Carbon::now('Asia/Ho_Chi_Minh')->month(9)->endOfMonth()->toDateString();

        $quy4_start = Carbon::now('Asia/Ho_Chi_Minh')->month(10)->startOfMonth()->toDateString();
        $quy4_end = Carbon::now('Asia/Ho_Chi_Minh')->month(12)->endOfMonth()->toDateString();


        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
//        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        if($data['dashboard_value'] == '7ngay'){
            $get = ThongKe::whereBetween('tk_Ngay',[$sub7days,$now])->orderBy('tk_Ngay','asc')->get();
        }elseif ($data['dashboard_value'] == 'thangtruoc'){
            $get = ThongKe::whereBetween('tk_Ngay',[$dauthangtruoc,$cuoithangtruoc])->orderBy('tk_Ngay','asc')->get();
        }elseif ($data['dashboard_value'] == 'thangnay'){
            $get = ThongKe::whereBetween('tk_Ngay',[$dauthangnay,$now])->orderBy('tk_Ngay','asc')->get();
        }elseif ($data['dashboard_value'] == 'quy1'){
            $get = ThongKe::whereBetween('tk_Ngay',[$quy1_start, $quy1_end])->orderBy('tk_Ngay','asc')->get();
        }elseif ($data['dashboard_value'] == 'quy2'){
            $get = ThongKe::whereBetween('tk_Ngay',[$quy2_start, $quy2_end])->orderBy('tk_Ngay','asc')->get();
        }elseif ($data['dashboard_value'] == 'quy3'){$get = ThongKe::whereBetween('tk_Ngay',[$quy3_start, $quy3_end])->orderBy('tk_Ngay','asc')->get();
        }elseif ($data['dashboard_value'] == 'quy4'){
            $get = ThongKe::whereBetween('tk_Ngay',[$quy4_start, $quy4_end])->orderBy('tk_Ngay','asc')->get();
//        }elseif ($data['dashboard_value'] == '365ngayqua'){
//            $get = ThongKe::whereBetween('tk_Ngay',[$sub365days,$now])->orderBy('tk_Ngay','asc')->get();
        }

        foreach ($get as $key => $val){
            $chart_data[] = array(
                'period' => $val->tk_Ngay,
                'order' => $val->tk_TongDonHang,
                'sales' => $val->tk_TongTien,
                'profit' => $val->tk_LoiNhuan,
                'quantity' => $val->tk_SoLuong
            );
        }
        echo $data = json_encode($chart_data);
    //    return response()->json($chart_data);
    }

    public function filter_by_date(Request $request){
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];

        $get = ThongKe::whereBetween('tk_Ngay', [$from_date, $to_date])->orderBy('tk_Ngay', 'asc')->get();

        $chart_data = []; // Khai báo và khởi tạo biến $chart_data

        foreach ($get as $key => $val) {
            $chart_data[] = array(
                'period' => $val->tk_Ngay,
                'order' => $val->tk_TongDonHang,
                'sales' => $val->tk_TongTien,
                'profit' => $val->tk_LoiNhuan,
                'quantity' => $val->tk_SoLuong
            );
        }

        return response()->json($chart_data); // Trả về dữ liệu JSON
    }


    
}
