<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Binhluan extends Model
{
    use HasFactory;

    protected $fillable = [
        'binhluan',
        'bl_ten',
        'bl_ngay',
        'product_id'
    ];
    protected $primaryKey = 'id';
    
    // public function products()
    // {
    //     return $this->hasMany(Product::class, 'brand_id','id');
    // }
}
