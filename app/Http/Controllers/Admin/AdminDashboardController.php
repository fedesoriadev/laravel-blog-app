<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\View\View;

class AdminDashboardController extends Controller
{
    /**
     * @return View
     */
    public function __invoke(): View
    {
        $postsCount = Post::count();
        $commentsCount = Comment::count();
        $usersCount = User::count();

        $topPosts = Post::take(3)->inRandomOrder()->get();
        $latestComments = Comment::with('post')->latest()->take(3)->get();
        $newUsers = User::latest()->take(3)->get();

        return view('admin.index', compact(
            'postsCount',
            'commentsCount',
            'usersCount',
            'topPosts',
            'latestComments',
            'newUsers'
        ));
    }
}
