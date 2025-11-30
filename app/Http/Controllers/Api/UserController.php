<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserNotification;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    public function __construct()
    {
    }

    /*
     @ Function : Register(Customer Basic Details)
     @ Date     : 00-09-2023
    */
    public function register(Request $request)
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

        $create = User::create($data);
        $userId = $create->id;
        $userAllData = ["user" => User::getUserData($userId)];
        return response()->json(["status" => true, "message" => "Signup successfully", "data" => $userAllData]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('web_token')->plainTextToken;
        // Log::info('user===',[$user]);

        $userAllData = ["user" => $user, "token" => $token];
        return response()->json(['status' => true, 'message' => "Login successfully.", 'data' => $userAllData]);

    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }
    
    public function updateFcmToken(Request $request)
    {
        $user = UserNotification::where('device_token', $request->fcm_token)->first();
        if (empty($user)) {
            UserNotification::create([
                "user_id" => $request->user_id ?? NULL,
                "device_id" => $request->device_id,
                "device_token" => $request->fcm_token
            ]);
        } else {
            $user->update([
                "user_id" => $request->user_id ?? NULL,
                "device_id" => $request->device_id,
                'device_token' => $request->fcm_token
            ]);
        }
        return response()->json(['status' => true, 'message' => "FCM token updated successfully."]);
    }
}
