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

    // public function saveFcmToken(Request $request)
    // {
    //     $deviceId = $request->get('deviceId');
    //     $deviceToken = $request->get('token');
    //     $userId = $request->get('userId');
    //     Session::put('deviceId', $deviceId);
    //     Session::put('deviceToken', $deviceToken);
    //     $parameters = [
    //         'user_id' => $userId,
    //         'device_id' => $deviceId,
    //         'fcm_token' => $deviceToken,
    //     ];
    //     $response = ApiService::saveFcmToken($parameters);
    //     return $response;
    // }

    // public function forgotPassword()
    // {
    //     return view('pages.forgot-password');
    // }

    // public function contactUsLead(Request $request)
    // {
    //     $parameters = [
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'subject' => $request->subject,
    //         'message' => $request->message
    //     ];
    //     $response = ApiService::contactUsLead($parameters);
    //     if (!empty($response['message'])) {
    //         return array('status' => true, 'message' => 'Your message has been sent successfully. Thank you!');
    //     } else {
    //         return array('status' => false, 'message' => 'There was a problem sending your message. Please try again.');
    //     }

    // }

    public function angelOneLoginCallback(Request $request)
    {
        $data = $request->all();
        $userId = Auth::id();
        SmartApiUser::where('user_id', $userId)->delete();
        SmartApiUser::create([
            "user_id" => $userId,
            "auth_token" => $data['auth_token'],
            "feed_token" => $data['feed_token'],
            "refresh_token" => $data['refresh_token']
        ]);
        Session::put('angel_token_alive', true);

        // Check if the service is already active
        $serviceStatus = shell_exec('systemctl is-active --quiet laravel-websocket.service');

        // If the service is not active, start it
        if ($serviceStatus !== 'active') {
            shell_exec('sudo systemctl start laravel-websocket.service');
            echo "Service started.";
        } else {
            echo "Service is already running.";
        }

        return redirect(route('user-dashboard'));
    }

    public function disconnectTradingAccount(Request $request)
    {
        $userId = Auth::id();
        SmartApiUser::where('user_id', $userId)->delete();
        Session::put('angel_token_alive', false);
        return redirect(route('user-dashboard'));
    }

    // public function smartApiPostBack(Request $request)
    // {

    //     $data = $request->all();
    //     print_r($data);
    // }
}
