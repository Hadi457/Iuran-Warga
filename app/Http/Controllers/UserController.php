<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function auth()
    {
        return view('login');
    }
    public function authentication(Request $request){
        $validated = $request->validate([
            'username' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($validated)){
            return redirect()->intended('/')->with('pesan','Login success');
        }

        return redirect()->back()->with('pesan','login failed');
    }
    public function regist(){
        return view('regist');
    }
    public function register(Request $request){
        $request->validate([
            'name' => 'required|string',
            'username' => 'required|string|unique:users,username',
            'password' => 'required',
        ]);
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'level' => "Warga",
            'password' => bcrypt($request->password)
        ]);
        return redirect()->route('login')->with('pesanregist','Registered successfully');
    }
}
