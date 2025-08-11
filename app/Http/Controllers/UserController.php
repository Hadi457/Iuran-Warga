<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function edit()
    {
        return view('editprofil');
    }
    public function contact()
    {
        return view('contact');
    }
    public function tata()
    {
        return view('tatatertib');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('pesan', 'You have been logged out.');
    }

    public function auth()
    {
        return view('login');
    }
    public function authentication(Request $request){
        $validated = $request->validate([
        'username' => 'required|string',
        'password' => 'required',
        ]);
        
        if (Auth::attempt($validated)) {
            $user = Auth::user();
            if ($user->level == 'Admin') {
                return redirect()->route('dashboard')->with('pesan', 'Login success as admin');
            } else if ($user->level == 'Warga') {
                return redirect()->route('home')->with('pesan', 'Login success as warga');
            } else {
                Auth::logout();
                return redirect()->route('login')->with('pesan', 'Role tidak dikenali.');
            }
        }

        return redirect()->back()->with('pesan','login failed');
    }
    public function create(){
        return view('Administrator.create-warga');
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string',
            'username' => 'required|string|unique:users,username',
            'password' => 'required',
        ]);
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);
        return redirect()->route('data-warga')->with('pesanregist','Registered successfully');
    }

    public function datawarga(){
        $data['warga'] = User::all();
        return view('Administrator.warga', $data);
    }

    public function profil()
    {
        $user = Auth::user();
        return view('profil', compact('user'));
    }
}
