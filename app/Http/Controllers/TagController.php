<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class TagController extends Controller
{
    /**
     * @param  \App\Models\Tag  $tag
     * @return \App\Models\Tag
     */
    public function __invoke(Tag $tag): Tag
    {
        $tag->load('posts');

        return $tag;
    }
}
