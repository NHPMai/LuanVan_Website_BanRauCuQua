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
        return $this->hasOne(Menu::class, 'id', 'menu_id');
    }
    public function brand()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }

    public function scopeSearch($query){
        if(request('key')){
            $key = request('key');
            $query = $query->where('ten','like','%'.$key.'%');
        }
        if (request('menu_id')){
            $query = $query->where('menu_id',request('menu_id'));
        }
        return $query;
    }
}
