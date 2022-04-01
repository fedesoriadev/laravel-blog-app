<?php

namespace App\Http\Controllers;

use App\Enums\Pagination;
use App\Models\Tag;
use Illuminate\Contracts\View\View;

class TagController extends Controller
{
    /**
     * @param  \App\Models\Tag  $tag
     * @return View
     */
    public function __invoke(Tag $tag): View
    {
        $posts = $tag
            ->posts()
            ->with('author', 'tags')
            ->published()
            ->simplePaginate(Pagination::FRONT->value);

        return view('tags.show', ['tag' => $tag, 'posts' => $posts]);
    }
}
