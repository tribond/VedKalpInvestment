<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\MediaMaster;
use App\Models\MediaDetail;
use App\Models\CategoryMaster;
use App\Models\CategoryDetail;
use App\Models\ArtistMaster;
use App\Http\Controllers\Controller;
use App\Models\MediaView;

class MediaController extends Controller
{
    public function index(Request $request)
    {
		if(empty($request->header("device_id")) || empty($request->header("device_token")) || empty($request->header("user_id")) || empty($request->header("user_token"))){
            // return response()->json(["status" => false, "message" => "Invalid Header"]);
        }

    	$media = MediaMaster::select('id','title','url','artist_id','category_id','total_views')->with(['media_details:id,media_id,title,description,language_id','category_details:id,category_id,title,description,language_id','artist_details:id,name,artist_id,language_id','category_masters:id,slug','artist_masters:id,slug'])->where('is_active',1);
		if($request->has('author') && !empty($request->author))
		{
			$media = $media->where('artist_id',$request->author);
		}

		if($request->has('category') && !empty($request->category))
		{
			$media = $media->where('category_id',$request->category);
		}

		if($request->has('keyword') && !empty($request->keyword))
		{
			$media = $media->whereRaw('title LIKE "%'.$request->keyword.'%"');
		}
		if($request->has('sortBy') && !empty($request->sortBy) && $request->sortBy == 'views') {
			$media = $media->orderBy('total_views','desc');
		} elseif ($request->has('sortBy') && !empty($request->sortBy) && $request->sortBy == 'new') {
			$media = $media->orderBy('id','desc');
		} elseif ($request->has('sortBy') && !empty($request->sortBy) && $request->sortBy == 'asc') {
			$media = $media->orderBy('title','asc');
		} elseif ($request->has('sortBy') && !empty($request->sortBy) && $request->sortBy == 'desc') {
			$media = $media->orderBy('title','desc');
		} elseif ($request->has('sortBy') && !empty($request->sortBy) && $request->sortBy == 'old') {
			$media = $media->orderBy('id','asc');
		}
    	if($request->has('pagination'))
    	{
    		$media = $media->paginate('5');
    	}
    	else
    	{
    		$media = $media->get();
    	}
		return response()->json(['message' => __('messages.success'), 'data' => $media]);
    	// api_json_response(200,'Success',$media);
    }

	public function categoryList(Request $request)
    {
		if(empty($request->header("device_id")) || empty($request->header("device_token")) || empty($request->header("user_id")) || empty($request->header("user_token")) || empty($request->header("language_id"))){
            // return response()->json(["status" => false, "message" => "Invalid Header"]);
        }
		
    	$categoryList = CategoryMaster::select('id','title','description','slug','is_active')->withCount('media_masters')->where('is_active',1);
    	if($request->has('pagination'))
    	{
    		$categoryList = $categoryList->paginate('5');
    	}
    	else
    	{
    		$categoryList = $categoryList->get();
    	}
		return response()->json(['message' => __('messages.success'), 'data' => $categoryList]);
    	// api_json_response(200,'Success',$categoryList);
    }

	public function authorList(Request $request)
    {
		if(empty($request->header("device_id")) || empty($request->header("device_token")) || empty($request->header("user_id")) || empty($request->header("user_token"))){
            //return response()->json(["status" => false, "message" => "Invalid Header"]);
        }
    	$artistList = ArtistMaster::select('id','name','url','slug','is_active')->withCount('media_masters')->where('is_active',1);
    	if($request->has('pagination')){
    		$artistList = $artistList->paginate('5');
    	}else{
    		$artistList = $artistList->get();
    	}
		return response()->json(['message' => __('messages.success'), 'data' => $artistList]);
    	// api_json_response(200,'Success',$artistList);
    }

	public function homePageContent(Request $request)
    {
		// if(empty($request->header("device_id")) || empty($request->header("device_token")) || empty($request->header("user_id")) || empty($request->header("user_token"))){
        //     return response()->json(["status" => false, "message" => "Invalid Header"]);
        // }

    	$media = MediaMaster::select('id','title','url','artist_id','category_id','total_views')->with(['media_details:id,media_id,title,description,language_id','category_details:id,category_id,title,description,language_id','artist_details:id,name,artist_id,language_id','category_masters:id,slug','artist_masters:id,slug'])->where('is_active',1)->orderBy('id','desc')->limit(5);
		$mosi_viewed_media = MediaMaster::select('id','title','url','artist_id','category_id','total_views')->with(['media_details:id,media_id,title,description,language_id','category_details:id,category_id,title,description,language_id','artist_details:id,name,artist_id,language_id','category_masters:id,slug','artist_masters:id,slug'])->where('is_active',1)->orderBy('total_views','desc')->limit(5);
    	
    	$media = $media->get();
		$mosi_viewed_media = $mosi_viewed_media->get();

		$response['most_viewed_content'] = $mosi_viewed_media;
		$response['newly_added_content'] = $media;
		return response()->json(['message' => __('messages.banner_list_success'), 'data' => $response]);
    	// api_json_response(200,'Success',$media);
    }

	public function updateMediaViewCount(Request $request)
    {
		if($request->has('media_id') && !empty($request->media_id))
		{
			$media = MediaMaster::find($request->media_id);
			$media->total_views = $media->total_views + 1;
			$media->save();
			$response['total_views'] = $media->total_views;
			$mediaView = MediaView::where('media_id',$request->media_id)->whereRaw("(ip_address = ? OR user_id = ?)", [$request->ip(),$request->user_id])->exists();
			if($mediaView) {
				$mediaView = MediaView::where('media_id',$request->media_id)->whereRaw("(ip_address = ? OR user_id = ?)", [$request->ip(),$request->user_id])->first();
				$mediaView->ip_address = $request->ip();
				$mediaView->total_views = $mediaView->total_views + 1;
				$mediaView->save();
			} else {
				$mediaView = new MediaView();
				$mediaView->media_id = $request->media_id;
				$mediaView->ip_address = $request->ip();
				$mediaView->total_views = 1;
				$mediaView->user_id = $request->user_id ? $request->user_id : null;
				$mediaView->save();
			}
			return response()->json(['message' => __('messages.success'), 'data' => $response]);
		}
	}

	public function getMediaBySlug(Request $request)
    {
		if(empty($request->header("device_id")) || empty($request->header("device_token")) || empty($request->header("user_id")) || empty($request->header("user_token"))){
            // return response()->json(["status" => false, "message" => "Invalid Header"]);
        }

    	$media = MediaMaster::select('id','title','url','artist_id','category_id','total_views')->with(['media_details:id,media_id,title,description,language_id','category_details:id,category_id,title,description,language_id','artist_details:id,name,artist_id,language_id','category_masters:id,slug','artist_masters:id,slug'])->where('is_active',1);
		$media = $media->where('url','like','%'.$request->slug.'%');
    	$media = $media->first();
		return response()->json(['message' => __('messages.success'), 'data' => $media??(object)[]]);
    	// api_json_response(200,'Success',$media);
    }
}
