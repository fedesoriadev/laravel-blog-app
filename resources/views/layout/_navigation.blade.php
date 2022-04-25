<nav>
    <div class="flex items-center py-4 sm:py-6 md:py-10 mb-4">
        <!-- Logo -->
        <x-logo :href="route('home')" class="flex items-center">
            <span class="hidden sm:block font-bold text-2xl sm:text-3xl">{{ config('app.name') }}</span>
        </x-logo>

        <div class="ml-auto flex items-center space-x-2">
            <!-- Search -->
            @include('layout._search')

            <!-- Theme -->
            @include('layout._theme-toggle')

            <!-- Language Switcher -->
            <x-lang-switcher />

            <!-- User -->
            @auth
                @include('layout._logged-user')
            @else
                <a href="{{ route('login') }}"
                   class="text-gray-500 hover:text-indigo-600 transition dark:text-neutral-200">
                    <span class="hidden sm:inline">
                        {{ __('Log in') }}
                    </span>
                    <svg class="w-6 h-6 sm:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                </a>
            @endauth
        </div>
    </div>
</nav>
