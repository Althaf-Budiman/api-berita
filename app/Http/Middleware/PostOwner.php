<?php

namespace App\Http\Middleware;

use App\Models\Post;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PostOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $currentAuthUser = Auth::user();
        $post = Post::find($request->id);

        if ($post->user_id != $currentAuthUser->id) {
            return response()->json([
                'message' => 'Data not found.'
            ], 404);
        }

        return $next($request);
    }
}
