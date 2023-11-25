<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Diachi;
use App\Models\khachhang;
use Illuminate\Http\Request;
use App\Models\Tinh_thanhpho;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaikhoanController extends Controller
{
    public function account()
    {
        $tinh_thanhpho = Tinh_thanhpho::orderby('id', 'ASC')->get();
        return view('user.taikhoan', [
            'title' => 'Tài khoản của bạn',
            'tinh_thanhpho' => $tinh_thanhpho,
        ]);
    }

    public function diachikhachhang()
    {
        $tinh_thanhpho = Tinh_thanhpho::orderby('id', 'ASC')->get();
        return view('user.diachi', [
            'title' => 'Địa Chỉ Của Bạn',
            'tinh_thanhpho' => $tinh_thanhpho,
        ]);
    }

    public function insert_address(Request $request)
    {
        $data = $request->all();
        $diachi = new Diachi();
        $diachi->khachhang_id = Auth::user()->id;
        $diachi->tinh_thanhpho_id = $data['tinh_thanhpho'];
        $diachi->quan_huyen_id = $data['quan_huyen'];
        $diachi->xa_phuong_thitran_id = $data['xa_phuong_thitran'];
        $diachi->dc_diachi = $data['dc_diachi'];
        // $diachi->macdinh = $request->macdinh;
       
        $diachi->save();
    }

    // public function load_address()
    // {
    //     $diachi = Diachi::orderby('id', 'DESC')->get();
    //     // $khachhang = khachhang::orderby('id', 'DESC')->get();
    //     // $diachi = Diachi::where('khachhang_id',$khachhang->id)->get();

    //     $output = '';

    //     foreach ($diachi as $key => $dc) {
    //         $output .= $dc->dc_diachi .','. $dc->xa_phuong_thitran->xa_ten .', '. $dc->quan_huyen->qh_ten .', '. $dc->tinh_thanhpho->tp_ten ;
    //     }


    //     echo $output;
    // }


    public function load_address(khachhang $khachhang)
    {
        $idkh = Auth::user()->id;
        $khachhang = khachhang::find($idkh);
        $a = $khachhang->id;
        $diachi = Diachi::where('khachhang_id',$a)->get();
        $output = '';


        foreach ($diachi as $key => $dc) {
            $output .= '
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="website">Địa chỉ<span class="text-danger">(*)</span></label>
                        <input style=" width: 300px; " disabled type="name" class="form-control" id="Street" placeholder="' . $dc->dc_diachi . ',' . $dc->xa_phuong_thitran->xa_ten . ', ' . $dc->quan_huyen->qh_ten . ', ' . $dc->tinh_thanhpho->tp_ten . '">
                    </div>
                </div>
                ';
        }
        $output .= '
                </tbody>
                </table> </div>
                ';

        echo $output;
    }
}
