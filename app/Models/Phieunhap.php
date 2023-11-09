<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phieunhap extends Model
{
    use HasFactory;

    protected $fillable = [
        'nhanvien_id',
        'pn_ten',
        'pn_ghichu',
        // 'pn_ngaylapphieu',
        'pn_ngayxacnhan',
        'pn_ngayhethan',
        'pn_tongtiennhap',
    ];
    public function nhanviens()
    {
        return $this->hasOne(Nhanvien::class, 'nhanvien_id', 'id')
            ->withDefault(['hoten'=>'']);
    }
    public function nhacungcaps()
    {
        return $this->hasOne(Nhacungcap::class, 'nhacungcap_id', 'id');
            // ->withDefault(['hoten'=>'']);
    }
}
