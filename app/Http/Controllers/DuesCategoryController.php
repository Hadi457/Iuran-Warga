<?php

namespace App\Http\Controllers;

use App\Models\DuesCategory;
use Illuminate\Http\Request;

class DuesCategoryController extends Controller
{
    public function create()
    {
        return view('Administrator.create-iuran');
    }

    public function store(Request $request)
    {
        
        $validate = $request->validate([
            'image' => 'required|image|max:3072|mimes:png,jpg,jpeg,webp',
            'period' => 'required|string',
            'nominal' => 'required|numeric',
            'status' => 'nullable|string',
        ]);
        $image = $request->file('image');
        $filename = time()."-".$request->period."-".$image->getClientOriginalExtension();
        $image->storeAs('public/image-iuran',$filename);
        $validate['created_at'] = now();
        $validate['image'] = $filename;
        DuesCategory::create($validate);

        return redirect()->route('data-iuran')->with('pesan', 'Iuran berhasil ditambahkan.');
    }
}
