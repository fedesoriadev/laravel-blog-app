<nav class="flex items-center justify-between py-4">
    <a href="{{ route('home') }}"
       class="text-indigo-600 flex items-center hover:text-indigo-900 transition-all duration-300 ease-linear">
        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
        </svg>
        <span class="font-bold text-2xl">{{ config('app.name') }}</span>
    </a>

    <div class="flex items-center space-x-4">
        <form action="/">
            <label for="search" class="sr-only">{{ __('Search posts') }}</label>
            <input
                type="text"
                name="search"
                id="search"
                value="{{ request()->get('search', '') }}"
                placeholder="Search..."
                class="bg-slate-100 border-slate-200 text-sm rounded-lg">
        </form>

        @if (Auth::check())
            <a href="{{ route('admin.home') }}" class="text-sm text-slate-500">{{ __('Hi, :name', ['name' => Auth::user()->name]) }}</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-sm text-slate-500">{{ __('Logut') }}</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="text-sm text-slate-500">{{ __('Login') }}</a>
            <a href="{{ route('register') }}" class="text-sm text-slate-500">{{ __('Register') }}</a>
        @endif

        <button
            x-init="
                if (localStorage.darkMode || (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    document.documentElement.classList.add('dark')
                }
            "
            x-data="{
                toggleDarkMode: () => {
                    if (localStorage.darkMode) {
                        localStorage.removeItem('darkMode');
                        document.documentElement.classList.remove('dark');
                    } else {
                        localStorage.darkMode = true;
                        document.documentElement.classList.add('dark');
                    }
                }
            }"
            @click="toggleDarkMode()"
            class="w-8 h-8 bg-indigo-200 text-indigo-600 flex items-center justify-center rounded-full transition duration-300 ease-linear hover:bg-indigo-900 hover:text-white">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
            </svg>
        </button>
    </div>
</nav>
