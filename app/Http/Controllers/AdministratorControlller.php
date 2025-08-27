<?php

namespace App\Http\Controllers;

use App\Models\DuesCategory;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;

class AdministratorControlller extends Controller
{
    public function index()
    {
        $data['users'] = User::all();
        $data['payment'] = Payment::all();

        return view('administrator.dashboard', $data);
    }
    public function category()
    {
        $data['dues'] = DuesCategory::all();
        return view('Administrator.kategori-iuran',$data);
    }
    
}
