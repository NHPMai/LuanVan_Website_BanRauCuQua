<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magiamgia extends Model
{
    use HasFactory;

    protected $fillable = [
        'mgg_tengiamgia',
        'mgg_magiamgia',
        'mgg_soluongma',
        'mgg_loaigiamgia',
        'mgg_giatrigiamgia',
        'mgg_ngaybatdau',
        'mgg_ngayketthuc'
    ];
    public function donhangs()
    {
        return $this->hasMany(Donhang::class, 'id','donhang_id',);
    }
}
