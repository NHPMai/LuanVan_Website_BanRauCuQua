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
        'bl_parent',
        'bl_trangthai',
        'product_id',
    ];
    protected $primaryKey = 'id';
    
    public function products()
    {
        return $this->hasOne(Product::class, 'id', 'product_id')
            ->withDefault(['ten'=>'']);
    }
}
