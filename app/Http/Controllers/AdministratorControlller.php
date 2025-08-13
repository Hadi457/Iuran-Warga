<?php

namespace App\Http\Controllers;

use App\Models\DuesCategory;
use App\Models\User;
use Illuminate\Http\Request;

class AdministratorControlller extends Controller
{
    public function index()
    {
        $data['users'] = User::all();

        return view('administrator.dashboard', $data);
    }
    public function iuran()
    {
        $data['dues'] = DuesCategory::all();
        return view('Administrator.kategori-iuran',$data);
    }
}
