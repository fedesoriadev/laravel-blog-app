<?php

namespace App\Http\Controllers;

use App\Enums\Language;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LanguageSelectorController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request, string $locale): RedirectResponse
    {
        if (Language::tryFrom($locale)) {
            session()->put('locale', $locale);
        }

        return back();
    }
}
