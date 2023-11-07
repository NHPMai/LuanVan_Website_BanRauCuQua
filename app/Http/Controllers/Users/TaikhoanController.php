<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaikhoanController extends Controller
{
    public function account(){
        return view('user.taikhoan',[
            'title' => 'Tài khoản của bạn'
        ]);
    }
}
