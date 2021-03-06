<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Post;


class CheckPostPermission
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

        $post_exists = Post::where([
            ['id',$request->post],
            ['user_id',Auth::id()]
        ])->exists();

        if((!Auth::check() || !$post_exists ) && !admin()) {
            abort(403,'Permission denied - it is not your post :(');
        }
        return $next($request);
    }
}
