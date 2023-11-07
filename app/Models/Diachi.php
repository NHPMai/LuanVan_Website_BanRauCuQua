<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diachi extends Model
{
    use HasFactory;

    protected $fillable = [
        'dc_diachi',
        'dc_trangthai',
        'khachhang_id',
        'xa_phuong_thitran_id',
        'quan_huyen_id',
        'tinh_thanhpho_id'
    ];
}
