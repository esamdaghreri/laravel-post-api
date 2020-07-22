<?php

namespace App\Http\Controllers\Api\V1\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\Post as PostResource;
use App\Http\Resources\User\PostCollection;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of posts.
     */
    public function index()
    {
        return new PostCollection(Post::all());
    }

    /**
     * Store a newly post
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $post = new Post;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = Auth::id();
        if($post->save()) {
            return new PostResource($post);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return new PostResource(Post::findOrFail($id));
    }

    /**
     * Update post.
     */
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $post = Post::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $post->title = $request->title;
        $post->content = $request->content;
        if($post->save()) {
            return new PostResource($post);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        if($post->delete()) {
            return new PostResource($post);
        }
    }
}
