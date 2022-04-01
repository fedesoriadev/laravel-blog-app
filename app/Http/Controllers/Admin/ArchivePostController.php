<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ArchivePostController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \App\Exceptions\AlreadyArchivedException
     */
    public function __invoke(Request $request, Post $post): RedirectResponse
    {
        $this->authorize('update', $post);

        $post->archive();

        return back();
    }
}
