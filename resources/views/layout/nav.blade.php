<nav x-data="{ showSearch: false, showUserDropdown: false }">
    <div class="flex items-center py-4 sm:py-6 md:py-10 mb-4">
        <!-- Logo -->
        <x-app-logo :href="route('home')" class="flex items-center">
            <span class="hidden sm:block font-bold text-2xl sm:text-3xl">{{ config('app.name') }}</span>
        </x-app-logo>

        <div class="ml-auto flex items-center space-x-2">
            <!-- Search -->
            <div class="flex items-center space-x-2" @click.away="showSearch = false">
                <button type="button" @click="showSearch = !showSearch">
                    <svg class="w-6 h-6 text-gray-500 hover:text-indigo-600 transition dark:text-neutral-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </button>
                <form
                    action="/"
                    x-show="showSearch"
                    style="display: none;">
                    <label for="search" class="sr-only">{{ __('Search posts') }}</label>
                    <input
                        type="text"
                        name="search"
                        id="search"
                        value="{{ request()->get('search', '') }}"
                        placeholder="Search..."
                        class="bg-gray-100 border-gray-200 text-sm rounded-lg">
                </form>
            </div>

            <!-- Theme -->
            <button
                @click="toggleTheme()"
                class="flex items-center justify-center transition">
                <svg class="w-7 h-7 text-indigo-600 hover:text-indigo-600 transition" x-show="!darkMode" style="display: none;" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <svg class="w-7 h-7 text-indigo-300 hover:text-indigo-600 transition" x-show="darkMode" style="display: none;" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                </svg>
            </button>

            <!-- User -->
            @auth
                <div @click.away="showUserDropdown = false" class="relative">
                    <button
                        type="button"
                        @click="showUserDropdown = ! showUserDropdown"
                        class="max-w-xs bg-gray-800 rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
                        id="user-menu-button"
                        aria-expanded="false"
                        aria-haspopup="true">

                        <span class="sr-only">{{ __('Toggle user menu') }}</span>

                        <x-profile-picture :user="Auth::user()" />
                    </button>

                    <ul
                        x-show="showUserDropdown"
                        style="display: none;"
                        class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none divide-y divide-gray-100"
                        role="menu"
                        aria-orientation="vertical"
                        aria-labelledby="user-menu-button"
                        tabindex="-1">
                        <li>
                            <a class="block w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100"
                               href="{{ Auth::user()->home() }}">{{ __('Profile') }}</a>
                        </li>
                        <li>
                            <x-form :action="route('logout')" method="POST">
                                <button type="submit"
                                        class="block w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100"
                                        role="menuitem"
                                        tabindex="-1"
                                        id="user-menu-item-0">
                                    {{ __('Logout') }}
                                </button>
                            </x-form>
                        </li>
                    </ul>
                </div>
            @else
                <a href="{{ route('login') }}" class="text-gray-500 hover:text-indigo-600 transition dark:text-neutral-200">{{ __('Login') }}</a>
            @endauth
        </div>
    </div>
</nav>
