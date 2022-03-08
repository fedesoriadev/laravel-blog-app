<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(Request $request, Post $post): Model
    {
        $request->validate(['body' => 'required']);

        return $post->comments()->create([
            'user_id' => $request->user()->id,
            'body'    => $request->body
        ]);
    }

    /**
     * @param \App\Models\Comment $comment
     * @return bool
     */
    public function destroy(Comment $comment): bool
    {
        return $comment->delete();
    }
}
