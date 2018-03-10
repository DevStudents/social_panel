<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
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

        Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $request->post_id,
            'content' => $request->$comment_content_id,
        ]);

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
