<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'ten',
        'gia',
        'mota',
        'noidung',
        'hinhanh',
        'soluongsp',
        'soluongban',
        'hoatdong',
        'luotxem',
        'menu_id',
        'brand_id',
    ];

    public function menu()
    {
        return $this->hasOne(Menu::class, 'id', 'menu_id')
            ->withDefault(['ten'=>'']);
    }
    public function brand()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id')
            ->withDefault(['ten'=>'']);
    }
}
