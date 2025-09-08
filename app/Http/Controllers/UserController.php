<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function contact()
    {
        return view('contact');
    }
    public function about()
    {
        return view('about');
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
            'nik' => 'required|string|unique:members,nik',
            'username' => 'required|string|unique:users,username',
            'number_handphone' => 'numeric|min:0',
            'addres' => 'required|string',
            'password' => 'required',
            'image' => 'image|mimes:png,jpg,jpeg|max:3072',
        ]);
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'level' => 'Warga',
            'password' => bcrypt($request->password)
        ]);
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time() . "-" . $request->name . "." . $image->getClientOriginalExtension();
            $image->storeAs('public/image-member', $filename);
        }else{
            $filename = "-";
        }
        Member::Create([
            'name' => $request->name,
            'nik' => $request->nik,
            'number_handphone' => $request->number_handphone,
            'addres' => $request->addres,
            'image' => $filename,
            'users_id' => $user->id,
        ]);
        return redirect()->route('data-warga')->with('succcess','Successfully added member');
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
            $data['warga'] = Member::with('user')->findOrFail($id);
            return view('Administrator.edit-warga', $data);
        }else{
            $id = $this->decryptId($id);
            $data['warga'] = Member::with('user')->findOrFail($id);
            return view('editprofil', $data);
        }
    }

    public function update(Request $request, String $id){
        if(Auth::user()->level == 'Admin'){
            $id = $this->decryptId($id);
            $validate = $request->validate([
            'name' => 'required|string',
            'nik' => 'required|string',
            'number_handphone' => 'numeric|min:0',
            'addres' => 'required|string',
            'image' => 'image|mimes:png,jpg,jpeg|max:3072',

            ]);
            $member = Member::findOrFail($id);
            $user = User::findOrFail($member->users_id);
            $user->name = $request->name;
            $user->username = $request->username;
            if($request->password){
                $user->password = bcrypt($request->password);
            }
            $user->save();
            $member->update($validate);
            return redirect()->route('data-warga')->with('pesan','successfully updated warga');
        }else{
            $id = $this->decryptId($id);
            $validate = $request->validate([
                'name' => 'required|string',
                'nik' => 'required|string',
                'username' => 'required|string',
                'number_handphone' => 'numeric|min:0',
                'addres' => 'required|string',
                'password' => 'required',
                'image' => 'image|mimes:png,jpg,jpeg|max:3072',
            ]);
            $member = Member::findOrFail($id);
            $user = User::findOrFail($member->users_id);
            if($request->hasFile('image')){
                if(Storage::exists('image-warga/' . $member->image)){
                    Storage::delete('image-warga/' . $member->image);
                }
                $image = $request->file('image');
                $filename = time() . "-" . $request->name . "." . $image->getClientOriginalExtension();
                $image->storeAs('public/image-warga', $filename);

                $validate['image'] = $filename;
            }
            $user->name = $request->name;
            $user->save();
            $member->update($validate);
            return redirect()->route('profil')->with('pesan','successfully updated profile');
        }
    }
    public function delete(String $id){
        $id = Crypt::decrypt($id);

        $member = Member::findOrFail($id);
        $member->delete();
        $user = User::find($member->users_id);
        if ($user) {
            $user->delete();
        }

        return redirect()->back()->with('success', 'Successfully deleted warga');
    }
    public function datawarga(){
        $data['warga'] = Member::orderBy('created_at', 'desc')->paginate(10);
        $data['user'] = User::paginate(10);
        return view('Administrator.warga', $data);
    }

    public function profil()
    {
        $data['warga'] = Auth::user();
            return view('profil', $data);
    }
}
