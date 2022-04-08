<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\View\View;

class IndexController extends Controller
{
    /**
     * @return View
     */
    public function __invoke(): View
    {
        $posts_count = Post::count();
        $comments_count = Comment::count();
        $user_count = User::count();


        return view('admin.index', compact('posts_count', 'comments_count', 'user_count'));
    }
}
