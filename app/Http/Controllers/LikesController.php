<?php

namespace App\Http\Controllers;

use App\Notifications\LikedPost;
use Illuminate\Http\Request;
use App\Like;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\User;
use App\Comment;
use App\Notifications\LikedComment;


class LikesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function add(Request $request){
       Like::create([
            'user_id' => Auth::id(),
            'post_id' => $request->post_id,
            'comment_id' => $request->comment_id,
        ]);



        $comment = $request->comment_id;

        if(is_null($comment)){
            $post = Post::findOrFail($request->post_id);
            if($post->user_id != Auth::id()) {
                User::findOrFail($post->user_id)->notify(new LikedPost($post->id));
            }
        }

        else{
            $comment = Comment::findOrFail($request->comment_id);
            $post = $comment->post->id;
            if($comment->user_id != Auth::id())
            User::findOrFail($comment->user_id)->notify(new LikedComment($post,$comment->id));
        }



        return back();
    }

    public function destroy(Request $request){
        Like::where([
            'user_id' => Auth::id(),
            'post_id' => $request->post_id,
            'comment_id' => $request->comment_id,
        ])->delete();

        return back();
    }
}
