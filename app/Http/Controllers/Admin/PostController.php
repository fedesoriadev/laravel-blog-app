<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Pagination;
use App\Enums\PostStatus;
use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Post::class);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request): View
    {
        $posts = Post::with('author', 'tags')
            ->filter($request->user()->hasRole(UserRole::AUTHOR) ? ['user_id' => $request->user()->id] : [])
            ->withStatus($request->get('status'))
            ->latest()
            ->simplePaginate(Pagination::ADMIN->value);

        return view('admin.posts.index', ['posts' => $posts]);
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        return view('admin.posts.form', ['post' => new Post()]);
    }

    /**
     * @param \App\Http\Requests\PostRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Exceptions\AlreadyPublishedException
     */
    public function store(PostRequest $request): RedirectResponse
    {
        $attributes = $request->validated();

        if ($request->has('image')) {
            $attributes['image'] = $this->handleImage($request);
        }

        $attributes['status'] = PostStatus::DRAFT;

        $post = Post::create($attributes);

        if ($request->has('publish') && !$post->status->isPublished()) {
            $post->publish($attributes['date']);
        }

        $this->handleTags($request, $post);

        flash()->success(__('Post created'));

        return redirect()->route('posts.index');
    }

    /**
     * @param \App\Models\Post $post
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Post $post): View
    {
        return view('admin.posts.form', ['post' => $post]);
    }

    /**
     * @param \App\Http\Requests\PostRequest $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Exceptions\AlreadyPublishedException
     */
    public function update(PostRequest $request, Post $post): RedirectResponse
    {
        $attributes = $request->validated();

        if ($request->has('image')) {
            $attributes['image'] = $this->handleImage($request);
        }

        $post->update($attributes);

        if ($request->has('publish') && !$post->status->isPublished()) {
            $post->publish($attributes['date']);
        }

        $this->handleTags($request, $post);

        flash()->success(__('Post updated'));

        return redirect()->route('posts.index');
    }

    /**
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        flash()->success(__('Post deleted'));

        return redirect()->route('posts.index');
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
                $tags[] = Tag::firstOrCreate(['name' => $tag], ['name' => $tag])['id'];
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
