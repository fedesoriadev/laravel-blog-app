<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PostCommentsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function __invoke(Request $request, Post $post): Model
    {
        $request->validate(['body' => 'required']);

        return $post->comments()->create([
            'user_id' => $request->user()->id,
            'body'    => $request->body
        ]);
    }
}
