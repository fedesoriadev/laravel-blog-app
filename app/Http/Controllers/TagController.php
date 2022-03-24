<?php

namespace App\Http\Controllers;

use App\Enums\PostPagination;
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
            ->published()
            ->simplePaginate(PostPagination::FRONT->value);

        return view('tags.show', ['tag' => $tag, 'posts' => $posts]);
    }
}
