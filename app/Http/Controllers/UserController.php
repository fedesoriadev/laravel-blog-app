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
        $attributes = $request->validated();

        if ($request->has('avatar')) {
            $attributes['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user = User::create($attributes);

        if ($request->has('roles')) {
            foreach ($request->roles as $role) {
                $user->addRole($role);
            }
        }

        return $user;
    }

    /**
     * @param \App\Http\Requests\UserRequest $request
     * @param \App\Models\User $user
     * @return \App\Models\User
     */
    public function update(UserRequest $request, User $user): User
    {
        $attributes = $request->validated();

        if ($request->has('avatar')) {
            $attributes['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user->update($attributes);

        if ($request->has('roles')) {
            foreach ($request->roles as $role) {
                $user->addRole($role);
            }
        }

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
