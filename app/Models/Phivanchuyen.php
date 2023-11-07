<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phivanchuyen extends Model
{
    use HasFactory;

    protected $fillable = [
        'quan_huyen_id',
        'xa_phuong_thitran_id',
        'pvc_phivanchuyen',
        'tinh_thanhpho_id',
    ];

    public function tinh_thanhpho(){ //thuoc model thành phố, với mã id thanhpho tương ứng với tinh_thanhpho_id trong bảng Phivanchuyen
        return $this->belongsTo('App\Models\tinh_thanhpho','tinh_thanhpho_id'); 
    }
    public function quan_huyen(){
        return $this->belongsTo('App\Models\Quan_huyen','quan_huyen_id');
    }
    public function xa_phuong_thitran(){
        return $this->belongsTo('App\Models\xa_phuong_thitran','xa_phuong_thitran_id');
    }
}
