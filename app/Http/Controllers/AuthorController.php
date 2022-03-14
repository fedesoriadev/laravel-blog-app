<?php

namespace App\Http\Controllers;

use App\Models\User;

class AuthorController extends Controller
{
    /**
     * @param \App\Models\User $author
     * @return \App\Models\User
     */
    public function __invoke(User $author): User
    {
        $author->load('posts');

        return $author;
    }
}
