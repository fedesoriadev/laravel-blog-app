<nav x-data="{ showMobileMenu: false }" class="bg-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <x-logo :href="Auth::user()->adminRoute()" />
                </div>

                <!-- Desktop main menu -->
                @include('admin.layout._desktop-main-menu')
            </div>

            <!-- Desktop right menu -->
            <div class="hidden md:flex items-center space-x-4">
                <!-- Language Switcher -->
                <x-lang-switcher class="text-white" />

                <!-- Back to site link -->
                <x-admin.back-to-site />

                <!-- Desktop user menu -->
                @include('admin.layout._desktop-user-menu')
            </div>

            <!-- Mobile right menu -->
            <div class="-mr-2 flex items-center space-x-2 md:hidden">
                <!-- Language Switcher -->
                <x-lang-switcher class="text-white" />

                <!-- Back to site link -->
                <x-admin.back-to-site />

                @include('admin.layout._mobile-toggle-main-menu')
            </div>
        </div>
    </div>

    <!-- Mobile main menu -->
    @include('admin.layout._mobile-main-menu')
</nav>
