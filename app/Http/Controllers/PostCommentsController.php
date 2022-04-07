<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PostCommentsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request, Post $post): RedirectResponse
    {
        $request->validate(['comment' => 'required']);

        $post->comments()->create([
            'user_id' => $request->user()->id,
            'body'    => $request->comment
        ]);

        return back();
    }
}
