<?php

namespace App\Http\Controllers\Web;

use App\Helpers\AngeloneApiService;
use App\Helpers\ApiService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\SmartApiUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.home');
    }
    public function about()
    {
        return view('pages.about');
    }

    public function services()
    {
        return view('pages.services');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function terms()
    {
        return view('pages.terms');
    }


    public function signIn()
    {
        return view('pages.sign-in');
    }
    public function signOut(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function signInSubmit(Request $request)
    {
        $parameters = [
            'email' => $request->email,
            'password' => $request->password
        ];
        $response = ApiService::signIn($parameters);
        if (!empty($response) && isset($response['status']) && $response['status'] == true) {
            Session::put('auth_token', $response['data']['token']);
            Auth::loginUsingId($response['data']['user']['id']);
            $angelOneUser = AngeloneApiService::getUserProfile();
            Log::info("angelOneUser", [$angelOneUser]);
            if (isset($angelOneUser['status']) && $angelOneUser['status'] == true) {
                Session::put('angel_token_alive', true);
            } else {
                Session::put('angel_token_alive', false);
            }
        }
        return $response;
    }

    public function signUp()
    {
        return view('pages.sign-up');
    }

    public function signUpSubmit(Request $request)
    {
        $parameters = $request->all();
        $response = ApiService::signUp($parameters);
        return $response;
    }

    public function dashboard()
    {
        return view('pages.dashboard');
    }

}
