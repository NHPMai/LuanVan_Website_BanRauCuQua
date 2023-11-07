<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quyen extends Model
{
    use HasFactory;

    protected $fillable = [
        "tenchucvu",
        "mota"
    ];
    public function chitietquyens()
    {
        return $this->hasMany(chitietquyen::class, 'quyen_id','id');
    }
}
