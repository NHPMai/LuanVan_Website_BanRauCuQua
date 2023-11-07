<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Nhanvien as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Nhanvien extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'hoten',
        'avata',
        'sodienthoai',
        'email',
        'gioitinh',
        'ngaysinh',
        'diachi',
        'password',
        'hoatdong',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    // public function warehousings()
    // {
    //     return $this->hasMany(Warehousing::class, 'nhanvien_id','id');
    // }
    // public function roledetail()
    // {
    //     return $this->hasOne(Roledetail::class, 'id', 'roledetail_id')
    //         ->withDefault(['coquyen'=>'']);
    // }
    
}
