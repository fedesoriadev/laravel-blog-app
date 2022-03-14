<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
            $attributes['avatar'] = $this->handleAvatar($request);
        }

        $user = User::create($attributes);

        $user->roles()->sync($request->get('roles', []));

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
            $attributes['avatar'] = $this->handleAvatar($request);
        }

        $user->update($attributes);

        $user->roles()->sync($request->get('roles', []));

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

    /**
     * @param \App\Http\Requests\UserRequest $request
     * @return false|string
     */
    private function handleAvatar(UserRequest $request): string|false
    {
        return $request->file('avatar')->store('avatars', 'public');
    }
}
