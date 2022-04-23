<div x-data="{ showLangDropdown: false }" @click.away="showLangDropdown = false" class="relative">
    <button
            type="button"
            @click="showLangDropdown = ! showLangDropdown"
            {{ $attributes->merge(['class' => 'text-sm']) }}
            aria-expanded="false"
            aria-haspopup="true">
        <span class="sr-only">{{ __('Switch language') }}</span>
        {{ strtoupper(session('locale', config('app.locale'))) }}
    </button>

    <ul x-show="showLangDropdown"
        style="display: none;"
        class="origin-top-right absolute z-10 right-0 mt-2 w-24 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none divide-y divide-gray-100"
        role="menu"
        aria-orientation="vertical"
        tabindex="-1">

        @foreach(\App\Enums\Language::cases() as $locale)
            <li>
                <a class="block w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100"
                   href="{{ route('lang', $locale->value) }}">
                    {{ $locale->toUpper() }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
