<?php

namespace App\Http\Controllers;

use App\Models\DuesCategory;
use App\Models\DuesMember;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function pilihKategori(User $user)
    {
    $tagihan = DuesMember::with('duesCategory')->where('iduser', $user->id)->get();

    if ($tagihan->isNotEmpty()) {
        return view('Administrator.detail-tagihan', [
            'user' => $user,
            'tagihan' => $tagihan
        ]);
    }
    $kategori = DuesCategory::all();
    return view('Administrator.pilih-kategori', compact('user', 'kategori'));
    }
    public function simpanKategori(Request $request, User $user)
    {
        $request->validate([
            'kategori_id' => 'required|exists:dues_categories,id',
        ]);

        DuesMember::create([
            'iduser' => $user->id,
            'dues_category_id' => $request->kategori_id,
        ]);

        return redirect()->back()->with('success', 'Kategori iuran berhasil ditambahkan!');
    }
    public function index()
    {
        $data['warga'] = Member::orderBy('created_at', 'desc')->get();
        return view('Administrator.payment', $data);
    }
}
