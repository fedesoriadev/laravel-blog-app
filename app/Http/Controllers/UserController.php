<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
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

    /**
     * @param \App\Http\Requests\UserRequest $request
     * @return \App\Models\User
     */
    public function store(UserRequest $request): User
    {
        return User::create($request->validated());
    }

    /**
     * @param \App\Http\Requests\UserRequest $request
     * @param \App\Models\User $user
     * @return \App\Models\User
     */
    public function update(UserRequest $request, User $user): User
    {
        $user->update($request->validated());

        return $user;
    }

    /**
     * @param \App\Models\User $user
     * @return bool
     */
    public function destroy(User $user): bool
    {
        return $user->delete();
    }
}
