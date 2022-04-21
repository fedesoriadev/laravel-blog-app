<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Pagination;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request): View
    {
        $users = User::with('role')
            ->withRole($request->get('role'))
            ->simplePaginate(Pagination::ADMIN->value);

        return view('admin.users.index', ['users' => $users]);
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        return view('admin.users.form', ['user' => new User()]);
    }

    /**
     * @param \App\Http\Requests\UserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request): RedirectResponse
    {
        $attributes = $request->validated();

        $user = User::createVerified($attributes);

        if ($request->has('profile_picture')) {
            $user->uploadProfilePicture($request->file('profile_picture'));
        }

        flash()->success(__('User created'));

        return redirect()->route('users.index');
    }

    /**
     * @param \App\Models\User $user
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(User $user): View
    {
        return view('admin.users.form', ['user' => $user]);
    }

    /**
     * @param \App\Http\Requests\UserRequest $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, User $user): RedirectResponse
    {
        $attributes = $request->validated();

        if (empty($attributes['password'])) {
            unset($attributes['password']);
        }

        $user->update($attributes);

        if ($request->has('profile_picture')) {
            $user->uploadProfilePicture($request->file('profile_picture'));
        }

        flash()->success(__('User updated'));

        return redirect()->route('users.index');
    }

    /**
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        flash()->success(__('User deleted'));

        return redirect()->route('users.index');
    }
}
