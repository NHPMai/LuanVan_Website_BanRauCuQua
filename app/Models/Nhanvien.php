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
    protected $primaryKey = 'id';
    // public function warehousings()
    // {
    //     return $this->hasMany(Warehousing::class, 'nhanvien_id','id');
    // }
    public function chitietquyen()
    {
        return $this->hasMany(Chitietquyen::class, 'id', 'chitietquyen_id')
            ->withDefault(['quyen_id'=>'']);
            // ->withDefault(['sodienthoai'=>''])
            // ->withDefault(['email'=>''])
            // ->withDefault(['diachi'=>'']);
    }
    public function phieunhap()
    {
        return $this->hasMany(Phieunhap::class, 'id', 'phieunhap_id');
            // ->withDefault(['quyen_id'=>'']);
            // ->withDefault(['sodienthoai'=>''])
            // ->withDefault(['email'=>''])
            // ->withDefault(['diachi'=>'']);
    }
    
}
