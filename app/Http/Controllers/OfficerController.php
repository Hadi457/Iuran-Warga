<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Officer;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class OfficerController extends Controller
{
    private function decryptId($id){
        try {
            return Crypt::decrypt($id);
        } catch (DecryptException $e) {
            abort(404);
        }
    }
    public function officer()
    {
        $data['officer'] = Officer::with('member')->get();
        return view('administrator.officer', $data);
    }
    public function create()
    {
        $data['members'] = Member::all();
        return view('administrator.create-officer', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'idmember' => 'required|exists:members,id|unique:officers,idmember',
        ], [
            'idmember.unique' => 'Warga ini sudah menjadi Officer.',
        ]);

        Officer::create([
            'idmember' => $request->idmember,
        ]);

        return redirect()->route('officer')->with('success', 'Officer created successfully.');
    }
    public function edit($id)
    {
        $id = $this->decryptId($id);

        $data['officer'] = Officer::findOrFail($id);
        $data['members'] = Member::all();
        return view('Administrator.edit-officer', $data);
    }
    public function update(Request $request, $id)
    {
        $id = $this->decryptId($id);
        $officer = Officer::findOrFail($id);
        $request->validate([
            'idmember' => 'required|exists:members,id|unique:officers,idmember,' . $officer->id,
        ], [
            'idmember.unique' => 'Warga ini sudah menjadi Officer.',
        ]);

        $officer->update([
            'idmember' => $request->idmember,
        ]);

        return redirect()->route('officer')->with('success', 'Officer updated successfully.');
    }
    public function delete($id)
    {
        $id = $this->decryptId($id);

        $officer = Officer::findOrFail($id);
        $officer->delete();
        return redirect()->route('officer')->with('success', 'Officer deleted successfully.');
    }
}
