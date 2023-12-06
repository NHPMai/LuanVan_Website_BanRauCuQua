<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chitietdonhang extends Model
{
    use HasFactory;

    protected $fillable = [
        'donhang_id',
        'product_id',
        'ctdh_soluong',
        'ctdh_gia'
    ];
    // public function product()
    // {
    //     return $this->hasOne(Product::class, 'id', 'product_id');
          
    // }
    public function donhang()
    {
        return $this->hasOne(Donhang::class, 'id', 'donhang_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
