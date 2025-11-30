<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{


    public function __construct() {}

    public function index(Request $request)
    {
        return view('admin.users.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        //echo '<pre>'; print_r($credentials); exit;
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->intended('/admin/dashboard');
        } else {
            return redirect('/admin/login')->with('error', 'Email & Password is not correct.');
        }

        return redirect()->back()->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        return redirect('/admin/login');
        return redirect('/');
    }
}
