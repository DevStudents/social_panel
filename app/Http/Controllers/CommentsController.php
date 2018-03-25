<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Notifications\PostComment;

class CommentsController extends Controller
{


    public function __construct()
    {
        $this->middleware('owner',['except' => ['store']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comment_content_id = 'comment_'.$request->post_id.'_content';
        $this->validate($request,[
            $comment_content_id  => 'required|min:2',
        ],[
            'required' => 'You cannot add empty post silly...',
            'min' => "C'mon your post must be at least :min characters long..."
        ]);

        $comment = Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $request->post_id,
            'content' => $request->$comment_content_id,
        ]);


        $post = Post::findOrFail($request->post_id);


        if($post->user_id != Auth::id()) {
            User::findOrFail($post->user_id)->notify(new PostComment($request->post_id,$comment->id));
        }
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        return view('comments.edit',compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request,[
            'comment_content' => 'required|min:2',
        ],[
            'required' => 'You cannot add empty comment silly...',
            'min' => "C'mon your comment must be at least :min characters long..."
        ]);

        $comment = Comment::findOrFail($id);
        $comment->content = $request->comment_content;

        $comment->save();
        return redirect('home#comment_'.$comment->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Comment::where('id',$id)->delete();
        return back();
    }
}
