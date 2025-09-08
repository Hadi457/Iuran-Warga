<?php

namespace App\Http\Controllers;

use App\Models\DuesCategory;
use App\Models\Officer;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;

class AdministratorControlller extends Controller
{
    public function index()
    {
        $data['users'] = User::all();
        $data['payment'] = Payment::all();
        $data['dues'] = DuesCategory::all();
        $data['officers'] = Officer::all();
        $data['recentPayments'] = Payment::with('member') // ikut load relasi member
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();

    return view('administrator.dashboard', $data);

        return view('administrator.dashboard', $data);
    }
    public function category()
    {
        $data['dues'] = DuesCategory::all();
        return view('Administrator.kategori-iuran',$data);
    }
    
}
