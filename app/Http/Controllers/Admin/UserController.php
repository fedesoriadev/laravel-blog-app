<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Pagination;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request): View
    {
        $users = User::with('roles')
            ->simplePaginate(Pagination::ADMIN->value);

        return view('admin.users.index', ['users' => $users]);
    }

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
