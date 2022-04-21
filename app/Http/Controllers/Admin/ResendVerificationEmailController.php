<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class ResendVerificationEmailController extends Controller
{
    /**
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(User $user)
    {
        if ($user->hasVerifiedEmail()) {
            flash()->warning(__('User already verified'));

            return redirect()->route('users.index');
        }

        $user->sendEmailVerificationNotification();

        flash()->success(__('Verification email was sent to user'));

        return redirect()->route('users.index');
    }
}
