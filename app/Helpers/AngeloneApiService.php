<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AngeloneApiService
{
    public function __construct()
    {
    }

    public static function apiClient()
    {
        $client = Http::baseUrl(env('ANGELONE_API_BASE_URL'));

        if (!empty(Auth::user()->smartApiData)) {
            $authToken = Auth::user()->smartApiData->auth_token;
            $client->withHeaders([
                'Authorization' => 'Bearer ' . $authToken,
                'X-UserType' => 'USER',
                'X-SourceID' => 'WEB',
                'X-ClientLocalIP' => gethostbyname(gethostname()),
                'X-ClientPublicIP' => request()->ip(),
                'X-MACAddress' => 'MAC_ADDRESS',
                'X-PrivateKey' => env('ANGELONE_API_KEY'),
            ]);
        }
        
        $client->withoutVerifying()
            ->timeout(60);
        return $client;
    }

    public static function getUserProfile()
    {
        $response = self::apiClient()->get('user/v1/getProfile');
        return $response->json();
    }

}
