<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }
    public function authenticate(Request $request){
        $credentials = $request->validate([
        'email' => 'required',                                                         
        'password' => 'required'
        ]);

        
        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
        
                if(auth()->user()->role === "programmer"){
                    return redirect()->intended('/programmer');
                }elseif(auth()->user()->role === "koordinator"){
                    return redirect()->intended('/koordinator');
                }elseif(auth()->user()->role === "BPA"){
                    return redirect()->intended('/BPA');
                }elseif(auth()->user()->role === "pimpinan"){
                    return redirect()->intended('/pimpinan');
                }
        }
        print_r($credentials);
        return back()->with('loginError', 'Login Failed!');
    }

    public function logout(Request $request){
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/login');
    }
}
