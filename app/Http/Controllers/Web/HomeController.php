<?php

namespace App\Http\Controllers\Web;

use App\Helpers\AngeloneApiService;
use App\Helpers\ApiService;
use App\Models\ContactUs;
use App\Models\GeneralSettings;
use App\Models\PaymentHistory;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\SmartApiUser;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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

    public function paymentHistory()
    {
        $payments = PaymentHistory::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.payment-history', compact('payments'));
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
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        return response()->json(['status' => true, 'message' => "Login successfully."]);
    }

    public function signUp()
    {
        return view('pages.sign-up');
    }

    public function signUpSubmit(Request $request)
    {
        $validateRequest = Validator::make($request->all(), [
            "name" => "required",
            'email' => 'unique:users,email|max:64',
            "password" => "required|max:20|min:8",
            "confirm_password" => "required_with:password|same:password|max:20|min:8",
            "mobile_number" => "nullable|max:15"
        ]);

        if ($validateRequest->fails()) {
            $message = $validateRequest->errors();
            if (!empty($message)) {
                return response()->json(["status" => false, "message" => $message]);
            }
        }

        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['mobile_number'] = $request->mobile_number;
        $data['user_type_id'] = 1;
        $data['is_active'] = 1;

        $userAllData = User::create($data);
        return response()->json(["status" => true, "message" => "Signup successfully", "data" => $userAllData]);
    }

    public function dashboard()
    {
        return view('pages.dashboard');
    }

    public function contactusSubmit(Request $request)
    {
        // Validate inputs
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'nullable|string'
        ]);

        ContactUs::create($validated);

        // Admin Email
        $generalSettings = GeneralSettings::first();
        $adminEmail = $generalSettings->admin_email;

        // Send Email
        NotificationService::contactUsEnquiry(
            $adminEmail,
            $validated['name'],
            $validated['email'],
            $validated['phone'],
            $validated['subject'],
            $validated['message']
        );

        return back()->with('success', 'Thank you! Your message has been sent.');
    }

}
