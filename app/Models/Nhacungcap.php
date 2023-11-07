<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nhacungcap extends Model
{
    use HasFactory;

    protected $fillable = [
        'ncc_ten',
        'ncc_email',
        'ncc_sodienthoai',
        'ncc_website',
        'ncc_diachi',
        'ncc_trangthai',
    ];
}
