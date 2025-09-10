<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function index()
    {
        if (Auth::user()->level == 'Admin') {
            return view('Administrator.activity');
        } else if (Auth::user()->level == 'Warga') {
            return view('activity');
        } else {
            return redirect()->route('login')->with('error', 'You do not have access to this page.');
        }
    }
}
