<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donhang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nhanvien_id',
        'khachhang_id',
        'magiamgia_id',
        'dh_thoigiandathang',
        'dh_diachigiaohang',
        'dh_thanhtien',
        'dh_giamgia',
        'dh_trangthai',
        'dh_ghichu',
    ];
    public function chitietdonhangs()
    {
        return $this->hasMany(Chitietdonhang::class, 'id','donhang_id',);
    }

    public function magiamgias()
    {
        return $this->hasOne(Magiamgia::class, 'id', 'magiamgia_id');
            // ->withDefault(['hoten'=>'']);
            // ->withDefault(['sodienthoai'=>''])
            // ->withDefault(['email'=>''])
            // ->withDefault(['diachi'=>'']);
    }

    public function khachhangs()
    {
        return $this->hasOne(khachhang::class, 'id', 'khachhang_id')
            ->withDefault(['hoten'=>'']);
            // ->withDefault(['sodienthoai'=>''])
            // ->withDefault(['email'=>''])
            // ->withDefault(['diachi'=>'']);
    }
    
}
