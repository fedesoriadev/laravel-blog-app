<?php

namespace App\Http\Controllers;

use App\Enums\Pagination;
use App\Models\User;
use Illuminate\Contracts\View\View;

class AuthorController extends Controller
{
    /**
     * @param \App\Models\User $author
     * @return View
     */
    public function __invoke(User $author): View
    {
        $posts = $author
            ->posts()
            ->with('author', 'tags')
            ->published()
            ->simplePaginate(Pagination::FRONT->value);

        return view('authors.show', ['author' => $author, 'posts' => $posts]);
    }
}
