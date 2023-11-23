<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Giaohang as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Giaohang extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'gh_hoten',
        'gh_avatar',
        'gh_sodienthoai',
        'gh_gioitinh',
        'gh_diachi',
        'password',
        'email',
        'gh_trangthai',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $primaryKey = 'id';
}
