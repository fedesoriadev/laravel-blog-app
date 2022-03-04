<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * @param Request $request
     * @return Collection
     */
    public function index(Request $request): Collection
    {
        return Post::published()->get();
    }
}
