<?php

namespace App\Http\Controllers\Users;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutcustomerController extends Controller
{
    public function logoutcustomer(Request $request)
    {
        // Auth::logout();
    
        // $request->session()->invalidate();
    
        // $request->session()->regenerateToken();
    
        // return redirect('/');

        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
