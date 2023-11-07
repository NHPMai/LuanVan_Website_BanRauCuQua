<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Exception;
use App\Http\Controllers\Controller;
use App\Models\Magiamgia;
use App\Models\NhanVien;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Session;
use \Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Validation;

use Carbon\Carbon;

class MagiamgiaController extends Controller
{

    public function index()
    {
        // $todays = new Carbon();
        // dd($todays);
        $magiamgias = Magiamgia::orderbyDesc('id')->paginate(20);
        return view('admin.coupon.list', [
            'title' => 'Danh sách mã giảm giá',
            'magiamgias' => $magiamgias,
            // 'todays' => $todays,
        ]);
    }



    public function create()
    {
        return view('admin.coupon.add', [
            'title' => 'Thêm mã giảm giá mới',
        ]);
    }




    public function store(Request $request)
    {

        $this->validate(
            $request,
            [
                'mgg_tengiamgia' => 'required',
                'mgg_magiamgia' => 'required',
                'mgg_soluongma' => 'required',
                'mgg_loaigiamgia' => 'required',
                'mgg_giatrigiamgia' => 'required',
                'mgg_ngaybatdau' => [
                    'required',
                    'date', // Đảm bảo định dạng ngày tháng hợp lệ
                    'before:mgg_ngayketthuc', // mgg_NgayBatDau phải trước mgg_NgayKetThuc
                    'after_or_equal:' . now()->format('Y-m-d\TH:i'), // mgg_NgayBatDau phải sau hoặc bằng ngày và giờ hiện tại
                ],
                'mgg_ngayketthuc' => [
                    'required',
                    'date', // Đảm bảo định dạng ngày tháng hợp lệ
                    'after:' . now()->format('Y-m-d\TH:i'), // mgg_NgayKetThuc phải sau ngày và giờ hiện tại
                ],

            ],
            [
                'mgg_tengiamgia.required' => 'Vui lòng nhập tên thương hiệu',
                'mgg_magiamgia.required' => 'Vui lòng nhập mã giảm giá',
                'mgg_soluongma.required' => 'Vui lòng nhập số lượng mã',
                'mgg_loaigiamgia.required' => 'Vui lòng nhập loại giảm giá',
                'mgg_giatrigiamgia.required' => 'Vui lòng nhập giá trị giảm giá',
                'mgg_ngaybatdau.date' => 'Định dạng ngày không hợp lệ',
                'mgg_ngaybatdau.before' => 'Ngày bắt đầu phải trước ngày kết thúc',
                'mgg_ngaybatdau.after_or_equal' => 'Ngày bắt đầu phải sau hoặc bằng ngày và giờ hiện tại',
                'mgg_ngayketthuc.required' => 'Vui lòng chọn ngày hết hạn',
                'mgg_ngayketthuc.date' => 'Định dạng ngày không hợp lệ',
                'mgg_ngayketthuc.after' => 'Ngày kết thúc phải sau ngày hiện tại',
                // 'mgg_giatrigiamgia.required' => 'Vui lòng nhập giá trị giảm',
            ]
        );

        $mgg = new Magiamgia();
        // dd($mgg);
        $mgg->mgg_tengiamgia = $request->mgg_tengiamgia;
        $mgg->mgg_magiamgia = $request->mgg_magiamgia;
        $mgg->mgg_soluongma = $request->mgg_soluongma;
        $mgg->mgg_loaigiamgia = $request->mgg_loaigiamgia;
        $mgg->mgg_giatrigiamgia = $request->mgg_giatrigiamgia;
        $mgg->mgg_ngaybatdau = $request->mgg_ngaybatdau;
        $mgg->mgg_ngayketthuc = $request->mgg_ngayketthuc;
        $mgg->save();


        // Session::flash('success', 'Thêm mã giảm giá thành công!');
        Session::flash('flash_message', 'Thêm mã giảm giá thành công!');
        return redirect('/admin/coupons/list');
    }


