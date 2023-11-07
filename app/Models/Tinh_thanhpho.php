<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tinh_thanhpho extends Model
{
    use HasFactory;

    protected $fillable = [
        'tp_ten',
        'tp_loai',
    ]; 
    protected $primarykey = 'id';
    protected $table = 'tinh_thanhphos';
}
