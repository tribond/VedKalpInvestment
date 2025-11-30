<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Product;

class DashboardController extends Controller
{

    public function __construct(){
        
    }

    public function dashboard(Request $request)
    {
        //echo '<pre>'; print_r(Auth::user()); exit;
        // $counts['dealer'] = User::where('role','dealer')->count();
        $counts['users'] = User::where('user_type_id',2)->count();
        // $counts['products'] = Product::count();
        $counts['dealer'] = 0;
        $counts['products'] = 0;
        return view('admin.dashboard',compact('counts'));   
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        //echo '<pre>'; print_r($credentials); exit;
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->intended('/admin/dashboard');
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