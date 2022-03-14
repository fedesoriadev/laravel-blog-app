<?php

namespace App\Http\Controllers;

use App\Models\User;

class AuthorController extends Controller
{
    /**
     * @param \App\Models\User $user
     * @return \App\Models\User
     */
    public function __invoke(User $user): User
    {
        $user->load('posts');

        return $user;
    }
}
