<?php

use App\Helpers\ApiService;
use Illuminate\Support\Facades\Session;

if (!function_exists('api_json_response')) {
    /**
     * Return api json response
     *
     * @param  string $status 
     * @param  string $message 
     * @param  string $data
     * @return json
     */
    function api_json_response($status, $message, $data)
    {
        $response = array();
        $response['status'] = $status;
        $response['message'] = $message;
        $response['data'] = $data;
        echo json_encode($response);
        exit;
    }
}

if (!function_exists('getYouTubeThumbnailUrl')) {
    function getYouTubeThumbnailUrl($embedUrl)
    {
        $pattern = '/v=([^&?]+)/';

        // Check if the URL matches the pattern
        if (preg_match($pattern, $embedUrl, $matches)) {
            $videoId = $matches[1];  // Extracted video ID

            // Construct the thumbnail URL
            $thumbnailUrl = "https://img.youtube.com/vi/{$videoId}/0.jpg";

            return $thumbnailUrl;
        } else {
            // Return null or an error message if the URL doesn't match the pattern
            return null;
        }
    }
}

if (!function_exists('getYouTubeEmbedUrl')) {
    function getYouTubeEmbedUrl($url, $autoplay = false)
    {
        $pattern = '/v=([^&?]+)/';
        if (preg_match($pattern, $url, $matches)) {
            $videoId = $matches[1];
            $embedUrl = "https://www.youtube.com/embed/" . $videoId;
            if ($autoplay) {
                $embedUrl .= '?autoplay=1';
            } else {
                $embedUrl .= '?autoplay=0';
            }

            return $embedUrl;
        } else {
            return '#';
        }
    }
}

if (!function_exists('getMediaDetailUrl')) {
    function getMediaDetailUrl($url)
    {
        $pattern = '/v=([^&?]+)/';
        if (preg_match($pattern, $url, $matches)) {
            $videoId = $matches[1];
            $detailUrl = route('videowatch', ['id' => $videoId]);
            return $detailUrl;
        } else {
            return '#';
        }
    }
}

if (!function_exists('formatViewCount')) {
    function formatViewCount($count)
    {
        if ($count >= 1000000) {
            return number_format($count / 1000000, 1) . 'M';
        } elseif ($count >= 1000) {
            return number_format($count / 1000, 1) . 'K';
        } else {
            return $count;
        }
    }
}

if (!function_exists('getIpAddress')) {
    function getIpAddress($request)
    {
        $ipAddress = $request->ip();
        return $ipAddress;
    }
}


if (!function_exists('getDeviceId')) {
    function getDeviceId()
    {
        return Session::get('deviceId') ?? '';
    }
}

if (!function_exists('getDeviceToken')) {
    function getDeviceToken()
    {
        return Session::get('deviceToken') ?? '';
    }
}

if (!function_exists('getLoginToken')) {
    function getLoginToken()
    {
        return Session::get('loginToken') ?? '';
    }
}
if (!function_exists('getAuthUserId')) {
    function getAuthUserId()
    {
        if (!empty(Session::get('loginUser'))) {
            $userId = Session::get('loginUser')['id'];
        } else {
            $userId = '';
        }
        return $userId;
    }
}