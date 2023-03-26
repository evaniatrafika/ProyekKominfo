<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\User;
use Illuminate\Auth\Events\Failed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function store(Request $request){
       $validateData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:255',
            'no_hp' => 'required|min:9|max:15',
            'jumlah_kinerja' => 'min:0',
            'role' => 'required'
        ]);

        $validateData['password'] = Hash::make($validateData['password']);
        User::create($validateData);
            return redirect()->back()->with('success', 'Registration Successfull!!');
    }

    public function destroy($id){
        $post   = User::find($id);
        $post->delete();
         return redirect()->back()->with('success', 'User has been deleteed!!');
    }
    public function edit($id){
        $user   = User::whereId($id)->first();
        return redirect()->back()->with('user', $user);
    }

    public function update(Request $request, $id){
        $User           = User::find($id);
        $User->name    = $request['name'];
        $User->email  = $request['email'];
        $User->password    = $request['password'];
        $User->no_hp  = $request['no_hp'];
        $User->password    = $request['password'];
        $User->no_hp  = $request['no_hp'];
        $User->jumlah_kinerja    = $request['jumlah_kinerja'];
        $User->role = $request['role'];

        $request['password'] = Hash::make($request['password']);
        $User->save();

        return redirect()->back()->with('success', 'User has been updated!!');
    }
}
