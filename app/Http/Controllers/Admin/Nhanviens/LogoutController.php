<?php

namespace App\Http\Controllers\Admin\Nhanviens;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
    
        // $request->session()->invalidate();
    
        // $request->session()->regenerateToken();
    
        return redirect('/admin/login');
    }
}
