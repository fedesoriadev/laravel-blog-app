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
