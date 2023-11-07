<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Khachhang as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class khachhang extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'hoten',
        'email',
        'password',
        'avata',
        'sodienthoai',
        'gioitinh',
        'ngaysinh',
        'diachi',
        'vip',
        'tongtienmua',
        'hoatdong'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // /**
    //  * The attributes that should be cast.
    //  *
    //  * @var array<string, string>
    //  */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];



    // //thư
    // public function carts()
    // {
    //     return $this->hasMany(Cart::class, 'customer_id', 'id');
    // }

    // // public function warehousings()
    // // {
    // //     return $this->hasMany(Warehousing::class, 'user_id','id');
    // // }
}


