<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class ApiService
{
    public function __construct()
    {
    }

    public static function apiClient()
    {
        $client = Http::baseUrl(env('API_BASE_URL'))
            ->withHeaders([
                'Content-Type' => 'application/json',
                'device_id' => getDeviceId(),
                'device_token' => getDeviceToken()
            ])
            ->withoutVerifying()
            ->timeout(60);
        return $client;
    }

    public static function contactUsLead($parameters)
    {
        $response = self::apiClient()->post('contactUs', $parameters);
        return $response->json();
    }

    public static function signIn($parameters)
    {
        $response = self::apiClient()->post('login', $parameters);
        return $response->json();
    }

    public static function signUp($parameters)
    {
        $response = self::apiClient()->post('register', $parameters);
        return $response->json();
    }

    public static function saveFcmToken($parameters)
    {
        $response = self::apiClient()->post('updateFcmToken', $parameters);
        return $response->json();
    }

}
