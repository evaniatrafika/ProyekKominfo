<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function cek() {
        if(auth()->user()->role === "programmer"){
            return redirect('/programmer');
        }elseif(auth()->user()->role === "koordinator"){
            return redirect('/koordinator');
        }elseif(auth()->user()->role === "BPA"){
            return redirect('/BPA');
        }elseif(auth()->user()->role === "pimpinan"){
            return redirect('/pimpinan');
        }
    }
}
