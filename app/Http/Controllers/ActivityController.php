<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    // ✅ Menampilkan halaman daftar berita
    public function index()
    {
        $activities = Activity::latest()->get();

        if (Auth::user()->level == 'Admin') {
            return view('Administrator.activity', compact('activities'));
        } elseif (Auth::user()->level == 'Warga') {
            return view('activity', compact('activities'));
        } else {
            return redirect()->route('login')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
    }

    // ✅ Menyimpan berita baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'required|string',
        ]);

        $image = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('berita'), $filename);
            $image = 'berita/'.$filename;
        }

        Activity::create([
            'name' => $request->name,
            'image' => $image,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Berita berhasil ditambahkan.');
    }

    // ✅ Update berita (edit via modal)
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'required|string',
        ]);

        $activity = Activity::findOrFail($id);

        // Cek apakah ada file baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama kalau ada
            if ($activity->image && file_exists(public_path($activity->image))) {
                unlink(public_path($activity->image));
            }

            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('berita'), $filename);
            $activity->image = 'berita/'.$filename;
        }

        $activity->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $activity->image,
        ]);

        return redirect()->back()->with('success', 'Berita berhasil diperbarui.');
    }

    // ✅ Menghapus berita
    public function destroy($id)
    {
        $activity = Activity::findOrFail($id);

        // Hapus gambar kalau ada
        if ($activity->image && file_exists(public_path($activity->image))) {
            unlink(public_path($activity->image));
        }

        $activity->delete();

        return redirect()->back()->with('success', 'Berita berhasil dihapus.');
    }
}
