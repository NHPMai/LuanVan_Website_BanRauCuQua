<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Xa_phuong_thitran extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'xa_ten',
        'xa_loai',
        'quan_huyen_id',
    ];
    protected $primarykey = 'id';
    protected $table = 'xa_phuong_thitrans';
}
