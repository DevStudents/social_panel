<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use Illuminate\Support\Facades\Auth;

class LikesController extends Controller
{
    public function add(Request $request){
        Like::create([
            'user_id' => Auth::id(),
            'post_id' => $request->post_id,
            'comment_id' => $request->comment_id,
        ]);
        return back();
    }

    public function destroy(){

    }
}
