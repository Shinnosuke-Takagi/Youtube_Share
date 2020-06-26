<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Video;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::with(['recommender'])->paginate();

        return $videos;
    }

    public function share(Request $request)
    {
        $video = new Video();
        $video->video_id = $request->video_id;

        Auth::user()->videos()->save($video);

        return $video;
    }
}
