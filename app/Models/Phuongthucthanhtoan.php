<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phuongthucthanhtoan extends Model
{
    use HasFactory;

    protected $fillable = [
        "pttt_ten",
        "pttt_mota",
    ];

    
}
