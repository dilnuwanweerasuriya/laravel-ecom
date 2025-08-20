<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //Admin Panel Login
    public function adminLogin(Request $request){
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }else{
                Auth::logout();
                return redirect()->route('admin.login');
            }
        }

        return redirect()->route('admin.login')->with('error','Invalid email or password');
    }

    //Admin Panel Logout
    public function adminLogout(){
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
