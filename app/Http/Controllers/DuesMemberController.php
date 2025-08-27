<?php

namespace App\Http\Controllers;

use App\Models\DuesMember;
use Illuminate\Http\Request;

class DuesMemberController extends Controller
{
    public function index()
    {
        $data['anggotaiuran'] = DuesMember::with(['member', 'duesCategory'])->get();
        return view('Administrator.anggota-iuran', $data);
    }
}
