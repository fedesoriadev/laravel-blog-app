<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * @param \App\Http\Requests\PostRequest $request
     * @return \App\Models\Post
     */
    public function store(PostRequest $request): Post
    {
        $attributes = $request->validated();

        if ($request->has('image')) {
            $attributes['image'] = $this->handleImage($request);
        }

        $post = Post::create($attributes);

        $this->handleTags($request, $post);

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
            $attributes['image'] = $this->handleImage($request);
        }

        $post->update($attributes);

        $this->handleTags($request, $post);

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
    private function handleTags(Request $request, Post $post): void
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

    /**
     * @param \App\Http\Requests\PostRequest $request
     * @return string
     */
    private function handleImage(PostRequest $request): string
    {
        return $request->file('image')->store('posts', 'public');
    }
}
