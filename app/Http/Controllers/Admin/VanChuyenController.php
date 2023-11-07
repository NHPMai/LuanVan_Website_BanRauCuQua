<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quan_huyen;
use App\Models\Tinh_thanhpho;
use App\Models\Xa_phuong_thitran;
use App\Models\Phivanchuyen;
use Illuminate\Http\Request;

class VanChuyenController extends Controller
{
    public function index()
    {
       
        return view('admin.delivery.list', [
            'title' => 'Danh sách Phí Vận Chuyển',
            
        ]);
    }

    public function add()
    {
        $tinh_thanhpho = Tinh_thanhpho::orderby('id','ASC')->get();
        $quan_huyen = Quan_huyen::orderby('id','ASC')->get();
        $xa_phuong_thitran = Xa_phuong_thitran::orderby('id','ASC')->get();
        return view('admin.delivery.add', [
            'title' => 'Thêm Phí Vận Chuyển',
            
        ])->with(compact('tinh_thanhpho'))->with(compact('quan_huyen'))->with(compact('xa_phuong_thitran'));
    }

    public function select_delivery(Request $request)
    {
        $data = $request->all();
        if($data['action']){
            $output = '';
            if($data['action'] == "tinh_thanhpho"){
                $select_quanhuyen = Quan_huyen::where('tinh_thanhpho_id',$data['ma_id'])->orderby('id','ASC')->get();
                    $output.= '<option>----Chọn quận huyện----</option>';
                foreach($select_quanhuyen as $key => $quan_huyen){
                $output.='<option value="'.$quan_huyen->id.'">'.$quan_huyen->qh_ten.'</option>';
                }

            } else{
                $select_xa = Xa_phuong_thitran::where('quan_huyen_id',$data['ma_id'])->orderby('id','ASC')->get();
                    $output.= '<option>----Chọn xã phường----</option>';
                foreach($select_xa as $key => $xa){
                $output.='<option value="'.$xa->id.'">'.$xa->xa_ten.'</option>';
                }
            }
        }
        echo $output;
    }

    public function insert_delivery(Request $request)
    {
        $data = $request->all();
        $phivanchuyen = new Phivanchuyen();
        $phivanchuyen->tinh_thanhpho_id = $data['tinh_thanhpho'];
        $phivanchuyen->quan_huyen_id = $data['quan_huyen'];
        $phivanchuyen->xa_phuong_thitran_id = $data['xa_phuong_thitran'];
        $phivanchuyen->pvc_phivanchuyen = $data['phivanchuyen'];
        $phivanchuyen->save();
    }

    public function select_feeship()
    {
        $feeship = Phivanchuyen::orderby('id','DESC')->get();
        $output ='';
        $output.= '<div class="table-responsive">
            <table class="table table-bordered" style="width:80%;margin-left: 120px;">
                <thread">
                    <tr style="background-color:#80bfff; font-weight:500; font-size:20px">
                        <th>Tên thành phố</th>
                        <th>Tên quận huyện</th>
                        <th>Tên xã phường</th>
                        <th>Phí ship</th>
                    </tr>
                </thread>
                <tbody>
                ';

                foreach ($feeship as $key => $fee){
                $output.='
                    <tr>
                        <td>'.$fee->tinh_thanhpho->tp_ten.'</td>
                        <td>'.$fee->quan_huyen->qh_ten.'</td>
                        <td>'.$fee->xa_phuong_thitran->xa_ten.'</td>
                        <td contenteditable data-feeship_id="'.$fee->id.'" class="fee_feeship_edit">'.number_format($fee->pvc_phivanchuyen,0,',','.').'</td>
                    </tr>
                ';

                }
                $output .= '
                </tbody>
                </table> </div>
                ';

                echo $output;
        
    }
    //Update
    public function update_delivery(Request $request)
    {
        $data = $request->all();
        $phivanchuyen = Phivanchuyen::find($data['feeship_id']);
        $fee_value = rtrim($data['fee_value'],'.'); //Cắt dấu chấm phần nghìn
        $phivanchuyen->pvc_phivanchuyen = $fee_value;
        $phivanchuyen->save();
    }
}
