<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Pagination;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $comments = Comment::with('post', 'author')
            ->simplePaginate(Pagination::ADMIN->value);

        return view('admin.comments.index', ['comments' => $comments]);
    }

    /**
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Comment $comment): RedirectResponse
    {
        $comment->delete();

        flash()->success(__('Comment deleted'));

        return redirect()->route('comments.index');
    }
}
