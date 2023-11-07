<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chitietquyen extends Model
{
    use HasFactory;

    protected $fillable = [
        "coquyen",
        "nhanvien_id",
        "role_id",
    ];
    
    public function nhanviens()
    {
        return $this->hasOne(Nhanvien::class, 'id', 'nhanvien_id');
    }
    public function quyens()
    {
        return $this->hasOne(Quyen::class, 'id', 'quyen_id');
    }
}
