<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chitietphieunhap extends Model
{
    use HasFactory;

    protected $fillable = [
        'phieunhap_id',
        // 'nhacungccap_id',
        'product_id',
        'ctpn_soluong',
        'ctpn_gianhap'
    ];
    public function phieunhaps()
    {
        return $this->hasOne(Phieunhap::class, 'id', 'phieunhap_id');
            // ->withDefault(['name'=>'']);
    }
    public function products()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
            // ->withDefault(['ten'=>'']);
    }

    // public function nhacungcap()
    // {
    //     return $this->hasOne(Nhacungcap::class, 'id', 'nhacungcap_id')
    //         ->withDefault(['name'=>'']);
    // }
}
