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
        $postsCount = Post::count();
        $commentsCount = Comment::count();
        $userCount = User::count();

        $topPosts = Post::take(3)->inRandomOrder()->get();
        $latestComments = Comment::with('post')->latest()->take(3)->get();
        $newUsers = User::latest()->take(3)->get();

        return view('admin.index', compact(
            'postsCount',
            'commentsCount',
            'userCount',
            'topPosts',
            'latestComments',
            'newUsers'
        ));
    }
}
