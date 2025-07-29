<?php

namespace App\Http\Controllers;

use App\Services\PostinganService;
use Illuminate\Http\Request;

class PostinganController extends Controller
{
    public function index(PostinganService $postinganService)
    {
        $postinganService->synchronizePosts();
        $postingans = $postinganService->getallPostingan();
        return view('pages.admin.postingan.postingan',compact('postingans'));
    }
}
