<?php

namespace App\Http\Controllers;

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
        return view('administrator.iuran');
    }
}
