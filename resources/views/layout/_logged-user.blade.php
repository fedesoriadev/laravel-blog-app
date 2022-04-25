<div x-data="{ showUserDropdown: false }" @click.away="showUserDropdown = false" class="relative">
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
            class="origin-top-right absolute z-10 right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none divide-y divide-gray-100"
            role="menu"
            aria-orientation="vertical"
            aria-labelledby="user-menu-button"
            tabindex="-1">

        @if (Auth::user()->role)
            <li>
                <a class="block w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100"
                   href="{{ Auth::user()->adminRoute() }}">
                    {{ __('Dashboard') }}
                </a>
            </li>
        @endif

        <li>
            <a class="block w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100"
               href="{{ route('profile.show') }}">
                {{ __('Profile') }}
            </a>
        </li>

        <li>
            <x-form :action="route('logout')">
                <button type="submit"
                        class="block w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100"
                        role="menuitem"
                        tabindex="-1"
                        id="user-menu-item-0">
                    {{ __('Log out') }}
                </button>
            </x-form>
        </li>
    </ul>
</div>
