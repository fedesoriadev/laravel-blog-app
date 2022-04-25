<div x-data="{ showSearch: false }"
     @click.away="showSearch = false"
     class="flex items-center space-x-2">
    <button type="button" @click="showSearch = !showSearch">
        <svg class="w-6 h-6 text-gray-500 hover:text-indigo-600 transition dark:text-neutral-200" fill="none"
             stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
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
                placeholder="{{ __('Search...') }}"
                class="bg-gray-100 border-gray-200 text-sm rounded-lg">
    </form>
</div>
