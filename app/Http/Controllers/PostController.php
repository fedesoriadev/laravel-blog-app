<?php

namespace App\Http\Controllers;

use App\Enums\Pagination;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $posts = Post::with('author', 'tags')
                    ->published()
                    ->filter($request->only(['search']))
                    ->simplePaginate(Pagination::FRONT->value);

        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * @param \App\Models\Post $post
     * @return View
     */
    public function show(Post $post): View
    {
        $post->load('comments.author');

        return view('posts.show', ['post' => $post]);
    }
}
