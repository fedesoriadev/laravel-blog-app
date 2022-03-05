<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    /**
     * @param \App\Models\User $user
     * @return \App\Models\User
     */
    public function show(User $user): User
    {
        $user->load('posts');

        return $user;
    }
}
