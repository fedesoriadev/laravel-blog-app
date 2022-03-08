<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
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

    /**
     * @param \App\Http\Requests\PostRequest $request
     * @return \App\Models\Post
     */
    public function store(PostRequest $request): Post
    {
        $attributes = $request->validated();

        if ($request->has('image')) {
            $attributes['image'] = $request->file('image')->store('posts', 'public');
        }

        return Post::create($attributes);
    }

    /**
     * @param \App\Http\Requests\PostRequest $request
     * @param \App\Models\Post $post
     * @return \App\Models\Post
     */
    public function update(PostRequest $request, Post $post): Post
    {
        $attributes = $request->validated();

        if ($request->has('image')) {
            $attributes['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($attributes);

        return $post;
    }
}
