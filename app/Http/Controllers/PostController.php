<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

        $post = Post::create($attributes);

        $this->syncTags($request, $post);

        return $post;
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

        $this->syncTags($request, $post);

        return $post;
    }

    /**
     * @param \App\Models\Post $post
     * @return bool
     */
    public function destroy(Post $post): bool
    {
        return $post->delete();
    }

    /**
     * @param Request $request
     * @param Post $post
     * @return void
     */
    private function syncTags(Request $request, Post $post): void
    {
        $tags = [];

        if ($request->has('tags')) {
            foreach ($request->tags as $tag) {
                $tags[] = Tag::firstOrCreate(['name' => $tag], [
                        'name' => $tag,
                        'slug' => Str::slug($tag)
                    ]
                )['id'];
            }
        }

        $post->tags()->sync($tags);
    }
}
