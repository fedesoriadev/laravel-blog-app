<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin - {{ config('app.name') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap"
          rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="h-full">

<div class="min-h-full">
    <nav x-data="{ showMobileMenu: false }" class="bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <x-app-logo :href="Auth::user()->home()" />
                    </div>

                    <div class="hidden md:block">
                        <div class="flex space-x-4">
                            <x-admin.nav-link :href="route('posts.index')" path="admin/posts*" class="ml-4">
                                {{ __('Posts') }}
                            </x-admin.nav-link>

                            @can('admin')
                                <x-admin.nav-link :href="route('admin.home')" path="admin" class="order-first">
                                    {{ __('Dashboard') }}
                                </x-admin.nav-link>

                                <x-admin.nav-link :href="route('comments.index')" path="admin/comments*">
                                    {{ __('Comments') }}
                                </x-admin.nav-link>

                                <x-admin.nav-link :href="route('users.index')" path="admin/users*">
                                    {{ __('Users') }}
                                </x-admin.nav-link>
                            @endcan
                        </div>
                    </div>
                </div>

                <!-- Profile dropdown -->
                <div x-data="{ show: false }" @click.away="show = false" class="hidden md:block relative">
                    <button
                        type="button"
                        @click="show = ! show"
                        class="max-w-xs bg-gray-800 rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
                        id="user-menu-button"
                        aria-expanded="false"
                        aria-haspopup="true">

                        <span class="sr-only">{{ __('Toggle user menu') }}</span>

                        <x-profile-picture :user="Auth::user()" />
                    </button>

                    <div
                        x-show="show"
                        style="display: none;"
                        class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                        role="menu"
                        aria-orientation="vertical"
                        aria-labelledby="user-menu-button"
                        tabindex="-1">
                        <x-form :action="route('logout')" method="POST">
                            <button type="submit"
                                    class="block w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100"
                                    role="menuitem"
                                    tabindex="-1"
                                    id="user-menu-item-0">
                                {{ __('Logout') }}
                            </button>
                        </x-form>
                    </div>
                </div>

                <!-- Mobile menu button -->
                <div class="-mr-2 flex md:hidden">
                    <button
                        @click="showMobileMenu = ! showMobileMenu"
                        type="button"
                        class="bg-gray-800 inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
                        aria-controls="mobile-menu"
                        aria-expanded="false">

                        <span class="sr-only">{{ __('Toggle user menu') }}</span>

                        <svg x-bind:class="showMobileMenu ? 'hidden' : 'block'" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>

                        <svg x-bind:class="showMobileMenu ? 'block' : 'hidden'" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state. -->
        <div x-show="showMobileMenu" style="display: none;" class="md:hidden" id="mobile-menu">

            <div class="flex flex-col px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <x-admin.nav-link :href="route('posts.index')" path="admin/posts*" class="block text-base">
                    {{ __('Posts') }}
                </x-admin.nav-link>

                @can('admin')
                    <x-admin.nav-link :href="route('admin.home')" path="admin" class="order-first block text-base">
                        {{ __('Dashboard') }}
                    </x-admin.nav-link>

                    <x-admin.nav-link :href="route('comments.index')" path="admin/comments*" class="block text-base">
                        {{ __('Comments') }}
                    </x-admin.nav-link>

                    <x-admin.nav-link :href="route('users.index')" path="admin/users*" class="block text-base">
                        {{ __('Users') }}
                    </x-admin.nav-link>
                @endcan
            </div>

            <div class="pt-4 pb-3 border-t border-gray-700">
                <div class="flex items-center px-5">
                    <div class="flex-shrink-0">
                        <x-profile-picture :user="Auth::user()" />
                    </div>
                    <div class="ml-3">
                        <div class="text-base font-medium leading-none text-white">{{ Auth::user()->name }}</div>
                        <div class="mt-2 text-sm font-medium leading-none text-gray-400">{{ Auth::user()->email }}</div>
                    </div>
                </div>
                <div class="mt-3 px-2 space-y-1">
                    <x-form :action="route('logout')" method="POST">
                        <button type="submit"
                                class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700">
                            {{ __('Logout') }}
                        </button>
                    </x-form>
                </div>
            </div>
        </div>
    </nav>

    @isset($header)
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endisset

    <main>
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            @if (flash()->message)
                <x-alert :type="flash()->level">{{ flash()->message }}</x-alert>
            @endif

            <div class="px-4 py-6 sm:px-0">
                {{ $slot }}
            </div>
        </div>
    </main>
</div>

</body>
</html>

