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
            <x-form :action="route('logout')">
                <button type="submit"
                        class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700">
                    {{ __('Log out') }}
                </button>
            </x-form>
        </div>
    </div>
</div>