    public function show($id)
    {
        if (Auth::check()) {
            $id_nv = Auth::user()->id;
            $nhanvien = NhanVien::where('id', $id_nv)->first();
        }
        $magiamgia = Magiamgia::find($id);

        // dd($magiamgia);
        return view('admin.coupon.edit', [
            'magiamgia' => $magiamgia,
            'nhanvien' => $nhanvien,
            'title' => 'Chỉnh Sửa Thương Hiệu ' . $magiamgia->mgg_tengiamgia,
        ]);
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'mgg_tengiamgia' => 'required',
                'mgg_magiamgia' => 'required',
                'mgg_soluongma' => 'required',
                'mgg_loaigiamgia' => 'required',
                'mgg_giatrigiamgia' => 'required',
                'mgg_ngaybatdau' => [
                    'required',
                    'date', // Đảm bảo định dạng ngày tháng hợp lệ
                    'before:mgg_ngayketthuc', // mgg_NgayBatDau phải trước mgg_NgayKetThuc
                    'after_or_equal:' . now()->format('Y-m-d\TH:i'), // mgg_NgayBatDau phải sau hoặc bằng ngày và giờ hiện tại
                ],
                'mgg_ngayketthuc' => [
                    'required',
                    'date', // Đảm bảo định dạng ngày tháng hợp lệ
                    'after:' . now()->format('Y-m-d\TH:i'), // mgg_NgayKetThuc phải sau ngày và giờ hiện tại
                ],

            ],
            [
                'mgg_tengiamgia.required' => 'Vui lòng nhập tên thương hiệu',
                'mgg_magiamgia.required' => 'Vui lòng nhập mã giảm giá',
                'mgg_soluongma.required' => 'Vui lòng nhập số lượng mã',
                'mgg_loaigiamgia.required' => 'Vui lòng nhập loại giảm giá',
                'mgg_giatrigiamgia.required' => 'Vui lòng nhập giá trị giảm giá',
                'mgg_ngaybatdau.date' => 'Định dạng ngày không hợp lệ',
                'mgg_ngaybatdau.before' => 'Ngày bắt đầu phải trước ngày kết thúc',
                'mgg_ngaybatdau.after_or_equal' => 'Ngày bắt đầu phải sau hoặc bằng ngày và giờ hiện tại',
                'mgg_ngayketthuc.required' => 'Vui lòng chọn ngày hết hạn',
                'mgg_ngayketthuc.date' => 'Định dạng ngày không hợp lệ',
                'mgg_ngayketthuc.after' => 'Ngày kết thúc phải sau ngày hiện tại',
                // 'mgg_giatrigiamgia.required' => 'Vui lòng nhập giá trị giảm',
            ]
        );

        // $mgg = new Magiamgia();
        // // dd($mgg);
        $mgg = Magiamgia::find($id);
        $mgg->mgg_tengiamgia = $request->mgg_tengiamgia;
        $mgg->mgg_magiamgia = $request->mgg_magiamgia;
        $mgg->mgg_soluongma = $request->mgg_soluongma;
        $mgg->mgg_loaigiamgia = $request->mgg_loaigiamgia;
        $mgg->mgg_giatrigiamgia = $request->mgg_giatrigiamgia;
        $mgg->mgg_ngaybatdau = $request->mgg_ngaybatdau;
        $mgg->mgg_ngayketthuc = $request->mgg_ngayketthuc;
        $mgg->save();


        Session::flash('success', 'Cập nhật thương hiệu thành công!');
        return redirect('/admin/coupons/list');
    }

    public function destroy(Request $request): JsonResponse
    {
        $result = $this->destroy_service($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xoá Thương Thiệu Thành Công!'
            ]);
        }

        return response()->json([
            'error' => true
        ]);
    }

    public function destroy_service($request)
    {
        $id = (int) $request->input('id');

        $magiamgia = Magiamgia::where('id', $id)->first();
        if ($magiamgia) {
            return Magiamgia::where('id', $id)->delete();
        }
        return false;
    }
}
