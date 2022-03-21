<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;

class DeleteCommentController extends Controller
{
    /**
     * @param \App\Models\Comment $comment
     * @return bool
     */
    public function __invoke(Comment $comment): bool
    {
        return $comment->delete();
    }
}
