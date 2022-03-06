<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index(Request $request): Collection
    {
        return Post::published()
                    ->filter($request->only(['search']))
                    ->get();
    }

    /**
     * @param \App\Models\Post $post
     * @return \App\Models\Post
     */
    public function show(Post $post): Post
    {
        return $post;
    }

    public function store(Request $request): Post
    {
        return Post::create($request->only('user_id', 'title', 'slug', 'published_at', 'body'));
    }
}
