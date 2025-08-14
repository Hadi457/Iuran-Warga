<?php

namespace App\Http\Controllers;

use App\Models\DuesCategory;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class DuesCategoryController extends Controller
{
    private function decryptId($id){
        try {
            return Crypt::decrypt($id);
        } catch (DecryptException $e) {
            abort(404);
        }
    }
    public function index()
    {
        $data['dues'] = DuesCategory::all();
        return view('Administrator.kategori-iuran', $data);
    }
    public function create()
    {
        return view('Administrator.create-kategori-iuran');
    }

    public function store(Request $request)
    {
        
        $validate = $request->validate([
            'period' => 'required|string',
            'nominal' => 'required|numeric',
            'status' => 'nullable|string',
        ]);
        $validate['created_at'] = now();
        DuesCategory::create($validate);

        return redirect()->route('kategori-iuran')->with('pesan', 'Iuran berhasil ditambahkan.');
    }
    public function delete($id)
    {
        $dues = DuesCategory::findOrFail($this->decryptId($id));
        $dues->delete();

        return redirect()->route('kategori-iuran')->with('pesan', 'Iuran berhasil dihapus.');
    }
    public function edit($id)
    {
        $data['dues'] = DuesCategory::findOrFail(Crypt::decrypt($id));
        return view('Administrator.edit-kategori-iuran', $data);
    }
    public function update(Request $request, $id)
    {
        $dues = DuesCategory::findOrFail(Crypt::decrypt($id));
        $validate = $request->validate([
            'period' => 'required|string',
            'nominal' => 'required|numeric',
            'status' => 'nullable|string',
        ]);
        $dues->update($validate);

        return redirect()->route('kategori-iuran')->with('pesan', 'Iuran berhasil diperbarui.');
    }
}
