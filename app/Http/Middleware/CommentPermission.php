<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Comment;

class CommentPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {

        $comment_exists = Comment::where([
            ['id',$request->comment],
            ['user_id',Auth::id()]
        ])->exists();

        if((!Auth::check() || !$comment_exists )&& !admin()) {
            abort(403,'Permission denied - it is not your comment :( ');
        }
        return $next($request);
    }
}
