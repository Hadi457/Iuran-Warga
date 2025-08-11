<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
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
    private function decryptId($id){
        try {
            return Crypt::decrypt($id);
        } catch (DecryptException $e) {
            abort(404);
        }
    }
    public function edit(String $id){
        if(Auth::user()->level == 'Admin'){
            $id = $this->decryptId($id);
            $data['warga'] = User::findOrFail($id);
            return view('Administrator.edit-warga', $data);
        }else{
            $id = $this->decryptId($id);
            $data['warga'] = User::findOrFail($id);
            return view('editprofil', $data);
        }
    }
    
    public function update(Request $request, String $id){
        if(Auth::user()->level == 'Admin'){
            $id = $this->decryptId($id);
            $validate = $request->validate([
                'name' => 'required|string',
                'username' => 'required|string',
                'alamat' => 'required|string',
                'no_telepon' => 'required|string',
            ]);
            $warga = User::findOrFail($id);
            if($request->password){
                $warga->password = bcrypt($request->password);
            }
            $warga->update($validate);
            return redirect()->route('data-warga')->with('success','successfully updated member');
        } else {
            $id = $this->decryptId($id);
            
            $validate = $request->validate([
                'name' => 'required|string',
                'username' => 'required|string',
                'alamat' => 'required|string',
                'no_telepon' => 'required|string',
            ]);
            $warga = User::findOrFail($id);
            $warga->update($validate);
            return redirect()->route('profil')->with('success', 'Successfully updated profile');
        }
    }
    public function delete(String $id){
        $id = $this->decryptId($id);

        $warga = User::findOrFail($id);
        $warga->delete();

        return redirect()->back()->with('success', 'Successfully deleted member');
    }
    public function datawarga(){
        $data['warga'] = User::all();
        return view('Administrator.warga', $data);
    }

    public function profil()
    {
        $data['warga'] = Auth::user();
            return view('profil', $data);
    }
}
