<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(Request $request): View
    {
        return view('profile.show', ['user' => $request->user()]);
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->user()->delete();

        flash()->success(__('Account has been deleted'));

        return redirect()->home();
    }
}
