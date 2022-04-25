<div x-data="{ show: false }" @click.away="show = false" class="relative">
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
            class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none divide-y divide-gray-100"
            role="menu"
            aria-orientation="vertical"
            aria-labelledby="user-menu-button"
            tabindex="-1">
        <div class="px-4 py-2 text-xs text-left text-gray-500">
            <span class="block">{{ Auth::user()->name }}</span>
            <span class="block">{{ Auth::user()->email }}</span>
        </div>
        <x-form :action="route('logout')">
            <button type="submit"
                    class="block w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100"
                    role="menuitem"
                    tabindex="-1"
                    id="user-menu-item-0">
                {{ __('Log out') }}
            </button>
        </x-form>
    </div>
</div>
