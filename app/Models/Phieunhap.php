<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phieunhap extends Model
{
    use HasFactory;

    protected $fillable = [
        'nhanvien_id',
        'nhacungcap_id',
        'pn_ghichu',
        'pn_ngaylapphieu',
        'pn_ngayxacnhan',
        'pn_ngayhethan',
        'pn_tongtiennhap',
        'pn_trangthai'
    ];
    protected $primaryKey = 'id';
    public function nhanviens()
    {
        return $this->hasOne(Nhanvien::class, 'id', 'nhanvien_id')
            ->withDefault(['hoten'=>'']);
    }
    public function nhacungcaps()
    {
        return $this->hasOne(Nhacungcap::class, 'id', 'nhacungcap_id')
            ->withDefault(['ncc_ten'=>'']);
    }
}
