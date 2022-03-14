<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * @param \App\Models\Comment $comment
     * @return bool
     */
    public function destroy(Comment $comment): bool
    {
        return $comment->delete();
    }
}
