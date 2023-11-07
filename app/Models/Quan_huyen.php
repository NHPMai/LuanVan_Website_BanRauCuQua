<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quan_huyen extends Model
{
    use HasFactory;

    protected $fillable = [
        'qh_ten',
        'qh_loai',
        'tinh_thanhpho_id'
    ];
    protected $primarykey = 'id';
    protected $table = 'quan_huyens';
}
