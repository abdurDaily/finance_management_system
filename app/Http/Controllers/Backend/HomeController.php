<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //**INDEX */
    public function index(){
        return view('dashboard');
    }

    //**LOGOUT */
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
