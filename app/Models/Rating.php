<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $fillable = [
        "product_id",
        "rating"
    ];
    // public function chitietquyens()
    // {
    //     return $this->hasMany(chitietquyen::class, 'quyen_id','id');
    // }
}
