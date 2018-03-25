<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;
use App\Comment;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('author',['except' => ['show','store']]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     */


    public function store(Request $request)
    {
        $this->validate($request,[
            'post_content' => 'required|min:5',
        ],[
            'required' => 'You cannot add empty post silly...',
            'min' => "C'mon your post must be at least :min characters long..."
        ]);

        Post::create([
            'user_id' => Auth::id(),
            'post_content' => $request->post_content,
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(admin()) {
            $post = Post::with(['comment','user','like'])
                ->with(['comment.user','comment.like'])->withTrashed()->findOrFail($id);
        }
        else{
            $post = Post::with(['comment','user','like'])
                ->with(['comment.user','comment.like'])->findOrFail($id);
        }

        return view('post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('post.edit',compact('post'));
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
            'post_content' => 'required|min:5',
        ],[
            'required' => 'You cannot add empty post silly...',
            'min' => "C'mon your post must be at least :min characters long..."
        ]);
        $post = Post::findOrFail($id);
        $post->post_content = $request->post_content;

        $post->save();
        return redirect('home#post_'.$post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::where('id',$id)->delete();
        Comment::where('post_id',$id)->delete();
        return back();
    }
}
