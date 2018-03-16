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


        if(!empty($request->comment_id)){
            $comment = Comment::where('id',$request->comment_id);
            User::findOrFail($comment->user_id)->notify(new LikedComment($request->post_id,$request->comment_id));
        }
        else{
            $post = Post::where('id',$request->post_id);
            User::findOrFail($post->user_id)->notify(new LikedPost($request->post_id));
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
