<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\UserDevice;
use App\Models\UserNotification;
use Illuminate\Http\Request;
use Redirect;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    public function notifications(Request $request)
    {
        $users = User::where('user_type_id',2)->get();
        
        return view('admin.notification.index', compact('users'));
    }

    public function sendNotification(Request $request)
    {
        $request = $request->all();
        // $deviceTokens = UserDevice::whereIn('user_id', $request['user_id'])->pluck('fcm_token')->toArray();
        $deviceTokens = UserNotification::whereIn('user_id', $request['user_id'])->get()->toArray();
        // print_r($deviceTokens);exit;
        // return Redirect::to("admin/notifications")->withSuccess('Notification sent sucessfully.');
        $credentialsFilePath = getcwd().'/urbanmantras-9fe93-firebase-adminsdk-zujj8-eab7cd47d4.json';
        $client = new \Google_Client();
        $client->setAuthConfig($credentialsFilePath);
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
        $apiurl = 'https://fcm.googleapis.com/v1/projects/urbanmantras-9fe93/messages:send';
        $client->refreshTokenWithAssertion();
        $token = $client->getAccessToken();
        $access_token = $token['access_token'];
        
        $headers = [
            "Authorization: Bearer $access_token",
            'Content-Type: application/json'
        ];
        $test_data = [
            "title" => "TITLE_HERE",
            "description" => "DESCRIPTION_HERE",
        ]; 
        
        $data['data'] =  $test_data;

        // $data['token'] = $user['fcm_token']; // Retrive fcm_token from users table
        foreach($deviceTokens as $key => $value){
            $data['token'] = $value['device_token'];
            Log::info($data['token']);
            $message = [
                "message" => [
                    "token" => $value['device_token'],  // Device token
                    "notification" => [
                        "title" => "Urban Mantras",
                        "body" => $request['notification_text'],
                    ],
                    "webpush" => [
                        "headers" => [
                            "TTL" => "4500"
                        ],
                        "notification" => [
                            "title" => "Urban Mantras",
                            "body" => $request['notification_text'],
                        ],
                    ],
                ],
            ];

            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => $apiurl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>json_encode($message),
            CURLOPT_HTTPHEADER => $headers,
            ));

            $response = curl_exec($curl);
            Log::info($response);

            curl_close($curl);
        }
        
        // print_r($res);exit;
        if(isset($res)){
            return redirect()->back()->with('message', 'Notification has been Sent');
        } else {
            return redirect()->back()->with('message', 'Notification has been Sent');
        }
    }
}