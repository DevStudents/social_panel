<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $friends = Auth::user()->friends();

        $friends_ids_array = [];
        $friends_ids_array[] = Auth::id();

        foreach($friends as $friend){
            $friends_ids_array[] = $friend->id;
        }

        if(admin()) {
            $posts = Post::with(['user','comment','like'])
                ->with(['comment.user','comment.like'])
                ->whereIn('user_id', $friends_ids_array)
                ->orderBy('created_at', 'desc')
                ->withTrashed()
                ->paginate(5);
        }
        else{
            $posts = Post::with(['comment','user','like'])
                ->with(['comment.user','comment.like'])
                ->whereIn('user_id', $friends_ids_array)
                ->orderBy('created_at', 'desc')
                ->paginate(5);
        }
        return view('post.main',compact('posts'));
    }
}
