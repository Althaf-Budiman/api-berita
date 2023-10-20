<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    function index()
    {
        $posts = Post::all();
        // kita pakai fungsi collection karena responsnya akan mengeluarkan data yang lebih dari 1
        return PostResource::collection($posts->loadMissing('writer', 'comments'));
    }

    function show($id)
    {
        $post = Post::with('writer')->find($id);
        return new PostResource($post);
    }

    function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'news_content' => 'required'
        ]);

        $request['user_id'] = Auth::user()->id;

        $post = Post::create($request->all());

        return new PostResource($post->loadMissing('writer'));
    }

    function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'news_content' => 'required'
        ]);

        $post = Post::find($id);
        $post->update($request->all());

        return new PostResource($post->loadMissing('writer'));
    }

    function delete($id)
    {
        $post = Post::find($id)->delete();

        return response()->json([
            'message' => 'Data succesfully deleted'
        ]);
    }
}
