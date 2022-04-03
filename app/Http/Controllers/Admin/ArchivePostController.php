<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\AlreadyArchivedException;
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
     */
    public function __invoke(Request $request, Post $post): RedirectResponse
    {
        $this->authorize('update', $post);

        try {
            $post->archive();
        } catch (AlreadyArchivedException $e) {
            flash()->danger(__('The post is already archived'));
        }

        return back();
    }
}
